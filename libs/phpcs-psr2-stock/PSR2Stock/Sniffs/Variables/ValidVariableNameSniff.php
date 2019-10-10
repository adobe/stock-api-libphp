<?php
/**
 * ValidVariableNameSniff
 * Checks the naming of variables and member variables.
 *
 * Original by Squiz
 *
 * Squiz_Sniffs_NamingConventions_ValidVariableNameSniff.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @version   Release: 2.6.2
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
namespace PSR2Stock\Sniffs\Variables;

use \PHP_CodeSniffer\Sniffs\AbstractVariableSniff;
use \PHP_CodeSniffer\Files\File;

class ValidVariableNameSniff extends AbstractVariableSniff
{

    /**
     * Tokens to ignore so that we can find a DOUBLE_COLON.
     *
     * @var array
     */
    private $_ignore = array(
                        T_WHITESPACE,
                        T_COMMENT,
                       );

    /**
     * Return true if not uppercase in word
     *
     * @param string $string The string to verify.
     *
     * @return boolean
     */
    private static function isSnakeCaseName($string)
    {
        $is_snake_case = true;

        if (strpos($string, ' ')) {
            // there can't be space in the var names
            $is_snake_case = false;
        } else if (preg_match('/^[A-Z]{2,}|[a-z]/', $string) === 0) {
            // var name can start with multiple upper letters (acronymes)
            // or with lower case char
            $is_snake_case = false;
        } else {
            $name_bits = explode('_', $string);

            foreach ($name_bits as $word) {
                $length = strlen($word);
                $previous_char_was_numeric = false;
                $previous_char_was_upper_case = false;

                for ($i = 0; $i < $length; $i++) {
                    if (is_numeric($word[$i])) {
                        $previous_char_was_numeric = true;
                        $previous_char_was_upper_case = false;
                    } else if (strtoupper($word[$i]) === $word[$i]) {
                        if (
                            $i > 0
                            && !$previous_char_was_numeric
                            && !$previous_char_was_upper_case
                        ) {
                            $is_snake_case = false;
                            break(2);
                        }

                        $previous_char_was_numeric = false;
                        $previous_char_was_upper_case = true;
                    } else {
                        $previous_char_was_numeric = false;
                        $previous_char_was_upper_case = false;
                    }
                }
            }
        }

        return $is_snake_case;
    }

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    protected function processVariable(File $phpcsFile, $stackPtr)
    {
        $tokens  = $phpcsFile->getTokens();
        $varName = ltrim($tokens[$stackPtr]['content'], '$');

        $phpReservedVars = array(
            '_SERVER',
            '_GET',
            '_POST',
            '_REQUEST',
            '_SESSION',
            '_ENV',
            '_COOKIE',
            '_FILES',
            'GLOBALS',
            'http_response_header',
            'HTTP_RAW_POST_DATA',
            'php_errormsg',
        );

        // If it's a php reserved var, then its ok.
        if (in_array($varName, $phpReservedVars) === true) {
            return;
        }

        $objOperator = $phpcsFile->findNext(array(T_WHITESPACE), ($stackPtr + 1), null, true);
        if ($tokens[$objOperator]['code'] === T_OBJECT_OPERATOR) {
            // Check to see if we are using a variable from an object.
            $var = $phpcsFile->findNext(array(T_WHITESPACE), ($objOperator + 1), null, true);
            if ($tokens[$var]['code'] === T_STRING) {
                $bracket = $objOperator = $phpcsFile->findNext(array(T_WHITESPACE), ($var + 1), null, true);
                if ($tokens[$bracket]['code'] !== T_OPEN_PARENTHESIS) {
                    $objVarName = $tokens[$var]['content'];

                    // There is no way for us to know if the var is public or
                    // private, so we have to ignore a leading underscore if there is
                    // one and just check the main part of the variable name.
                    $originalVarName = $objVarName;
                    if (substr($objVarName, 0, 1) === '_') {
                        $objVarName = substr($objVarName, 1);
                    }

                }//end if
            }//end if
        }//end if

        $objOperator = $phpcsFile->findPrevious(array(T_WHITESPACE), ($stackPtr - 1), null, true);
        $static = $tokens[$objOperator]['code'] === T_DOUBLE_COLON;

        // We only check outside of class, non static members variable.
        if (!$static) {
            if ($this->isSnakeCaseName($varName) === false) {
                $error = 'Variable "%s" is not snake case';
                $phpcsFile->addError($error, $stackPtr, 'NotLowerCase', array($varName));
            }
        }

    }//end processVariable()

    /**
     * Processes class member variables.
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    protected function processMemberVar(File $phpcsFile, $stackPtr)
    {}//end processMemberVar()

    /**
     * Processes the variable found within a double quoted string.
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the double quoted string.
     *
     * @return void
     */
    protected function processVariableInString(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $phpReservedVars = array(
                            '_SERVER',
                            '_GET',
                            '_POST',
                            '_REQUEST',
                            '_SESSION',
                            '_ENV',
                            '_COOKIE',
                            '_FILES',
                            'GLOBALS',
                            'http_response_header',
                            'HTTP_RAW_POST_DATA',
                            'php_errormsg',
                           );
        if (preg_match_all('|[^\\\]\${?([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)|', $tokens[$stackPtr]['content'], $matches) !== 0) {
            foreach ($matches[1] as $varName) {
                // If it's a php reserved var, then its ok.
                if (in_array($varName, $phpReservedVars) === true) {
                    continue;
                }

                if ($this->isSnakeCaseName($varName) === false) {
                    $varName = $matches[0][0];
                    $error = 'Variable "%s" is not snake case';
                    $data = array($varName);
                    $phpcsFile->addError($error, $stackPtr, 'NotLowerCase', $data);

                }
            }
        }//end if
    }//end processVariableInString()
}//end class
