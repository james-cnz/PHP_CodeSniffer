<?php
/**
 * Unit test class for the PHPDoc Type Parser utility.
 *
 * @author    based on work by Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\tests\Core\Util;

use PHP_CodeSniffer\tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the PHPDoc Type Parser utility.
 *
 * @covers \PHP_CodeSniffer\Util\PHPDocTypeParser
 */
final class PHPDocTypeParserUnitTest extends AbstractSniffUnitTest
{


    /**
     * Returns the lines where errors should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of errors that should occur on that line.
     *
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     */
    public function getErrorList($testFile='')
    {
        switch ($testFile) {
        case 'PHPDocTypeParserUnitTest.right.inc':
            return [];
        case 'PHPDocTypeParserUnitTest.wrong.inc':
            return [
                21 => 1,
                29 => 1,
                36 => 1,
                39 => 1,
                43 => 1,
                47 => 1,
                51 => 1,
                54 => 1,
                57 => 1,
                60 => 1,
                63 => 1,
                66 => 1,
                69 => 1,
                73 => 1,
                76 => 1,
                79 => 1,
                82 => 1,
                85 => 1,
                88 => 1,
                91 => 1,
                94 => 1,
                99 => 1,
                106 => 1,
                109 => 1,
            ];
        default:
            return [];
        }//end switch

    }//end getErrorList()


    /**
     * Returns the lines where warnings should occur.
     *
     * The key of the array should represent the line number and the value
     * should represent the number of warnings that should occur on that line.
     *
     * @return array<int, int>
     */
    public function getWarningList()
    {
        return [];

    }//end getWarningList()


}//end class
