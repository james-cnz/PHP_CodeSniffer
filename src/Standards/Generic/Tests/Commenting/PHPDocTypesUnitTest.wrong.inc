<?php
/**
 * A collection of invalid types for testing
 *
 * Most type annotations give an error either when checked with PHPStan or Psalm.
 * And all should give errors when checked with the PHPDoc Types sniff.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA v4 or later
 */

/**
 * PHPDoc misplaced tag
 *
 * @property int $p
 */

/**
 * A collection of invalid types for testing
 *
 * @property int< PHPDoc class property type missing or malformed
 * @property int PHPDoc class property name missing or malformed
 */
class TypesInvalid
{


    /**
     * Function parameter issues
     *
     * @param int<           PHPDoc function parameter type missing or malformed
     * @param integer        PHPDoc function parameter name missing or malformed
     * @param integer $p1    PHPDoc function parameter doesn't exist
     * @param integer $p2
     * @param integer $p2    PHPDoc function parameter repeated
     * @param string  $p3    PHPDoc function parameter type mismatch
     * @param integer ...$p5 PHPDoc function parameter splat mismatch
     * @param integer $p4    PHPDoc function parameter order wrong
     *
     * @return void
     */
    public function function_parameter_issues(int $p2, int $p3, int $p4, int $p5): void
    {

    }//end function_parameter_issues()


    /**
     * PHPDoc multiple function @return tags--Put in one tag, seperated by vertical bars |
     *
     * @return int
     * @return null
     */
    public function multiple_returns(): ?int
    {
        return 0;

    }//end multiple_returns()


    /**
     * PHPDoc function return type missing or malformed
     *
     * @return
     */
    public function return_malformed(): void
    {

    }//end return_malformed()


    /**
     * PHPDoc function return type mismatch
     *
     * @return string
     */
    public function return_mismatch(): int
    {
        return 0;

    }//end return_mismatch()


    /**
     * Template issues
     *
     * @template @      PHPDoc template name missing or malformed
     * @template T of @ PHPDoc template type missing or malformed
     * @return   void
     */
    public function template_issues(): void
    {

    }//end template_issues()


    /**
     * PHPDoc var type missing or malformed
     *
     * @var @
     */
    public int $varTypeMalformed;

    /**
     * PHPDoc var type mismatch
     *
     * @var string
     */
    public int $varTypeMismatch;

}//end class

/**
 * PHPDoc var type missing or malformed (not class var)
 *
 * @var @
 */
$varTypeMalformed2 = 0;
