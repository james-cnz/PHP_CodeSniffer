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
 * @covers \PHP_CodeSniffer\Util\PHPDocTypesUtil
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
                33 => 1,
                34 => 1,
                35 => 1,
                37 => 1,
                38 => 1,
                39 => 1,
                54 => 1,
                66 => 1,
                77 => 1,
                89 => 1,
                90 => 1,
                102 => 1,
                109 => 1,
                118 => 1,
            ];
        case 'PHPDocTypesUnitTest.wrong_parse.inc':
            return [
                132 => 1,
            ];
        case 'PHPDocTypesUnitTest.wrong_types.inc':
            return [
                24  => 1,
                37  => 1,
                50  => 1,
                57  => 1,
                64  => 1,
                71  => 1,
                78  => 1,
                84  => 1,
                91  => 1,
                98  => 1,
                105  => 1,
                112  => 1,
                119  => 1,
                126  => 1,
                133  => 1,
                140  => 1,
                147  => 1,
                154  => 1,
                161  => 1,
                168  => 1,
                175  => 1,
                183 => 1,
                196 => 1,
                203 => 1,
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
                30 => 1,
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
