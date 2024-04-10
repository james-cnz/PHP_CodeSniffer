<?php
/**
 * Unit test class for the PHPDoc Types sniff.
 *
 * @author    based on work by Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/PHPCSStandards/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Standards\PSR5\Tests\Commenting;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the PHPDoc Types sniff.
 *
 * @covers \PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\PHPDocTypesSniff
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
        return [];

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
        switch ($testFile) {
            case 'PHPDocTypesUnitTest.right.inc':
                return [];
            case 'PHPDocTypesUnitTest.warn_complex.inc':
                return [
                    23 => 1,
                    24 => 1,
                    30 => 1,
                    35 => 1,
                ];
            case 'PHPDocTypesUnitTest.warn_docs_missing.inc':
                return [
                    21 => 1,
                    24 => 2,
                    33 => 1,
                    35 => 1,
                ];
            case 'PHPDocTypesUnitTest.warn_style.inc':
                return [
                    18 => 1,
                    23 => 1,
                    24 => 1,
                    25 => 1,
                    31 => 1,
                    34 => 1,
                    38 => 1,
                    45 => 1,
                ];
            default:
                return [];
            }//end switch

    }//end getWarningList()


}//end class
