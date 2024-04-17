<?php
/**
 * A collection of valid types for testing
 *
 * This file should have no errors when checked with either PHPStan or Psalm (but a warning about an unused var).
 * And no errors when checked with the PHPDoc Types sniff.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA v4 or later
 */

namespace MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\fixtures;

use stdClass as myStdClass, Exception;
use MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\ {PHPDocTypesSniffTest};

?>
<?php

/**
 * A parent class
 */
class PhpValidParent
{
}//end class

/**
 * An interface
 */
interface PhpValidInterface
{
}//end interface

/**
 * A trait
 */
trait PhpValidTrait
{
}

/**
 * A collection of valid types for testing
 */
class PhpValid extends PhpValidParent implements PhpValidInterface
{
    use PhpValidTrait;

    /**
     * Multiline type
     *
     * @var integer
     *      | boolean
     */
    public int|bool $v2;


    /**
     * Namespaces recognised
     *
     * @param \MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\fixtures\PhpValid $x
     *
     * @return void
     */
    public function namespaces(PhpValid $x): void
    {

    }//end namespaces()


    /**
     * Uses recognised
     *
     * @param \stdClass $x
     *
     * @return void
     */
    public function uses(myStdClass $x): void
    {

    }//end uses()


    /**
     * Parents recognised
     *
     * @param PhpValid $x
     *
     * @return void
     */
    public function parents(PhpValidParent $x): void
    {

    }//end parents()


    /**
     * Interfaces recognised
     *
     * @param PhpValid $x
     *
     * @return void
     */
    public function interfaces(PhpValidInterface $x): void
    {

    }//end interfaces()


    /**
     * Function templates recognised
     *
     * @param T2 $x
     *
     * @template T2 of int
     * @return   void
     */
    public function function_templates(int $x): void
    {

    }//end function_templates()


}//end class

/**
 * Another valid class
 *
 * @template T of int
 */
class PhpValid2
{


    /**
     * Class templates recognised
     *
     * @param T $x
     *
     * @return void
     */
    public function class_templates(int $x): void
    {

    }//end class_templates()


}//end class

// Ignore things that don't concern us.
$x = 0;
