<?php

/**
 * A collection code with missing annotations for testing
 *
 * These should pass PHPStan and Psalm.
 * But warnings should be given by the PHPDocTypesSniff when CHECK_HAS_DOCS is enabled.
 *
 * @copyright 2024 Otago Polytechnic
 * @author    James Calder
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @license   CC BY-SA v4 or later
 */

/**
 * A collection of code with missing annotations for testing
 */
class types_invalid {

    // PHPDoc function is not documented
    public function fun_not_doc(int $p): void {
    }

    /**
     * PHPDoc function parameter $p not documented
     * PHPDoc missing function @return tag
     */
    public function fun_missing_param_ret(int $p): int {
        return $p;
    }

    // PHPDoc variable or constant is not documented
    public int $v1 = 0;

    /** PHPDoc missing @var tag */
    public int $v2 = 0;

}