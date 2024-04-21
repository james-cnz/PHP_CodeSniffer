<?php
/**
 * A collection code with missing PHPDoc tags for testing
 *
 * These should pass PHPStan and Psalm.
 * But warnings should be given by the PHPDocTypesSniff when checkHasTags is enabled.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA 4.0 or later
 */

declare(strict_types=1);

/**
 * A collection code with missing PHPDoc tags for testing
 */
class TagsMissing
{

    /**
     * PHPDoc function parameter $p not documented and missing function @return tag
     */
    public function funMissingParamRet(int $p): int
    {
        return $p;

    }//end funMissingParamRet()

    /**
     * PHPDoc missing @var tag
     */
    public int $v2 = 0;

}//end class
