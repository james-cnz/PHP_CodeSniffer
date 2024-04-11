<?php

/**
 * A collection of valid types for testing
 *
 * This file should have no errors when checked with either PHPStan or Psalm.
 * But warnings should be given by the PHPDoc types sniff.
 *
 * @copyright 2024 Otago Polytechnic
 * @author    James Calder
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @license   CC BY-SA v4 or later
 */

namespace MoodleHQ\MoodleCS\moodle\Tests\Sniffs\Commenting\fixtures;

/**
 * A collection of valid types for testing
 */
class php_valid {

    /**
     * @param ?int $p
     * @return ?int
     */
    function f(?int $p): ?int {
        return $p;
    }

    /** @var ?int */
    public ?int $v;

}

/** @var ?int */
$v2 = 0;
