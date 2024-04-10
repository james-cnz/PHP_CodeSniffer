<?php

/**
 * A collection of types not in recommended style for testing
 *
 * These needn't give errors in PHPStan or Psalm.
 * But the PHPDocTypesSniff should give warnings.
 *
 * @copyright 2024 Otago Polytechnic
 * @author    James Calder
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @license   CC BY-SA v4 or later
 */

/**
 * A collection of types not in recommended style for testing
 *
 * @property Integer $p PHPDoc class property type doesn't conform to recommended style
 */
class types_invalid {

    /**
     * @param Boolean|T $p PHPDoc function parameter type doesn't conform to recommended style
     * @return Integer PHPDoc function return type doesn't conform to recommended style
     * @template T of Integer PHPDoc tempate type doesn't conform to recommended style
     */
    public function fun_wrong($p): int {
        return 0;
    }

    /** @var Integer PHPDoc var type doesn't conform to recommended style */
    public int $v1;

    /** @var Integer
     *      | Boolean Multiline type, no line break at end */
    public int|bool $v2;

    /** @var Integer
     *      | Boolean Multiline type, line break at end
     */
    public int|bool $v3;

}

/** @var Integer PHPDoc var type doesn't conform to recommended style (not class var) */
$v4 = 0;
