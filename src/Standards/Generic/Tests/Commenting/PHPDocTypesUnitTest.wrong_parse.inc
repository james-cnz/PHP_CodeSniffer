<?php

/**
 * A collection of parse errors for testing
 *
 * @copyright 2024 Otago Polytechnic
 * @author    James Calder
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @license   CC BY-SA v4 or later
 */

namespace trailing_backslash\;

namespace @ // Malformed.

use no_trailing_backslash {something};

use trailing_backslash\;

use x\ { ; // No bracket closer.

use x\ {}; // No content.

use x as @; // Malformed as clause.

use x @ // No terminator.

/** @var int */
public int $wrong_place_1;

/** */
function wrong_places(): void {
    namespace ns;
    use x;
    /** */
    class c {}
    /** @var int */
    public int $wrong_place_2;
}

/**
 * A collection of parse errors for testing
 */
class types_invalid // No block

/** */
class c { // No block close

/** */
class c {
    use T { @
}

/** */
function f: void {} // No parameters

/** */
function f( : void {} // No parameters close

/** */
function f(): void // No block

/** */
function f(): void { // No block close

/** */
public @ // Malformed declaration.

/** @var int */
public int $v @ // Unterminated variable.

/** @param string $p */
function f(int $p): void {};  // Do we still reach here, and detect an error?

/** Unclosed Doc comment
