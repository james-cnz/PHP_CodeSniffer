<?php
/**
 * A collection of types not in recommended style for testing
 *
 * These needn't give errors in PHPStan or Psalm.
 * But the PHPDocTypesSniff should give warnings when checkStyle is enabled.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA 4.0 or later
 */

/**
 * A collection of types not in recommended style for testing
 *
 * @property Integer $p PHPDoc class property type doesn't conform to recommended style
 */
class WarnStyle
{

    /**
     * PHPDoc var type doesn't conform to recommended style
     *
     * @var integer
     */
    public int $v1;

    /**
     * Multiline type, no line break at end
     *
     * @var integer
     *      | boolean */
    public int|bool $v2;

    /**
     * Multiline type, line break at end
     *
     * @var integer
     *      | boolean
     */
    public int|bool $v3;


    /**
     * Function style
     *
     * @param Boolean|T $p PHPDoc function parameter type doesn't conform to recommended style
     *
     * @return   Integer PHPDoc function return type doesn't conform to recommended style
     * @template T of Integer PHPDoc tempate type doesn't conform to recommended style
     */
    public function funWrong($p): int
    {
        return 0;

    }//end funWrong()


}//end class

/**
 * PHPDoc var type doesn't conform to recommended style (not class var)
 *
 * @var Integer
 */
$v4 = 0;
