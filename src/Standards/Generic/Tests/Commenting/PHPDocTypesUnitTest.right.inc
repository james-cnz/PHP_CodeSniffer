<?php

/**
 * A collection of valid types for testing
 *
 * This file should have no errors when checked with either PHPStan or Psalm (but a warning about an unused var).
 * And no errors when checked with the PHPDoc Types sniff.
 *
 * @copyright 2024 Otago Polytechnic
 * @author    James Calder
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @license   CC BY-SA v4 or later
 */

namespace MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\fixtures;

use stdClass as myStdClass, Exception;
use MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\ {PHPDocTypesSniffTest};

?>
<?php

/**
 * A parent class
 */
class php_valid_parent {
}

/**
 * An interface
 */
interface php_valid_interface {
}

/** A trait */
trait php_valid_trait {
}

/**
 * A collection of valid types for testing
 */
class php_valid extends php_valid_parent implements php_valid_interface {
    use php_valid_trait;

    /**
     * Namespaces recognised
     * @param \MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\fixtures\php_valid $x
     * @return void
     */
    function namespaces(php_valid $x): void {
    }

    /**
     * Uses recognised
     * @param \stdClass $x
     * @return void
     */
    function uses(myStdClass $x): void {
    }

    /**
     * Parents recognised
     * @param php_valid $x
     * @return void
     */
    function parents(php_valid_parent $x): void {
    }

    /**
     * Interfaces recognised
     * @param php_valid $x
     * @return void
     */
    function interfaces(php_valid_interface $x): void {
    }

    /**
     * Function templates recognised
     * @template T2 of int
     * @param T2 $x
     * @return void
     */
    function function_templates(int $x): void {
    }

    /**
     * Visibility accepted
     * @param int $x
     * @return void
     */
    public function visibility(int $x): void {
    }

    /** @var int
     *      | bool Multiline type */
    public int|bool $v2;

}

/**
 * @template T of int
 */
class php_valid_2 {

    /**
     * Class templates recognised
     * @param T $x
     * @return void
     */
    function class_templates(int $x): void {
    }

}

// Ignore things that don't concern us.
$x = 0;
