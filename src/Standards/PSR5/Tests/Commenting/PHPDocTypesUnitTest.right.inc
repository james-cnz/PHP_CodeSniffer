<?php
/**
 * A collection of valid types for testing
 *
 * This file should have no errors when checked with either PHPStan or Psalm, other than no value for iterable.
 * And no errors when checked with the PHPDoc Types sniff.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2023-2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA v4 or later
 */

use stdClass as MyStdClass;

/**
 * A parent class
 */
class TypesValidParent
{
}//end class

/**
 * An interface
 */
interface TypesValidInterface
{
}//end interface

/**
 * A collection of valid types for testing
 */
class TypesValid extends TypesValidParent implements TypesValidInterface
{


    /**
     * Basic type equivalence
     *
     * @param array      $array
     * @param bool       $bool
     * @param int        $int
     * @param float      $float
     * @param string     $string
     * @param object     $object
     * @param self       $self
     * @param iterable   $iterable
     * @param TypesValid $specificclass
     * @param callable   $callable
     *
     * @return void
     */
    public function basic_type_equivalence(
        array $array,
        bool $bool,
        int $int,
        float $float,
        string $string,
        object $object,
        self $self,
        iterable $iterable,
        TypesValid $specificclass,
        callable $callable
    ): void {

    }//end basic_type_equivalence()


    /**
     * Types not supported natively (as of PHP 7.2)
     *
     * @param resource $resource
     * @param static   $static
     * @param mixed    $mixed
     *
     * @return never
     */
    public function non_native_types($resource, $static, $mixed)
    {
        throw new \Exception();

    }//end non_native_types()


    /**
     * Parameter modifiers
     *
     * @param object &$reference
     * @param int    ...$splat
     *
     * @return void
     */
    public function parameter_modifiers(
        object &$reference,
        int ...$splat
    ): void {

    }//end parameter_modifiers()


    /**
     * Boolean types
     *
     * @param bool       $bool
     * @param true|false $literal
     *
     * @return void
     */
    public function boolean_types(bool $bool, bool $literal): void
    {

    }//end boolean_types()


    /**
     * Object types
     *
     * @param object            $object
     * @param TypesValid        $class
     * @param self|static|$this $relative
     * @param Traversable       $traversable
     * @param \Closure          $closure
     *
     * @return void
     */
    public function object_types(object $object, object $class,
        object $relative, object $traversable, object $closure
    ): void {

    }//end object_types()


    /**
     * Null type
     *
     * @param null     $standalonenull
     * @param int|null $explicitnullable
     * @param int|null $implicitnullable
     *
     * @return void
     */
    public function null_type(
        $standalonenull,
        ?int $explicitnullable,
        int $implicitnullable=null
    ): void {

    }//end null_type()


    /**
     * User-defined type
     *
     * @param TypesValid|\TypesValid $class
     *
     * @return void
     */
    public function user_defined_type(TypesValid $class): void
    {

    }//end user_defined_type()


    /**
     * Callable types
     *
     * @param callable $callable
     * @param \Closure $closure
     *
     * @return void
     */
    public function callable_types(callable $callable, callable $closure): void
    {

    }//end callable_types()


    /**
     * Iterable types
     *
     * @param array       $array
     * @param iterable    $iterable
     * @param Traversable $traversable
     *
     * @return void
     */
    public function iterable_types(iterable $array, iterable $iterable, iterable $traversable): void
    {

    }//end iterable_types()


    /**
     * Basic structure
     *
     * @param int|string        $union
     * @param TypesValid&object $intersection
     * @param int[]             $arraysuffix
     *
     * @return void
     */
    public function basic_structure(
        $union,
        object $intersection,
        array $arraysuffix
    ): void {

    }//end basic_structure()


    /**
     * Structure combinations
     *
     * @param int|float|string               $multipleunion
     * @param TypesValid&object&\Traversable $multipleintersection
     * @param int[][]                        $multiplearray
     * @param int|int[]                      $unionarray
     * @param (int)[]                        $bracketarray
     * @param int|(TypesValid&object)        $dnf
     *
     * @return void
     */
    public function structure_combos(
        $multipleunion,
        object $multipleintersection,
        array $multiplearray,
        $unionarray,
        array $bracketarray,
        $dnf
    ): void {

    }//end structure_combos()


    /**
     * DocType DNF vs Native DNF
     *
     * @param int|(TypesValidParent&TypesValidInterface) $p
     *
     * @return void
     */
    public function dnf_vs_dnf((TypesValidInterface&TypesValidParent)|int $p): void
    {

    }//end dnf_vs_dnf()


    /**
     * Inheritance
     *
     * @param TypesValid        $basic
     * @param self|static|$this $relative1
     * @param TypesValid        $relative2
     *
     * @return void
     */
    public function inheritance(
        TypesValidParent $basic,
        parent $relative1,
        parent $relative2
    ): void {

    }//end inheritance()


    /**
     * Template
     *
     * @param T $template
     *
     * @template T of int
     * @return   void
     */
    public function template(int $template): void
    {

    }//end template()


    /**
     * Use alias
     *
     * @param stdClass $use
     *
     * @return void
     */
    public function uses(MyStdClass $use): void
    {

    }//end uses()


    /**
     * Built-in classes with inheritance
     *
     * @param Traversable|Iterator|Generator|IteratorAggregate          $traversable
     * @param Iterator|Generator                                        $iterator
     * @param Throwable|Exception|Error                                 $throwable
     * @param Exception|ErrorException                                  $exception
     * @param Error|ArithmeticError|AssertionError|ParseError|TypeError $error
     * @param ArithmeticError|DivisionByZeroError                       $arithmeticerror
     *
     * @return void
     */
    public function builtin_classes(
        Traversable $traversable, Iterator $iterator,
        Throwable $throwable, Exception $exception, Error $error,
        ArithmeticError $arithmeticerror
    ): void {

    }//end builtin_classes()


    /**
     * SPL classes with inheritance (a few examples only)
     *
     * @param Iterator|SeekableIterator|ArrayIterator $iterator
     * @param SeekableIterator|ArrayIterator          $seekableiterator
     * @param Countable|ArrayIterator                 $countable
     *
     * @return void
     */
    public function spl_classes(
        Iterator $iterator, SeekableIterator $seekableiterator, Countable $countable
    ): void {

    }//end spl_classes()


}//end class
