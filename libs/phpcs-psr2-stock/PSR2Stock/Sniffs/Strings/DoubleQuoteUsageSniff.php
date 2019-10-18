<?php
/**
 * DoubleQuoteUsageSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 PSR2Stock Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
namespace PSR2Stock\Sniffs\Strings;

use \PHP_CodeSniffer\Sniffs\Sniff;
use \PHP_CodeSniffer\Files\File;

/**
 * DoubleQuoteUsageSniff.
 *
 * Makes sure that any use of Double Quotes ("") are warranted.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 PSR2Stock Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: 2.5.1
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class DoubleQuoteUsageSniff implements Sniff
{
    public $allowed_double_quoted_variables_patterns = array(
        '/^\$[^$]*query[^\s]*$/',
        '/^\$[^$]*sql[^\s]*$/',
        '/^\$from_tables$/',
        '/^\$filters_value$/',
    );

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
                T_CONSTANT_ENCAPSED_STRING,
                T_DOUBLE_QUOTED_STRING,
               );

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // We are only interested in the first token in a multi-line string.
        if ($tokens[$stackPtr]['code'] === $tokens[($stackPtr - 1)]['code']) {
            return;
        }

        $workingString   = $tokens[$stackPtr]['content'];
        $lastStringToken = $stackPtr;

        $i = ($stackPtr + 1);
        if (isset($tokens[$i]) === true) {
            while ($tokens[$i]['code'] === $tokens[$stackPtr]['code']) {
                $workingString  .= $tokens[$i]['content'];
                $lastStringToken = $i;
                $i++;
            }
        }

        // Check if it's a double quoted string.
        if (strpos($workingString, '"') === false) {
            return;
        }

        // Make sure it's not a part of a string started in a previous line.
        // If it is, then we have already checked it.
        if ($workingString[0] !== '"') {
            return;
        }

        // checks the variable name if any
        $previous_equal = $phpcsFile->findPrevious(T_EQUAL, $stackPtr - 1, null);
        if ($previous_equal) {
            $var = $phpcsFile->findPrevious(T_VARIABLE, $previous_equal, null);
            if ($var) {
                foreach ($this->allowed_double_quoted_variables_patterns as $var_pattern) {
                    if (preg_match($var_pattern, $tokens[$var]['content'])) {
                        return;
                    }
                }
            }

                // $var
                // && in_array($tokens[$var]['content'], $this->allowed_double_quoted_variables))) {
                // return;
            // }
        }

        //die(print_r($tokens[$var], true));

        // die(print_r($tokens[$var], true));

        // die(print_r($tokens[$stackPtr - 4], true));

        // The use of variables in double quoted strings is not allowed.
        if ($tokens[$stackPtr]['code'] === T_DOUBLE_QUOTED_STRING) {
            $stringTokens = token_get_all('<?php '.$workingString);
            foreach ($stringTokens as $token) {
                if (is_array($token) === true && $token[0] === T_VARIABLE) {
                    $error = 'Variable "%s" not allowed in double quoted string; use concatenation instead';
                    $data  = array($token[1]);
                    $phpcsFile->addError($error, $stackPtr, 'ContainsVar', $data);
                }
            }

            return;
        }//end if

        $allowedChars = array(
                         '\0',
                         '\1',
                         '\2',
                         '\3',
                         '\4',
                         '\5',
                         '\6',
                         '\7',
                         '\n',
                         '\r',
                         '\f',
                         '\t',
                         '\v',
                         '\x',
                         '\b',
                         '\e',
                         '\u',
                         '\'',
                        );

        foreach ($allowedChars as $testChar) {
            if (strpos($workingString, $testChar) !== false) {
                return;
            }
        }

        $error = 'String %s does not require double quotes; use single quotes instead';
        $data  = array(str_replace("\n", '\n', $workingString));
        $fix   = $phpcsFile->addFixableError($error, $stackPtr, 'NotRequired', $data);

        if ($fix === true) {
            $phpcsFile->fixer->beginChangeset();
            $innerContent = substr($workingString, 1, -1);
            $innerContent = str_replace('\"', '"', $innerContent);
            $phpcsFile->fixer->replaceToken($stackPtr, "'$innerContent'");
            while ($lastStringToken !== $stackPtr) {
                $phpcsFile->fixer->replaceToken($lastStringToken, '');
                $lastStringToken--;
            }

            $phpcsFile->fixer->endChangeset();
        }

    }//end process()


}//end class
