<?php
/**
 * A collection of valid types for testing
 *
 * This file should have no errors when checked with either PHPStan or Psalm.
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
     * @var array<int, string>
     */
    public const ARRAY_CONST = [
        1 => 'one',
        2 => 'two'
    ];

    /**
     * @var int
     */
    public const INT_ONE = 1;

    /**
     * @var int
     */
    public const INT_TWO = 2;

    /**
     * @var float
     */
    public const FLOAT_1_0 = 1.0;

    /**
     * @var float
     */
    public const FLOAT_2_0 = 2.0;

    /**
     * @var string
     */
    public const STRING_HELLO = 'Hello';

    /**
     * @var string
     */
    public const STRING_WORLD = 'World';

    /**
     * @var bool
     */
    public const BOOL_FALSE = false;

    /**
     * @var bool
     */
    public const BOOL_TRUE = true;


    /**
     * Basic type equivalence
     *
     * @param bool       $bool
     * @param int        $int
     * @param float      $float
     * @param string     $string
     * @param object     $object
     * @param self       $self
     * @param parent     $parent
     * @param TypesValid $specificclass
     * @param callable   $callable
     *
     * @return void
     */
    public function basic_type_equivalence(
        bool $bool,
        int $int,
        float $float,
        string $string,
        object $object,
        self $self,
        parent $parent,
        TypesValid $specificclass,
        callable $callable
    ): void {

    }//end basic_type_equivalence()


    /**
     * Types not supported natively (as of PHP 7.2)
     *
     * @param array<int>    $parameterisedarray
     * @param resource      $resource
     * @param static        $static
     * @param iterable<int> $parameterisediterable
     * @param array-key     $arraykey
     * @param scalar        $scalar
     * @param mixed         $mixed
     *
     * @return never
     */
    public function non_native_types($parameterisedarray, $resource, $static, $parameterisediterable,
        $arraykey, $scalar, $mixed
    ) {
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
     * @param bool|boolean $bool
     * @param true|false   $literal
     *
     * @return void
     */
    public function boolean_types(bool $bool, bool $literal): void
    {

    }//end boolean_types()


    /**
     * Integer types
     *
     * @param int|integer                                                 $int
     * @param positive-int|negative-int|non-positive-int|non-negative-int $intrange1
     * @param int<0, 100>|int<min, 100>|int<50, max>|int<-100, max>       $intrange2
     * @param 234|-234                                                    $literal1
     * @param int-mask<1, 2, 4>                                           $intmask1
     *
     * @return void
     */
    public function integer_types(int $int, int $intrange1, int $intrange2,
        int $literal1, int $intmask1
    ): void {

    }//end integer_types()


    /**
     * Integer types complex
     *
     * @param 1_000|-1_000                                                                $literal2
     * @param int-mask<TypesValid::INT_ONE, TypesValid::INT_TWO>                          $intmask2
     * @param int-mask-of<TypesValid::INT_*>|int-mask-of<key-of<TypesValid::ARRAY_CONST>> $intmask3
     *
     * @return void
     */
    public function integer_types_complex(int $literal2, int $intmask2, int $intmask3): void
    {

    }//end integer_types_complex()


    /**
     * Float types
     *
     * @param float|double $float
     * @param 1.0|-1.0     $literal
     *
     * @return void
     */
    public function float_types(float $float, float $literal): void
    {

    }//end float_types()


    /**
     * String types
     *
     * @param string                                                                                        $string
     * @param class-string|class-string<TypesValid>                                                         $classstring1
     * @param callable-string|numeric-string|non-empty-string|non-falsy-string|truthy-string|literal-string $other
     * @param 'foo'|'bar'                                                                                   $literal
     *
     * @return void
     */
    public function string_types(string $string, string $classstring1, string $other, string $literal): void
    {

    }//end string_types()


    /**
     * String types complex
     *
     * @param '\'' $stringwithescape
     *
     * @return void
     */
    public function string_types_complex(string $stringwithescape): void
    {

    }//end string_types_complex()


    /**
     * Array types
     *
     * @param TypesValid[]|array<TypesValid>|array<int, string>                                  $genarray1
     * @param non-empty-array<TypesValid>|non-empty-array<int, TypesValid>                       $genarray2
     * @param list<TypesValid>|non-empty-list<TypesValid>                                        $list
     * @param array{'foo': int, "bar": string}|array{'foo': int, "bar"?: string}|array{int, int} $shapes1
     * @param array{0: int, 1?: int}|array{foo: int, bar: string}                                $shapes2
     *
     * @return void
     */
    public function array_types(array $genarray1, array $genarray2, array $list,
        array $shapes1, array $shapes2
    ): void {

    }//end array_types()


    /**
     * Array types complex
     *
     * @param array<array-key, string> $genarray3
     *
     * @return void
     */
    public function array_types_complex(array $genarray3): void
    {

    }//end array_types_complex()


    /**
     * Object types
     *
     * @param object                                                               $object
     * @param object{'foo': int, "bar": string}|object{'foo': int, "bar"?: string} $shapes1
     * @param object{foo: int, bar?: string}                                       $shapes2
     * @param TypesValid                                                           $class
     * @param self|parent|static|$this                                             $relative
     * @param Traversable<int>|Traversable<int, int>                               $traversable1
     * @param \Closure|\Closure(int, int): string                                  $closure
     *
     * @return void
     */
    public function object_types(object $object, object $shapes1, object $shapes2, object $class,
        object $relative, object $traversable1, object $closure
    ): void {

    }//end object_types()


    /**
     * Object types complex
     *
     * @param Traversable<1|2, TypesValid|TypesValidInterface>|Traversable<TypesValid::INT_*, string> $traversable2
     *
     * @return void
     */
    public function object_types_complex(object $traversable2): void
    {

    }//end object_types_complex()


    /**
     * Never type
     *
     * @return never|never-return|never-returns|no-return
     */
    public function never_type()
    {
        throw new \Exception();

    }//end never_type()


    /**
     * Null type
     *
     * @param null $standalonenull
     * @param ?int $explicitnullable
     * @param ?int $implicitnullable
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
     * @param callable|callable(int, int): string|callable(int, int=): string $callable1
     * @param callable(int $foo, string $bar): void                           $callable2
     * @param callable(float ...$floats): (int|null)|callable(object&): ?int  $callable3
     * @param \Closure|\Closure(int, int): string                             $closure
     * @param callable-string                                                 $callablestring
     *
     * @return void
     */
    public function callable_types(callable $callable1, callable $callable2, callable $callable3,
        callable $closure, callable $callablestring
    ): void {

    }//end callable_types()


    /**
     * Iterable types
     *
     * @param array<int>                                           $array
     * @param iterable<TypesValid>|iterable<int, TypesValid>       $iterable1
     * @param Traversable<TypesValid>|Traversable<int, TypesValid> $traversable1
     *
     * @return void
     */
    public function iterable_types(iterable $array, iterable $iterable1, iterable $traversable1): void
    {

    }//end iterable_types()


    /**
     * Iterable types complex
     *
     * @param iterable<1|2, TypesValid>|iterable<TypesValid::INT_*, string>       $iterable2
     * @param Traversable<1|2, TypesValid>|Traversable<TypesValid::INT_*, string> $traversable2
     *
     * @return void
     */
    public function iterable_types_complex(iterable $iterable2, iterable $traversable2): void
    {

    }//end iterable_types_complex()


    /**
     * Key and value of
     *
     * @param key-of<TypesValid::ARRAY_CONST>   $keyof1
     * @param value-of<TypesValid::ARRAY_CONST> $valueof1
     *
     * @return void
     */
    public function key_and_value_of(int $keyof1, string $valueof1): void
    {

    }//end key_and_value_of()


    /**
     * Key and value of complex
     *
     * @param key-of<TypesValid::ARRAY_CONST|array<int, string>>   $keyof2
     * @param value-of<TypesValid::ARRAY_CONST|array<int, string>> $valueof2
     *
     * @return void
     */
    public function key_and_value_of_complex(int $keyof2, string $valueof2): void
    {

    }//end key_and_value_of_complex()


    /**
     * Conditional return types
     *
     * @param int $size
     *
     * @return ($size is positive-int ? non-empty-array<string> : array<string>)
     */
    public function conditional_return(int $size): array
    {
        if ($size > 0) {
            return array_fill(0, $size, 'entry');
        } else {
            return [];
        }

    }//end conditional_return()


    /**
     * Conditional return types complex 1
     *
     * @param TypesValid::INT_*|TypesValid::STRING_* $x
     *
     * @return ($x is TypesValid::INT_* ? TypesValid::INT_* : TypesValid::STRING_*)
     */
    public function conditional_return_complex_1($x)
    {
        return $x;

    }//end conditional_return_complex_1()


    /**
     * Conditional return types complex 2
     *
     * @param 1|2|'Hello'|'World' $x
     *
     * @return ($x is 1|2 ? 1|2 : 'Hello'|'World')
     */
    public function conditional_return_complex_2($x)
    {
        return $x;

    }//end conditional_return_complex_2()


    /**
     * Constant enumerations
     *
     * @param TypesValid::BOOL_FALSE|TypesValid::BOOL_TRUE|TypesValid::BOOL_* $bool
     * @param TypesValid::INT_ONE                                             $int1
     * @param TypesValid::INT_ONE|TypesValid::INT_TWO                         $int2
     * @param self::INT_*                                                     $int3
     * @param TypesValid::*                                                   $mixed
     * @param TypesValid::FLOAT_1_0|TypesValid::FLOAT_2_0                     $float
     * @param TypesValid::STRING_HELLO                                        $string
     * @param TypesValid::ARRAY_CONST                                         $array
     *
     * @return void
     */
    public function constant_enumerations(bool $bool, int $int1, int $int2, int $int3, $mixed,
        float $float, string $string, array $array
    ): void {

    }//end constant_enumerations()


    /**
     * Basic structure
     *
     * @param ?int                                          $nullable
     * @param int|string                                    $union
     * @param TypesValid&object{additionalproperty: string} $intersection
     * @param (int)                                         $brackets
     * @param int[]                                         $arraysuffix
     *
     * @return void
     */
    public function basic_structure(
        ?int $nullable,
        $union,
        object $intersection,
        int $brackets,
        array $arraysuffix
    ): void {

    }//end basic_structure()


    /**
     * Structure combinations
     *
     * @param int|float|string                                                $multipleunion
     * @param TypesValid&object{additionalproperty: string}&\Traversable<int> $multipleintersection
     * @param ((int))                                                         $multiplebracket
     * @param int[][]                                                         $multiplearray
     * @param ?(int)                                                          $nullablebracket1
     * @param (?int)                                                          $nullablebracket2
     * @param ?int[]                                                          $nullablearray
     * @param (int|float)                                                     $unionbracket1
     * @param int|(float)                                                     $unionbracket2
     * @param int|int[]                                                       $unionarray
     * @param (TypesValid&object{additionalproperty: string})                 $intersectionbracket1
     * @param TypesValid&(object{additionalproperty: string})                 $intersectionbracket2
     * @param (int)[]                                                         $bracketarray1
     * @param (int[])                                                         $bracketarray2
     * @param int|(TypesValid&object{additionalproperty: string})             $dnf
     *
     * @return void
     */
    public function structure_combos(
        $multipleunion,
        object $multipleintersection,
        int $multiplebracket,
        array $multiplearray,
        ?int $nullablebracket1,
        ?int $nullablebracket2,
        ?array $nullablearray,
        $unionbracket1,
        $unionbracket2,
        $unionarray,
        object $intersectionbracket1,
        object $intersectionbracket2,
        array $bracketarray1,
        array $bracketarray2,
        $dnf
    ): void {

    }//end structure_combos()


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
     * @param Traversable<string>|Iterator|Generator|IteratorAggregate  $traversable
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
     * @param Iterator|SeekableIterator<int, string>|ArrayIterator $iterator
     * @param SeekableIterator<int, string>|ArrayIterator          $seekableiterator
     * @param Countable|ArrayIterator                              $countable
     *
     * @return void
     */
    public function spl_classes(
        Iterator $iterator, SeekableIterator $seekableiterator, Countable $countable
    ): void {

    }//end spl_classes()


}//end class
