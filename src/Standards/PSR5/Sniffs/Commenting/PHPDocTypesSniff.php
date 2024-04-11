<?php

/**
 * Check PHPDoc Types for PSR-5.
 *
 * @copyright 2024 Otago Polytechnic
 * @author    James Calder
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @license   CC BY-SA v4 or later
 */

declare(strict_types=1);

namespace PHP_CodeSniffer\Standards\PSR5\Sniffs\Commenting;

use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\PHPDocTypesSniff as SniffBase;

/**
 * Check PHPDoc Types for PSR-5.
 */
class PHPDocTypesSniff extends SniffBase
{
    /** @var bool throw an error and stop if we can't parse the file */
    public bool $debugMode = false;

    /** @var bool check named functions (except void ones with no params), and class variables and constants are documented
     *              unless using this sniff standalone to just check types, probably disable this and use other sniffs */
    public bool $checkHasDocBlocks = true;

    /** @var bool check doc blocks, if present, contain appropriate param, return, or var tags */
    public bool $checkHasTags = true;

    /** @var bool check there are no misplaced type tags--doesn't check for misplaced var tags */
    public bool $checkNoMisplaced = true;

    /** @var bool check the types match--isn't aware of class heirarchies from other files */
    public bool $checkTypeMatch = true;

    /** @var bool check built-in types are lower case, and short forms are used */
    public bool $checkStyle = true;

    /** @var bool check the types used conform to the PHP-FIG PHPDoc standard */
    public bool $checkPhpFig = true;

    /** @var bool check pass by reference and splat usage matches for param tags */
    public bool $checkPassSplat = true;

}
