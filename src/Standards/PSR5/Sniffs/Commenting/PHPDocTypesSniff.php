<?php
/**
 * Check PHPDoc Types for PSR-5.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA v4 or later
 */

declare(strict_types=1);

namespace PHP_CodeSniffer\Standards\PSR5\Sniffs\Commenting;

use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\PHPDocTypesSniff as SniffBase;

/**
 * Check PHPDoc Types for PSR-5.
 */
class PHPDocTypesSniff extends SniffBase
{

    /**
     * Throw an error and stop if we can't parse the file.
     *
     * @var boolean
     */
    public bool $debugMode = false;

    /**
     * Check named functions (except void ones with no params), and class variables and constants are documented.
     * Unless using this sniff standalone to just check types, probably disable this and use other sniffs.
     *
     * @var boolean
     */
    public bool $checkHasDocBlocks = true;

    /**
     * Check doc blocks, if present, contain appropriate param, return, or var tags.
     *
     * @var boolean
     */
    public bool $checkHasTags = true;

    /**
     * Check there are no misplaced type tags--doesn't check for misplaced var tags.
     *
     * @var boolean
     */
    public bool $checkNoMisplaced = true;

    /**
     * Check the types match--isn't aware of class heirarchies from other files.
     *
     * @var boolean
     */
    public bool $checkTypeMatch = true;

    /**
     * Check built-in types are lower case, and short forms are used.
     *
     * @var boolean
     */
    public bool $checkStyle = true;

    /**
     * Check the types used conform to the PHP-FIG PHPDoc standard.
     *
     * @var boolean
     */
    public bool $checkPhpFig = true;

    /**
     * Check pass by reference and splat usage matches for param tags.
     *
     * @var boolean
     */
    public bool $checkPassSplat = true;

}//end class
