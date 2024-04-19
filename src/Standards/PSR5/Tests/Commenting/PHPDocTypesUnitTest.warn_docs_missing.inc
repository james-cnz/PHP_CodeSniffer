<?php
/**
 * A collection code with missing annotations for testing
 *
 * These should pass PHPStan and Psalm.
 * But warnings should be given by the PHPDocTypesSniff when checkHasDocBlocks and checkHasTags are enabled.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA 4.0 or later
 */

/**
 * A collection of code with missing annotations for testing
 */
class DocsMissing
{

    // PHPDoc function is not documented.
    public function fun_not_doc(int $p): void
    {

    }//end fun_not_doc()


    /**
     * PHPDoc function parameter $p not documented and missing function @return tag
     */
    public function fun_missing_param_ret(int $p): int
    {
        return $p;

    }//end fun_missing_param_ret()


    // PHPDoc variable or constant is not documented.
    public int $v1 = 0;

    /**
     * PHPDoc missing @var tag
     */
    public int $v2 = 0;

}//end class
