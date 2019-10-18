<?php
/**
 * ControlStructureSpacingSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
namespace PSR2Stock\Sniffs\WhiteSpace;

use \PHP_CodeSniffer\Sniffs\Sniff;
use \PHP_CodeSniffer\Files\File;
use \PHP_CodeSniffer\Util\Tokens;

/**
 * ControlStructureSpacingSniff.
 *
 * Checks that control structures have the correct spacing around brackets.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @author    Marc McIntyre <mmcintyre@squiz.net>
 * @copyright 2006-2014 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class ControlStructureSpacingSniff implements Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array(
        'PHP',
        'JS',
    );


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(
            T_IF,
            T_WHILE,
            T_FOREACH,
            T_FOR,
            T_SWITCH,
            T_DO,
            T_ELSE,
            T_ELSEIF,
            T_TRY,
            T_CATCH,
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


        if (isset($tokens[$stackPtr]['scope_closer']) === false) {
            return;
        }

        $scopeOpener = $tokens[$stackPtr]['scope_opener'];
        $scopeCloser = $tokens[$stackPtr]['scope_closer'];

        for ($firstContent = ($scopeOpener + 1); $firstContent < $phpcsFile->numTokens; $firstContent++) {
            if ($tokens[$firstContent]['code'] !== T_WHITESPACE) {
                break;
            }
        }

        $trailingContent = $phpcsFile->findNext(
            T_WHITESPACE,
            ($scopeCloser + 1),
            null,
            true
        );

        if ($tokens[$trailingContent]['code'] === T_COMMENT) {
            // Special exception for code where the comment about
            // an ELSE or ELSEIF is written between the control structures.
            $nextCode = $phpcsFile->findNext(
                Tokens::$emptyTokens,
                ($scopeCloser + 1),
                null,
                true
            );

            if ($tokens[$nextCode]['code'] === T_ELSE
                || $tokens[$nextCode]['code'] === T_ELSEIF
            ) {
                $trailingContent = $nextCode;
            }
        }//end if

        if ($tokens[$trailingContent]['code'] === T_ELSE) {
            if ($tokens[$stackPtr]['code'] === T_IF) {
                // IF with ELSE.
                return;
            }
        }

        if ($tokens[$trailingContent]['code'] === T_WHILE
            && $tokens[$stackPtr]['code'] === T_DO
        ) {
            // DO with WHILE.
            return;
        }

        if ($tokens[$trailingContent]['code'] === T_CLOSE_TAG) {
            // At the end of the script or embedded code.
            return;
        }

        //We do require blank line or a closing bracket after the control structure
        if ($tokens[$trailingContent]['code'] !== T_ELSE
            && $tokens[$trailingContent]['code'] !== T_ELSEIF
            && $tokens[$trailingContent]['code'] !== T_CATCH
            && $tokens[$trailingContent]['code'] !== T_CLOSE_CURLY_BRACKET
            && $tokens[$trailingContent]['line'] === ($tokens[$scopeCloser]['line'] + 1)
        ) {
            $error = 'No blank line found after control structure';
            $fix   = $phpcsFile->addFixableError($error, $scopeCloser, 'NoLineAfterClose');
            if ($fix === true) {
                $phpcsFile->fixer->addNewline($scopeCloser);
            }
        }//end if

    }//end process()


}//end class
