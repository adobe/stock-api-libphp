<?php
/**
 * PR2Stock_Sniffs_Whitespace_ControlStructureSpacingSniff
 *
 * Initialises allowed doc block types
 */
namespace PSR2Stock\Sniffs\Commenting;

use \PHP_CodeSniffer\Sniffs\Sniff;
use \PHP_CodeSniffer\Files\File;
use \PHP_CodeSniffer\Util\Common;

class SetAllowedTypesSniff implements Sniff
{
    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        Common::$allowedTypes[] = 'int';
        Common::$allowedTypes[] = 'bool';

        return array();
    }

    /**
     * Processes this test, but only once for the whole execution
     *
     * @param File $phpcsFile The file being scanned.
     * @param int  $stackPtr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        // nothing to do here and will never be called
    }
}
