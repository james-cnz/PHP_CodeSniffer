<?php
/**
 * Unit test class for the PHPDoc Types sniff.
 *
 * @author    based on work by Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\Generic\Tests\Commenting;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the PHPDoc Types sniff.
 *
 * @covers \PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\PHPDocTypesSniff
 * @covers \PHP_CodeSniffer\Util\PHPDocTypeParser
 */
final class PHPDocTypesUnitTest extends AbstractSniffUnitTest
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
        case 'PHPDocTypesUnitTest.right.inc':
            return [];
        case 'PHPDocTypesUnitTest.right_namespace.inc':
            return [];
        case 'PHPDocTypesUnitTest.right_types.inc':
            return [];
        case 'PHPDocTypesUnitTest.wrong.inc':
            return [
                17 => 1,
                23 => 1,
                24 => 1,
                30 => 1,
                31 => 1,
                32 => 1,
                34 => 1,
                35 => 1,
                36 => 1,
                46 => 1,
                54 => 1,
                61 => 1,
                69 => 1,
                70 => 1,
                76 => 1,
                79 => 1,
                84 => 1,
            ];
        case 'PHPDocTypesUnitTest.wrong_parse.inc':
            return [
                72 => 1,
            ];
        case 'PHPDocTypesUnitTest.wrong_types.inc':
            return [
                22 => 1,
                30 => 1,
                37 => 1,
                40 => 1,
                44 => 1,
                48 => 1,
                52 => 1,
                55 => 1,
                58 => 1,
                61 => 1,
                64 => 1,
                67 => 1,
                70 => 1,
                74 => 1,
                77 => 1,
                80 => 1,
                83 => 1,
                86 => 1,
                89 => 1,
                92 => 1,
                95 => 1,
                100 => 1,
                107 => 1,
                110 => 1,
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
     * @param string $testFile The name of the file being tested.
     *
     * @return array<int, int>
     */
    public function getWarningList($testFile='')
    {
        switch ($testFile) {
            case 'PHPDocTypesUnitTest.right.inc':
                return [];
            case 'PHPDocTypesUnitTest.right_namespace.inc':
                return [];
            case 'PHPDocTypesUnitTest.right_types.inc':
                return [];
            case 'PHPDocTypesUnitTest.wrong.inc':
                return [
                    28 => 1,
                ];
            case 'PHPDocTypesUnitTest.wrong_parse.inc':
                return [];
            case 'PHPDocTypesUnitTest.wrong_types.inc':
                return [];
            default:
                return [];
            }//end switch

    }//end getWarningList()


}//end class
