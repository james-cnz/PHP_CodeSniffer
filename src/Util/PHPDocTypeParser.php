<?php
/**
 * PHPDoc type parser
 *
 * Checks that PHPDoc types are well formed, and returns a simplified version if so, or null otherwise.
 * Global constants and the Collection|Type[] construct aren't supported.
 *
 * @author    James Calder <jeg+accounts.github@cloudy.kiwi.nz>
 * @copyright 2023-2024 Otago Polytechnic
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 *            CC BY-SA v4 or later
 */

declare(strict_types=1);

namespace PHP_CodeSniffer\Util;

/**
 * PHPDoc type parser
 */
class PHPDocTypeParser
{

    /**
     * Predefined and SPL classes.
     *
     * @var array<string, string[]>
     */
    protected $library = [
        // Predefined general.
        '\\ArrayAccess'                     => [],
        '\\BackedEnum'                      => ['\\UnitEnum'],
        '\\Closure'                         => ['callable'],
        '\\Directory'                       => [],
        '\\Fiber'                           => [],
        '\\php_user_filter'                 => [],
        '\\SensitiveParameterValue'         => [],
        '\\Serializable'                    => [],
        '\\stdClass'                        => [],
        '\\Stringable'                      => [],
        '\\UnitEnum'                        => [],
        '\\WeakReference'                   => [],
        // Predefined iterables.
        '\\Generator'                       => ['\\Iterator'],
        '\\InternalIterator'                => ['\\Iterator'],
        '\\Iterator'                        => ['\\Traversable'],
        '\\IteratorAggregate'               => ['\\Traversable'],
        '\\Traversable'                     => ['iterable'],
        '\\WeakMap'                         => [
            '\\ArrayAccess',
            '\\Countable',
            '\\Iteratoraggregate',
        ],
        // Predefined throwables.
        '\\ArithmeticError'                 => ['\\Error'],
        '\\AssertionError'                  => ['\\Error'],
        '\\CompileError'                    => ['\\Error'],
        '\\DivisionByZeroError'             => ['\\ArithmeticError'],
        '\\Error'                           => ['\\Throwable'],
        '\\ErrorException'                  => ['\\Exception'],
        '\\Exception'                       => ['\\Throwable'],
        '\\ParseError'                      => ['\\CompileError'],
        '\\Throwable'                       => ['\\Stringable'],
        '\\TypeError'                       => ['\\Error'],
        // SPL Data structures.
        '\\SplDoublyLinkedList'             => [
            '\\Iterator',
            '\\Countable',
            '\\ArrayAccess',
            '\\Serializable',
        ],
        '\\SplStack'                        => ['\\SplDoublyLinkedList'],
        '\\SplQueue'                        => ['\\SplDoublyLinkedList'],
        '\\SplHeap'                         => [
            '\\Iterator',
            '\\Countable',
        ],
        '\\SplMaxHeap'                      => ['\\SplHeap'],
        '\\SplMinHeap'                      => ['\\SplHeap'],
        '\\SplPriorityQueue'                => [
            '\\Iterator',
            '\\Countable',
        ],
        '\\SplFixedArray'                   => [
            '\\IteratorAggregate',
            '\\ArrayAccess',
            '\\Countable',
            '\\JsonSerializable',
        ],
        '\\Splobjectstorage'                => [
            '\\Countable',
            '\\Iterator',
            '\\Serializable',
            '\\Arrayaccess',
        ],
        // SPL iterators.
        '\\AppendIterator'                  => ['\\IteratorIterator'],
        '\\ArrayIterator'                   => [
            '\\SeekableIterator',
            '\\ArrayAccess',
            '\\Serializable',
            '\\Countable',
        ],
        '\\CachingIterator'                 => [
            '\\IteratorIterator',
            '\\ArrayAccess',
            '\\Countable',
            '\\Stringable',
        ],
        '\\CallbackFilterIterator'          => ['\\FilterIterator'],
        '\\DirectoryIterator'               => [
            '\\SplFileInfo',
            '\\SeekableIterator',
        ],
        '\\EmptyIterator'                   => ['\\Iterator'],
        '\\FilesystemIterator'              => ['\\DirectoryIterator'],
        '\\FilterIterator'                  => ['\\IteratorIterator'],
        '\\GlobalIterator'                  => [
            '\\FilesystemIterator',
            '\\Countable',
        ],
        '\\InfiniteIterator'                => ['\\IteratorIterator'],
        '\\IteratorIterator'                => ['\\OuterIterator'],
        '\\LimitIterator'                   => ['\\IteratorIterator'],
        '\\MultipleIterator'                => ['\\Iterator'],
        '\\NoRewindIterator'                => ['\\IteratorIterator'],
        '\\ParentIterator'                  => ['\\RecursiveFilterIterator'],
        '\\RecursiveArrayIterator'          => [
            '\\ArrayIterator',
            '\\RecursiveIterator',
        ],
        '\\RecursiveCachingIterator'        => [
            '\\CachingIterator',
            '\\RecursiveIterator',
        ],
        '\\RecursiveCallbackFilterIterator' => [
            '\\CallbackFilterIterator',
            '\\RecursiveIterator',
        ],
        '\\RecursiveDirectoryIterator'      => [
            '\\FilesystemIterator',
            '\\RecursiveIterator',
        ],
        '\\RecursiveFilterIterator'         => [
            '\\FilterIterator',
            '\\RecursiveIterator',
        ],
        '\\RecursiveIteratorIterator'       => ['\\OuterIterator'],
        '\\RecursiveRegexIterator'          => [
            '\\RegexIterator',
            '\\RecursiveIterator',
        ],
        '\\RecursiveTreeIterator'           => ['\\RecursiveIteratorIterator'],
        '\\RegexIterator'                   => ['\\FilterIterator'],
        // SPL interfaces.
        '\\Countable'                       => [],
        '\\OuterIterator'                   => ['\\Iterator'],
        '\\RecursiveIterator'               => ['\\Iterator'],
        '\\SeekableIterator'                => ['\\Iterator'],
        // SPL exceptions.
        '\\BadFunctionCallException'        => ['\\LogicException'],
        '\\BadMethodCallException'          => ['\\BadFunctionCallException'],
        '\\DomainException'                 => ['\\LogicException'],
        '\\InvalidArgumentException'        => ['\\LogicException'],
        '\\LengthException'                 => ['\\LogicException'],
        '\\LogicException'                  => ['\\Exception'],
        '\\OutOfBoundsException'            => ['\\RuntimeException'],
        '\\OutOfRangeException'             => ['\\LogicException'],
        '\\OverflowException'               => ['\\RuntimeException'],
        '\\RangeException'                  => ['\\RuntimeException'],
        '\\RuntimeException'                => ['\\Exception'],
        '\\UnderflowException'              => ['\\RuntimeException'],
        '\\UnexpectedValueException'        => ['\\RuntimeException'],
        // SPL file handling.
        '\\SplFileInfo'                     => ['\\Stringable'],
        '\\SplFileObject'                   => [
            '\\SplFileInfo',
            '\\RecursiveIterator',
            '\\SeekableIterator',
        ],
        '\\SplTempFileObject'               => ['\\SplFileObject'],
        // SPL misc.
        '\\ArrayObject'                     => [
            '\\IteratorAggregate',
            '\\ArrayAccess',
            '\\Serializable',
            '\\Countable',
        ],
        '\\SplObserver'                     => [],
        '\\SplSubject'                      => [],
    ];

    /**
     * Inheritance heirarchy.
     *
     * @var array<string, object{extends: ?string, implements: string[]}>
     */
    protected $artifacts;

    /**
     * Scope.
     *
     * @var object{namespace: string, uses: string[], templates: string[], classname: ?string, parentname: ?string}
     */
    protected $scope;

    /**
     * The text to be parsed.
     *
     * @var string
     */
    protected $text = '';

    /**
     * Replacements.
     *
     * @var array<object{pos: non-negative-int, len: non-negative-int, replacement: string}>
     */
    protected $replacements = [];

    /**
     * When we encounter an unknown type, what should we use?
     *
     * @var string
     */
    protected $unknown = 'never';

    /**
     * Whether the type complies with the PHP-FIG PHPDoc standard.
     *
     * @var boolean
     */
    protected $phpfig = true;

    /**
     * Next tokens.
     *
     * @var object{startpos: non-negative-int, endpos: non-negative-int, text: ?string}[]
     */
    protected $nexts = [];

    /**
     * The next token.
     *
     * @var ?string
     */
    protected $next = null;


    /**
     * Constructor
     *
     * @param ?array<string, object{extends: ?string, implements: string[]}> $artifacts Classish things
     */
    public function __construct(?array $artifacts=null)
    {
        $this->artifacts = ($artifacts ?? []);

    }//end __construct()


    /**
     * Parse a type and possibly variable name
     *
     * @param ?object{
     *              namespace: string, uses: string[], templates: string[], classname: ?string, parentname: ?string
     *          }      $scope   the scope
     * @param string   $text    the text to parse
     * @param 0|1|2|3  $getwhat what to get 0=type only 1=also name 2=also modifiers (& ...) 3=also default
     * @param bool     $gowide  if we can't determine the type, should we assume wide (for native type) or narrow (for PHPDoc)?
     *
     * @return object{
     *              type: ?string, passsplat: string, name: ?string,
     *              rem: string, fixed: ?string, phpfig: bool
     *          } the simplified type, pass by reference & splat, variable name, remaining text, fixed text, and whether PHP-FIG
     */
    public function parseTypeAndName(?object $scope, string $text, int $getwhat, bool $gowide): object
    {

        // Initialise variables.
        if ($scope !== null) {
            $this->scope = $scope;
        } else {
            $this->scope = (object) [
                'namespace'  => '',
                'uses'       => [],
                'templates'  => [],
                'classname'  => null,
                'parentname' => null,
            ];
        }

        $this->text         = $text;
        $this->replacements = [];
        if ($gowide === true) {
            $this->unknown = 'mixed';
        } else {
            $this->unknown = 'never';
        }

        $this->phpfig       = true;
        $this->nexts        = [];
        $this->next         = $this->next();

        // Try to parse type.
        $savednexts = $this->nexts;
        try {
            $type = $this->parseAnyType();
            if (($this->next === null
                || ctype_space(substr($this->text, ($this->nexts[0]->startpos - 1), 1)) === true
                || in_array($this->next, [',', ';', ':', '.']) === true) === false
            ) {
                // Code smell check.
                throw new \Exception('Warning parsing type, no space after type.');
            }
        } catch (\Exception $e) {
            $this->nexts  = $savednexts;
            $this->next   = $this->next();
            $type         = null;
            $this->phpfig = true;
        }

        // Try to parse pass by reference and splat.
        $passsplat = '';
        if ($getwhat >= 2) {
            if ($this->next === '&') {
                $passsplat .= $this->parseToken('&');
            }

            if ($this->next === '...') {
                $passsplat .= $this->parseToken('...');
            }
        }

        // Try to parse name and default value.
        if ($getwhat >= 1) {
            $savednexts = $this->nexts;
            try {
                if (($this->next !== null && $this->next[0] === '$') === false) {
                    throw new \Exception("Error parsing type, expected variable, saw \"{$this->next}\".");
                }

                $name = $this->parseToken();
                if (($this->next === null
                    || ($getwhat >= 3 && $this->next === '=')
                    || ctype_space(substr($this->text, ($this->nexts[0]->startpos - 1), 1)) === true
                    || in_array($this->next, [',', ';', ':', '.']) === true) === false
                ) {
                    // Code smell check.
                    throw new \Exception('Warning parsing type, no space after variable name.');
                }

                // Implicit nullable
                if ($getwhat >= 3) {
                    if ($this->next === '='
                        && strtolower(($this->next(1) ?? '')) === 'null'
                        && strtolower(trim(substr($text, $this->nexts[1]->startpos))) === 'null'
                        && $type !== null && $type !== 'mixed'
                    ) {
                        $type = $type.'|null';
                    }
                }
            } catch (\Exception $e) {
                $this->nexts = $savednexts;
                $this->next  = $this->next();
                $name        = null;
            }//end try
        } else {
            $name = null;
        }//end if

        if ($type !== null) {
            $fixed = $this->getFixed();
        } else {
            $fixed = null;
        }

        return (object) [
            'type'      => $type,
            'passsplat' => $passsplat,
            'name'      => $name,
            'rem'       => trim(substr($text, $this->nexts[0]->startpos)),
            'fixed'     => $fixed,
            'phpfig'    => $this->phpfig,
        ];

    }//end parseTypeAndName()


    /**
     * Parse a template
     *
     * @param ?object{
     *              namespace: string, uses: string[], templates: string[], classname: ?string, parentname: ?string
     *          }    $scope the scope
     * @param string $text  the text to parse
     *
     * @return object{
     *              type: ?string, name: ?string, rem: string, fixed: ?string, phpfig: bool
     *          } the simplified type, template name, remaining text, fixed text, and whether PHP-FIG
     */
    public function parseTemplate(?object $scope, string $text): object
    {

        // Initialise variables.
        if ($scope !== null) {
            $this->scope = $scope;
        } else {
            $this->scope = (object) [
                'namespace'  => '',
                'uses'       => [],
                'templates'  => [],
                'classname'  => null,
                'parentname' => null,
            ];
        }

        $this->text         = $text;
        $this->replacements = [];
        $this->unknown      = 'never';
        $this->phpfig       = true;
        $this->nexts        = [];
        $this->next         = $this->next();

        // Try to parse template name.
        $savednexts = $this->nexts;
        try {
            if (($this->next !== null && (ctype_alpha($this->next[0]) === true || $this->next[0] === '_')) === false) {
                throw new \Exception("Error parsing type, expected variable, saw \"{$this->next}\".");
            }

            $name = $this->parseToken();
            if (($this->next === null
                || ctype_space(substr($this->text, ($this->nexts[0]->startpos - 1), 1)) === true
                || in_array($this->next, [',', ';', ':', '.']) === true) === false
            ) {
                // Code smell check.
                throw new \Exception('Warning parsing type, no space after variable name.');
            }
        } catch (\Exception $e) {
            $this->nexts = $savednexts;
            $this->next  = $this->next();
            $name        = null;
        }

        if ($this->next === 'of' || $this->next === 'as') {
            $this->parseToken();
            // Try to parse type.
            $savednexts = $this->nexts;
            try {
                $type = $this->parseAnyType();
                if (($this->next === null
                    || ctype_space(substr($this->text, ($this->nexts[0]->startpos - 1), 1)) === true
                    || in_array($this->next, [',', ';', ':', '.']) === true) === false
                ) {
                    // Code smell check.
                    throw new \Exception('Warning parsing type, no space after type.');
                }
            } catch (\Exception $e) {
                $this->nexts  = $savednexts;
                $this->next   = $this->next();
                $type         = null;
                $this->phpfig = true;
            }
        } else {
            $type = 'mixed';
        }//end if

        if ($type !== null) {
            $fixed = $this->getFixed();
        } else {
            $fixed = null;
        }

        return (object) [
            'type'   => $type,
            'name'   => $name,
            'rem'    => trim(substr($text, $this->nexts[0]->startpos)),
            'fixed'  => $fixed,
            'phpfig' => $this->phpfig,
        ];

    }//end parseTemplate()


    /**
     * Compare types
     *
     * @param ?string $widetype   the type that should be wider, e.g. PHP type
     * @param ?string $narrowtype the type that should be narrower, e.g. PHPDoc type
     *
     * @return bool whether $narrowtype has the same or narrower scope as $widetype
     */
    public function compareTypes(?string $widetype, ?string $narrowtype): bool
    {
        if ($narrowtype === null) {
            return false;
        } else if ($widetype === null || $widetype === 'mixed' || $narrowtype === 'never') {
            return true;
        }

        $wideintersections   = explode('|', $widetype);
        $narrowintersections = explode('|', $narrowtype);

        // We have to match all narrow intersections.
        $haveallintersections = true;
        foreach ($narrowintersections as $narrowintersection) {
            $narrowsingles = explode('&', $narrowintersection);

            // If the wide types are super types, that should match.
            $narrowadditions = [];
            foreach ($narrowsingles as $narrowsingle) {
                assert($narrowsingle !== '');
                $supertypes      = $this->superTypes($narrowsingle);
                $narrowadditions = array_merge($narrowadditions, $supertypes);
            }

            $narrowsingles = array_merge($narrowsingles, $narrowadditions);
            sort($narrowsingles);
            $narrowsingles = array_unique($narrowsingles);

            // We need to look in each wide intersection.
            $havethisintersection = false;
            foreach ($wideintersections as $wideintersection) {
                $widesingles = explode('&', $wideintersection);

                // And find all parts of one of them.
                $haveallsingles = true;
                foreach ($widesingles as $widesingle) {
                    if (in_array($widesingle, $narrowsingles) === false) {
                        $haveallsingles = false;
                        break;
                    }
                }

                if ($haveallsingles === true) {
                    $havethisintersection = true;
                    break;
                }
            }

            if ($havethisintersection === false) {
                $haveallintersections = false;
                break;
            }
        }//end foreach

        return $haveallintersections;

    }//end compareTypes()


    /**
     * Get super types
     *
     * @param string $basetype What type do we want the supers for?
     *
     * @return string[] super types
     */
    protected function superTypes(string $basetype): array
    {
        if (in_array($basetype, ['int', 'string']) === true) {
            $supertypes = [
                'array-key',
                'scaler',
            ];
        } else if ($basetype === 'callable-string') {
            $supertypes = [
                'callable',
                'string',
                'array-key',
                'scalar',
            ];
        } else if (in_array($basetype, ['array-key', 'float', 'bool']) === true) {
            $supertypes = ['scalar'];
        } else if ($basetype === 'array') {
            $supertypes = ['iterable'];
        } else if ($basetype === 'static') {
            $supertypes = [
                'self',
                'parent',
                'object',
            ];
        } else if ($basetype === 'self') {
            $supertypes = [
                'parent',
                'object',
            ];
        } else if ($basetype === 'parent') {
            $supertypes = ['object'];
        } else if (strpos($basetype, 'static(') === 0 || $basetype[0] === '\\') {
            if (strpos($basetype, 'static(') === 0) {
                $supertypes     = [
                    'static',
                    'self',
                    'parent',
                    'object',
                ];
                $supertypequeue = [substr($basetype, 7, -1)];
                $ignore         = false;
            } else {
                $supertypes     = ['object'];
                $supertypequeue = [$basetype];
                $ignore         = true;
                // We don't want to include the class itself, just super types of it.
            }

            while (($supertype = array_shift($supertypequeue)) !== null) {
                if (in_array($supertype, $supertypes) === true) {
                    $ignore = false;
                    continue;
                }

                if ($ignore === false) {
                    $supertypes[] = $supertype;
                }

                if (($librarysupers = $this->library[$supertype] ?? null) !== null) {
                    $supertypequeue = array_merge($supertypequeue, $librarysupers);
                } else if (($supertypeobj = ($this->artifacts[$supertype] ?? null)) !== null) {
                    if ($supertypeobj->extends !== null) {
                        $supertypequeue[] = $supertypeobj->extends;
                    }

                    if (count($supertypeobj->implements) > 0) {
                        foreach ($supertypeobj->implements as $implements) {
                            $supertypequeue[] = $implements;
                        }
                    }
                } else if ($ignore === false) {
                    $supertypes = array_merge($supertypes, $this->superTypes($supertype));
                }

                $ignore = false;
            }//end while

            $supertypes = array_unique($supertypes);
        } else {
            $supertypes = [];
        }//end if

        return $supertypes;

    }//end superTypes()


    /**
     * Prefetch next token
     *
     * @param non-negative-int $lookahead How far ahead is the token we want?
     *
     * @return         ?string
     * @phpstan-impure
     */
    protected function next(int $lookahead=0): ?string
    {

        // Fetch any more tokens we need.
        while (count($this->nexts) < ($lookahead + 1)) {
            if (count($this->nexts) > 0) {
                $startpos = end($this->nexts)->endpos;
            } else {
                $startpos = 0;
            }

            $stringunterminated = false;

            // Ignore whitespace.
            while ($startpos < strlen($this->text) && ctype_space($this->text[$startpos]) === true) {
                $startpos++;
            }

            if ($startpos < strlen($this->text)) {
                $firstchar = $this->text[$startpos];
            } else {
                $firstchar = null;
            }

            // Deal with different types of tokens.
            if ($firstchar === null) {
                // No more tokens.
                $endpos = $startpos;
            } else if (ctype_alpha($firstchar) === true || $firstchar === '_' || $firstchar === '$' || $firstchar === '\\'
                || ord($firstchar) >= 0x7F
            ) {
                // Identifier token.
                $endpos = $startpos;
                do {
                    $endpos = ($endpos + 1);
                    if ($endpos < strlen($this->text)) {
                        $nextchar = $this->text[$endpos];
                    } else {
                        $nextchar = null;
                    }
                } while ($nextchar !== null && (ctype_alnum($nextchar) === true || $nextchar === '_'
                                        || ord($nextchar) >= 0x7F
                                        || ($firstchar !== '$' && ($nextchar === '-' || $nextchar === '\\')))
                );
            } else if (ctype_digit($firstchar) === true
                || ($firstchar === '-' && strlen($this->text) >= ($startpos + 2) && ctype_digit($this->text[($startpos + 1)]) === true)
            ) {
                // Number token.
                $nextchar  = $firstchar;
                $havepoint = false;
                $endpos    = $startpos;
                do {
                    $havepoint = $havepoint || $nextchar === '.';
                    $endpos    = ($endpos + 1);
                    if ($endpos < strlen($this->text)) {
                        $nextchar = $this->text[$endpos];
                    } else {
                        $nextchar = null;
                    }
                } while ($nextchar !== null && (ctype_digit($nextchar) === true || ($nextchar === '.' && $havepoint === false) || $nextchar === '_'));
            } else if ($firstchar === '"' || $firstchar === "'") {
                // String token.
                $endpos = ($startpos + 1);
                if ($endpos < strlen($this->text)) {
                    $nextchar = $this->text[$endpos];
                } else {
                    $nextchar = null;
                }

                while ($nextchar !== $firstchar && $nextchar !== null) {
                    // There may be unterminated strings.
                    if ($nextchar === '\\' && strlen($this->text) >= ($endpos + 2)) {
                        $endpos = ($endpos + 2);
                    } else {
                        $endpos++;
                    }

                    if ($endpos < strlen($this->text)) {
                        $nextchar = $this->text[$endpos];
                    } else {
                        $nextchar = null;
                    }
                }

                if ($nextchar !== null) {
                    $endpos++;
                } else {
                    $stringunterminated = true;
                }
            } else if (strlen($this->text) >= ($startpos + 3) && substr($this->text, $startpos, 3) === '...') {
                // Splat.
                $endpos = ($startpos + 3);
            } else if (strlen($this->text) >= ($startpos + 2) && substr($this->text, $startpos, 2) === '::') {
                // Scope resolution operator.
                $endpos = ($startpos + 2);
            } else {
                // Other symbol token.
                $endpos = ($startpos + 1);
            }//end if

            // Store token.
            $next = substr($this->text, $startpos, ($endpos - $startpos));
            assert($next !== false);
            if ($next === '' || $stringunterminated === true) {
                // If we have an unterminated string, we've reached the end of usable tokens.
                $next = null;
            }

            $this->nexts[] = (object) [
                'startpos' => $startpos,
                'endpos'   => $endpos,
                'text'     => $next,
            ];
        }//end while

        // Return the needed token.
        return $this->nexts[$lookahead]->text;

    }//end next()


    /**
     * Fetch the next token
     *
     * @param ?string $expect the expected text, or null for any
     *
     * @return         string
     * @phpstan-impure
     */
    protected function parseToken(?string $expect=null): string
    {

        $next = $this->next;

        // Check we have the expected token.
        if ($next === null) {
            throw new \Exception('Error parsing type, unexpected end.');
        } else if ($expect !== null && strtolower($next) !== strtolower($expect)) {
            throw new \Exception("Error parsing type, expected \"{$expect}\", saw \"{$next}\".");
        }

        // Prefetch next token.
        $this->next(1);

        // Return consumed token.
        array_shift($this->nexts);
        $this->next = $this->next();
        return $next;

    }//end parseToken()


    /**
     * Correct the next token
     *
     * @param string $correct the corrected text
     *
     * @return         void
     * @phpstan-impure
     */
    protected function correctToken(string $correct): void
    {
        if ($correct !== $this->nexts[0]->text) {
            $this->replacements[] = (object) [
                'pos'         => $this->nexts[0]->startpos,
                'len'         => strlen($this->nexts[0]->text),
                'replacement' => $correct,
            ];
        }

    }//end correctToken()


    /**
     * Get the corrected text, or null if no change
     *
     * @return ?string
     */
    protected function getFixed(): ?string
    {
        if (count($this->replacements) === 0) {
            return null;
        }

        $fixedtext = $this->text;
        foreach (array_reverse($this->replacements) as $fix) {
            $fixedtext = substr($fixedtext, 0, $fix->pos).$fix->replacement.substr($fixedtext, ($fix->pos + $fix->len));
        }

        return $fixedtext;

    }//end getFixed()


    /**
     * Parse a list of types seperated by | and/or &, single nullable type, or conditional return type
     *
     * @param bool $inbrackets are we immediately inside brackets?
     *
     * @return         string the simplified type
     * @phpstan-impure
     */
    protected function parseAnyType(bool $inbrackets=false): string
    {

        if ($inbrackets === true && $this->next !== null && $this->next[0] === '$' && $this->next(1) === 'is') {
            // Conditional return type.
            $this->phpfig = false;
            $this->parseToken();
            $this->parseToken('is');
            $this->parseAnyType();
            $this->parseToken('?');
            $firsttype = $this->parseAnyType();
            $this->parseToken(':');
            $secondtype = $this->parseAnyType();
            $uniontypes = array_merge(explode('|', $firsttype), explode('|', $secondtype));
        } else if ($this->next === '?') {
            // Single nullable type.
            $this->phpfig = false;
            $this->parseToken('?');
            $uniontypes   = explode('|', $this->parseSingleType());
            $uniontypes[] = 'null';
        } else {
            // Union list.
            $uniontypes = [];
            do {
                // Intersection list.
                $unioninstead      = null;
                $intersectiontypes = [];
                do {
                    $singletype = $this->parseSingleType();
                    if (strpos($singletype, '|') !== false) {
                        $intersectiontypes[] = $this->unknown;
                        $unioninstead        = $singletype;
                    } else {
                        $intersectiontypes = array_merge($intersectiontypes, explode('&', $singletype));
                    }

                    // We have to figure out whether a & is for intersection or pass by reference.
                    $nextnext = $this->next(1);
                    $havemoreintersections = $this->next === '&'
                        && !(in_array($nextnext, ['...', '=', ',', ')', null])
                            || ($nextnext !== null && $nextnext[0] === '$'));
                    if ($havemoreintersections === true) {
                        $this->parseToken('&');
                    }
                } while ($havemoreintersections === true);
                if (count($intersectiontypes) > 1 && $unioninstead !== null) {
                    throw new \Exception('Error parsing type, non-DNF.');
                } else if (count($intersectiontypes) <= 1 && $unioninstead !== null) {
                    $uniontypes = array_merge($uniontypes, explode('|', $unioninstead));
                } else {
                    // Tidy and store intersection list.
                    if (count($intersectiontypes) > 1) {
                        foreach ($intersectiontypes as $intersectiontype) {
                            assert($intersectiontype !== '');
                            $supertypes = $this->superTypes($intersectiontype);
                            if ((in_array($intersectiontype, ['object', 'iterable', 'callable']) === true
                                || in_array('object', $supertypes) === true) === false
                            ) {
                                throw new \Exception('Error parsing type, intersection can only be used with objects.');
                            }

                            foreach ($supertypes as $supertype) {
                                $superpos = array_search($supertype, $intersectiontypes);
                                if ($superpos !== false) {
                                    unset($intersectiontypes[$superpos]);
                                }
                            }
                        }

                        sort($intersectiontypes);
                        $intersectiontypes = array_unique($intersectiontypes);
                        $neverpos          = array_search('never', $intersectiontypes);
                        if ($neverpos !== false) {
                            $intersectiontypes = ['never'];
                        }

                        $mixedpos = array_search('mixed', $intersectiontypes);
                        if ($mixedpos !== false && count($intersectiontypes) > 1) {
                            unset($intersectiontypes[$mixedpos]);
                        }
                    }//end if

                    array_push($uniontypes, implode('&', $intersectiontypes));
                }//end if
                // Check for more union items.
                $havemoreunions = $this->next === '|';
                if ($havemoreunions === true) {
                    $this->parseToken('|');
                }
            } while ($havemoreunions === true);
        }//end if

        // Tidy and return union list.
        if (count($uniontypes) > 1) {
            if (in_array('int', $uniontypes) === true && in_array('string', $uniontypes) === true) {
                $uniontypes[] = 'array-key';
            }

            if (in_array('bool', $uniontypes) === true && in_array('float', $uniontypes) === true && in_array('array-key', $uniontypes) === true) {
                $uniontypes[] = 'scalar';
            }

            if (in_array('\\Traversable', $uniontypes) === true && in_array('array', $uniontypes) === true) {
                $uniontypes[] = 'iterable';
            }

            sort($uniontypes);
            $uniontypes = array_unique($uniontypes);
            $mixedpos   = array_search('mixed', $uniontypes);
            if ($mixedpos !== false) {
                $uniontypes = ['mixed'];
            }

            $neverpos = array_search('never', $uniontypes);
            if ($neverpos !== false && count($uniontypes) > 1) {
                unset($uniontypes[$neverpos]);
            }

            foreach ($uniontypes as $uniontype) {
                assert($uniontype !== '');
                foreach ($uniontypes as $key => $uniontype2) {
                    assert($uniontype2 !== '');
                    if ($uniontype2 !== $uniontype && $this->compareTypes($uniontype, $uniontype2) === true) {
                        unset($uniontypes[$key]);
                    }
                }
            }
        }//end if

        $type = implode('|', $uniontypes);
        assert($type !== '');
        return $type;

    }//end parseAnyType()


    /**
     * Parse a single type, possibly array type
     *
     * @return         string the simplified type
     * @phpstan-impure
     */
    protected function parseSingleType(): string
    {
        if ($this->next === '(') {
            $this->parseToken('(');
            $type = $this->parseAnyType(true);
            $this->parseToken(')');
        } else {
            $type = $this->parseBasicType();
        }

        while ($this->next === '[' && $this->next(1) === ']') {
            // Array suffix.
            $this->parseToken('[');
            $this->parseToken(']');
            $type = 'array';
        }

        return $type;

    }//end parseSingleType()


    /**
     * Parse a basic type
     *
     * @return         string the simplified type
     * @phpstan-impure
     */
    protected function parseBasicType(): string
    {

        $next = $this->next;
        if ($next === null) {
            throw new \Exception('Error parsing type, expected type, saw end.');
        }

        $lowernext = strtolower($next);
        $nextchar  = $next[0];

        if (in_array($lowernext, ['bool', 'boolean', 'true', 'false']) === true) {
            // Bool.
            if ($lowernext === 'boolean') {
                $this->correctToken('bool');
            } else {
                $this->correctToken($lowernext);
            }

            $this->parseToken();
            $type = 'bool';
        } else if (in_array(
            $lowernext,
            [
                'int',
                'integer',
                'positive-int',
                'negative-int',
                'non-positive-int',
                'non-negative-int',
                'int-mask',
                'int-mask-of',
            ]
        ) === true
            || ((ctype_digit($nextchar) === true || $nextchar === '-') && strpos($next, '.') === false)
        ) {
            // Int.
            if (in_array($lowernext, ['int', 'integer']) === false) {
                $this->phpfig = false;
            }

            if ($lowernext === 'integer') {
                $this->correctToken('int');
            } else {
                $this->correctToken($lowernext);
            }

            $inttype = strtolower($this->parseToken());
            if ($inttype === 'int' && $this->next === '<') {
                // Integer range.
                $this->phpfig = false;
                $this->parseToken('<');
                $next = $this->next;
                if ($next === null
                    || (strtolower($next) === 'min'
                    || ((ctype_digit($next[0]) === true || $next[0] === '-') && strpos($next, '.') === false)) === false
                ) {
                    throw new \Exception("Error parsing type, expected int min, saw \"{$next}\".");
                }

                $this->parseToken();
                $this->parseToken(',');
                $next = $this->next;
                if ($next === null
                    || (strtolower($next) === 'max'
                    || ((ctype_digit($next[0]) === true || $next[0] === '-') && strpos($next, '.') === false)) === false
                ) {
                    throw new \Exception("Error parsing type, expected int max, saw \"{$next}\".");
                }

                $this->parseToken();
                $this->parseToken('>');
            } else if ($inttype === 'int-mask') {
                // Integer mask.
                $this->parseToken('<');
                do {
                    $mask = $this->parseBasicType();
                    if ($this->compareTypes('int', $mask) === false) {
                        throw new \Exception('Error parsing type, invalid int mask.');
                    }

                    $haveseperator = $this->next === ',';
                    if ($haveseperator === true) {
                        $this->parseToken(',');
                    }
                } while ($haveseperator === true);
                $this->parseToken('>');
            } else if ($inttype === 'int-mask-of') {
                // Integer mask of.
                $this->parseToken('<');
                $mask = $this->parseBasicType();
                if ($this->compareTypes('int', $mask) === false) {
                    throw new \Exception('Error parsing type, invalid int mask.');
                }

                $this->parseToken('>');
            }//end if

            $type = 'int';
        } else if (in_array($lowernext, ['float', 'double']) === true
            || ((ctype_digit($nextchar) === true || $nextchar === '-') && strpos($next, '.') !== false)
        ) {
            // Float.
            if (in_array($lowernext, ['float', 'double']) === false) {
                $this->phpfig = false;
            }

            if ($lowernext === 'double') {
                $this->correctToken('float');
            } else {
                $this->correctToken($lowernext);
            }

            $this->parseToken();
            $type = 'float';
        } else if (in_array(
            $lowernext,
            [
                'string',
                'class-string',
                'numeric-string',
                'literal-string',
                'non-empty-string',
                'non-falsy-string',
                'truthy-string',
            ]
        ) === true
            || $nextchar === '"' || $nextchar === "'"
        ) {
            // String.
            if ($lowernext !== 'string') {
                $this->phpfig = false;
            }

            if ($nextchar !== '"' && $nextchar !== "'") {
                $this->correctToken($lowernext);
            }

            $strtype = strtolower($this->parseToken());
            if ($strtype === 'class-string' && $this->next === '<') {
                $this->parseToken('<');
                $stringtype = $this->parseBasicType();
                if ($this->compareTypes('object', $stringtype) === false) {
                    throw new \Exception("Error parsing type, class-string type isn't class.");
                }

                $this->parseToken('>');
            }

            $type = 'string';
        } else if ($lowernext === 'callable-string') {
            // Callable-string.
            $this->phpfig = false;
            $this->correctToken($lowernext);
            $this->parseToken('callable-string');
            $type = 'callable-string';
        } else if (in_array($lowernext, ['array', 'non-empty-array', 'list', 'non-empty-list']) === true) {
            // Array.
            if ($lowernext !== 'array') {
                $this->phpfig = false;
            }

            $this->correctToken($lowernext);
            $arraytype = strtolower($this->parseToken());
            if ($this->next === '<') {
                // Typed array.
                $this->phpfig = false;
                $this->parseToken('<');
                $firsttype = $this->parseAnyType();
                if ($this->next === ',') {
                    if (in_array($arraytype, ['list', 'non-empty-list']) === true) {
                        throw new \Exception('Error parsing type, lists cannot have keys specified.');
                    }

                    $key = $firsttype;
                    if ($this->compareTypes('array-key', $key) === false) {
                        throw new \Exception('Error parsing type, invalid array key.');
                    }

                    $this->parseToken(',');
                    $value = $this->parseAnyType();
                } else {
                    $key   = null;
                    $value = $firsttype;
                }

                $this->parseToken('>');
            } else if ($this->next === '{') {
                // Array shape.
                $this->phpfig = false;
                if (in_array($arraytype, ['non-empty-array', 'non-empty-list']) === true) {
                    throw new \Exception('Error parsing type, non-empty-arrays cannot have shapes.');
                }

                $this->parseToken('{');
                do {
                    $next = $this->next;
                    if ($next !== null
                        && (ctype_alpha($next) === true || $next[0] === '_' || $next[0] === "'" || $next[0] === '"'
                        || ((ctype_digit($next[0]) === true || $next[0] === '-') && strpos($next, '.') === false))
                        && ($this->next(1) === ':' || ($this->next(1) === '?' && $this->next(2) === ':'))
                    ) {
                        $this->parseToken();
                        if ($this->next === '?') {
                            $this->parseToken('?');
                        }

                        $this->parseToken(':');
                    }

                    $this->parseAnyType();
                    $havecomma = $this->next === ',';
                    if ($havecomma === true) {
                        $this->parseToken(',');
                    }
                } while ($havecomma === true);
                $this->parseToken('}');
            }//end if

            $type = 'array';
        } else if ($lowernext === 'object') {
            // Object.
            $this->correctToken($lowernext);
            $this->parseToken('object');
            if ($this->next === '{') {
                // Object shape.
                $this->phpfig = false;
                $this->parseToken('{');
                do {
                    $next = $this->next;
                    if ($next === null
                        || (ctype_alpha($next) === true || $next[0] === '_' || $next[0] === "'" || $next[0] === '"') === false
                    ) {
                        throw new \Exception('Error parsing type, invalid object key.');
                    }

                    $this->parseToken();
                    if ($this->next === '?') {
                        $this->parseToken('?');
                    }

                    $this->parseToken(':');
                    $this->parseAnyType();
                    $havecomma = $this->next === ',';
                    if ($havecomma === true) {
                        $this->parseToken(',');
                    }
                } while ($havecomma === true);
                $this->parseToken('}');
            }//end if

            $type = 'object';
        } else if ($lowernext === 'resource') {
            // Resource.
            $this->correctToken($lowernext);
            $this->parseToken('resource');
            $type = 'resource';
        } else if (in_array($lowernext, ['never', 'never-return', 'never-returns', 'no-return']) === true) {
            // Never.
            $this->correctToken('never');
            $this->parseToken();
            $type = 'never';
        } else if ($lowernext === 'null') {
            // Null.
            $this->correctToken($lowernext);
            $this->parseToken('null');
            $type = 'null';
        } else if ($lowernext === 'void') {
            // Void.
            $this->correctToken($lowernext);
            $this->parseToken('void');
            $type = 'void';
        } else if ($lowernext === 'self') {
            // Self.
            $this->correctToken($lowernext);
            $this->parseToken('self');
            $type = ($this->scope->classname ?? 'self');
        } else if ($lowernext === 'parent') {
            // Parent.
            $this->phpfig = false;
            $this->correctToken($lowernext);
            $this->parseToken('parent');
            $type = ($this->scope->parentname ?? 'parent');
        } else if (in_array($lowernext, ['static', '$this']) === true) {
            // Static.
            $this->correctToken($lowernext);
            $this->parseToken();
            if ($this->scope->classname !== null) {
                $type = "static({$this->scope->classname})";
            } else {
                $type = 'static';
            }
        } else if ($lowernext === 'callable'
            || $next === '\\Closure' || ($next === 'Closure' && $this->scope->namespace === '')
        ) {
            // Callable.
            if ($lowernext === 'callable') {
                $this->correctToken($lowernext);
            }

            $callabletype = $this->parseToken();
            if ($this->next === '(') {
                $this->phpfig = false;
                $this->parseToken('(');
                while ($this->next !== ')') {
                    $this->parseAnyType();
                    if ($this->next === '&') {
                        $this->parseToken('&');
                    }

                    if ($this->next === '...') {
                        $this->parseToken('...');
                    }

                    if ($this->next === '=') {
                        $this->parseToken('=');
                    }

                    if ($this->next !== null) {
                        $nextchar = $this->next[0];
                    } else {
                        $nextchar = null;
                    }

                    if ($nextchar === '$') {
                        $this->parseToken();
                    }

                    if ($this->next !== ')') {
                        $this->parseToken(',');
                    }
                }//end while

                $this->parseToken(')');
                $this->parseToken(':');
                if ($this->next === '?') {
                    $this->parseAnyType();
                } else {
                    $this->parseSingleType();
                }
            }//end if

            if (strtolower($callabletype) === 'callable') {
                $type = 'callable';
            } else {
                $type = '\\Closure';
            }
        } else if ($lowernext === 'mixed') {
            // Mixed.
            $this->correctToken($lowernext);
            $this->parseToken('mixed');
            $type = 'mixed';
        } else if ($lowernext === 'iterable') {
            // Iterable (Traversable|array).
            $this->correctToken($lowernext);
            $this->parseToken('iterable');
            if ($this->next === '<') {
                $this->phpfig = false;
                $this->parseToken('<');
                $firsttype = $this->parseAnyType();
                if ($this->next === ',') {
                    $key = $firsttype;
                    $this->parseToken(',');
                    $value = $this->parseAnyType();
                } else {
                    $key   = null;
                    $value = $firsttype;
                }

                $this->parseToken('>');
            }

            $type = 'iterable';
        } else if ($lowernext === 'array-key') {
            // Array-key (int|string).
            $this->phpfig = false;
            $this->correctToken($lowernext);
            $this->parseToken('array-key');
            $type = 'array-key';
        } else if ($lowernext === 'scalar') {
            // Scalar can be (bool|int|float|string).
            $this->phpfig = false;
            $this->correctToken($lowernext);
            $this->parseToken('scalar');
            $type = 'scalar';
        } else if ($lowernext === 'key-of') {
            // Key-of.
            $this->phpfig = false;
            $this->correctToken($lowernext);
            $this->parseToken('key-of');
            $this->parseToken('<');
            $iterable = $this->parseAnyType();
            if (($this->compareTypes('iterable', $iterable) === true || $this->compareTypes('object', $iterable) === true) === false) {
                throw new \Exception("Error parsing type, can't get key of non-iterable.");
            }

            $this->parseToken('>');
            $type = $this->unknown;
        } else if ($lowernext === 'value-of') {
            // Value-of.
            $this->phpfig = false;
            $this->correctToken($lowernext);
            $this->parseToken('value-of');
            $this->parseToken('<');
            $iterable = $this->parseAnyType();
            if (($this->compareTypes('iterable', $iterable) === true || $this->compareTypes('object', $iterable) === true) === false) {
                throw new \Exception("Error parsing type, can't get value of non-iterable.");
            }

            $this->parseToken('>');
            $type = $this->unknown;
        } else if ((ctype_alpha($next[0]) === true || $next[0] === '_' || $next[0] === '\\')
            && strpos($next, '-') === false && strpos($next, '\\\\') === false
        ) {
            // Class name.
            $type = $this->parseToken();
            if (strrpos($type, '\\') === (strlen($type) - 1)) {
                throw new \Exception('Error parsing type, class name has trailing slash.');
            }

            if ($type[0] !== '\\') {
                if (array_key_exists($type, $this->scope->uses) === true) {
                    $type = $this->scope->uses[$type];
                } else if (array_key_exists($type, $this->scope->templates) === true) {
                    $type = $this->scope->templates[$type];
                } else {
                    $type = $this->scope->namespace.'\\'.$type;
                }

                assert($type !== '');
            }
        } else {
            throw new \Exception('Error parsing type, unrecognised type.');
        }//end if

        // Suffixes.  We can't embed these in the class name section, because they could apply to relative classes.
        if ($this->next === '<'
            && (in_array('object', $this->superTypes($type)) === true)
        ) {
            // Generics.
            $this->phpfig = false;
            $this->parseToken('<');
            $more = false;
            do {
                $this->parseAnyType();
                $more = ($this->next === ',');
                if ($more === true) {
                    $this->parseToken(',');
                }
            } while ($more === true);
            $this->parseToken('>');
        } else if ($this->next === '::'
            && (in_array('object', $this->superTypes($type)) === true)
        ) {
            // Class constant.
            $this->phpfig = false;
            $this->parseToken('::');
            if ($this->next === null) {
                $nextchar = null;
            } else {
                $nextchar = $this->next[0];
            }

            $haveconstantname = $nextchar !== null && (ctype_alpha($nextchar) || $nextchar === '_');
            if ($haveconstantname === true) {
                $this->parseToken();
            }

            if ($this->next === '*' || $haveconstantname === false) {
                $this->parseToken('*');
            }

            $type = $this->unknown;
        }//end if

        return $type;

    }//end parseBasicType()


}//end class
