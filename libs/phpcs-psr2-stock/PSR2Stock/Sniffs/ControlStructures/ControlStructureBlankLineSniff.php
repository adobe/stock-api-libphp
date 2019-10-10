<?php

/**
 * moodle_sniffs_controlstructureblanklinesniff
 *
 * Checks that there is a blank line before control structures
 *
 * @copyright 2009 Nicolas Connault
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace PSR2Stock\Sniffs\ControlStructures;

use \PHP_CodeSniffer\Files\File;
use \PHP_CodeSniffer\Sniffs\Sniff;

class ControlStructureBlankLineSniff implements Sniff {

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register() {
        return array(T_IF, T_FOR, T_FOREACH, T_WHILE, T_SWITCH, T_TRY);
    }


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param File $phpcsfile All the tokens found in the document.
     * @param int  $stackptr  The position of the current token in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsfile, $stackptr) {
        $tokens = $phpcsfile->gettokens();
        $previoustoken = $stackptr - 1;

        // Move back until we find the previous non-whitespace, non-comment token
        do {
            $previoustoken = $phpcsfile->findprevious(array(T_WHITESPACE, T_COMMENT, T_DOC_COMMENT),
                                                      ($previoustoken - 1), null, true);

        } while ($tokens[$previoustoken]['line'] == $tokens[$stackptr]['line']);

        $previous_non_ws_token = $tokens[$previoustoken];

        $previous_token = $tokens[$phpcsfile->findprevious(
            array(T_WHITESPACE, T_COMMENT, T_DOC_COMMENT),
            ($stackptr - 1), null, true)
        ];

        // If this token is immediately on the line before this control structure, print a warning
        if ($previous_non_ws_token['line'] == ($tokens[$stackptr]['line'] - 1)) {
            // Exception: do {EOL...} while (...);
            if ($tokens[$stackptr]['code'] == T_WHILE && $tokens[($stackptr - 1)]['code'] == T_CLOSE_CURLY_BRACKET) {
                // Ignore do...while (see above)
            } else if (
                $previous_non_ws_token['code'] == T_OPEN_CURLY_BRACKET
                || $previous_non_ws_token['content'] == ':'
                || $previous_non_ws_token['code'] == T_CLOSE_CURLY_BRACKET
                || $previous_token['code'] == T_ELSE
            ) {
                // if the previous token is an open bracket just ignore
            } else {
                $fix = $phpcsfile->addFixableError('You should add a blank line before control structures', $stackptr, 'NoLineBeforeControlStructure');

                if ($fix === true) {
                    $phpcsfile->fixer->beginChangeset();
                    $phpcsfile->fixer->addNewlineBefore($stackptr - 1);
                    $phpcsfile->fixer->endChangeset();
                }
            }
        }
    }
}
