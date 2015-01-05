<?php
/**
 * SearchStringParserTest.php
 *
 * PHPUnit tests for SearchStringParser
 *
 * php 5.3+
 *
 * @category  None
 * @package   League\Floor9design\SearchStringParser
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.9
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 *
 */

/**
 * Class SearchStringParserTest
 *
 * Provides a set of testing tools for the SearchStringParser class.
 *
 * @category  None
 * @package   League\Floor9design\SearchStringParser\
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.9
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 */
class SearchStringParserTest extends PHPUnit_Framework_TestCase {

    /**
     * Set up object for testing
     */
    function setUp() {
        $this->ssp = new League\Floor9design\SearchStringParser\SearchStringParser();
    }

    /**
     * Clear object after use
     */
    function tearDown() {
        unset($this->ssp);
    }

    /**
     * Tests accessors (gets and sets)
     * Has to run a parse to call setSearchString.
     * Does not check parse response.
     *
     * covers SearchStringParser::getSearchStrings
     * covers SearchStringParser::setSearchStrings
     */
    public function testAccessors()
    {
        // Arrange
        $test_string = 'hello';
        $this->ssp->parse($test_string);

        // Act
        $test_result = $this->ssp->getSearchStrings();

        // Assert
        $this->assertEquals($test_string, $test_result);
    }

    /**
     * Tests parsing a string
     * Uses a single word
     */
    public function testParseStringSingleWord()
    {
        // Arrange
        $test_string = 'hello';
        $expected_result = array(0 => 'hello');

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing a string
     * Uses multiple words
     */
    public function testParseStringMultiWord()
    {
        // Arrange
        $test_string = 'hello world';
        $expected_result = array(
            0 => 'hello',
            1 => 'world'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing an array
     * Uses single words
     */
    public function testParseArraySingleWord()
    {
        // Arrange
        $test_string = array(
            0 => 'hello',
            1 => 'world'
        );
        $expected_result = array(
            0 => 'hello',
            1 => 'world'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing an int
     * Uses a single int
     */
    public function testParseIntSingle()
    {
        // Arrange
        $test_string = 3;
        $expected_result = array(0 => '3');

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing a set of floats
     * Uses a single word
     */
    public function testParseFloatMulti()
    {
        // Arrange
        $test_string = array(
            0 => 3.23,
            1 => -14.23
        );
        $expected_result = array(
            0 => '3.23',
            1 => '-14.23'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing a literal string
     * Uses a literal multi-word string
     */
    public function testParseStringLiteral()
    {
        // Arrange
        $test_string = '"hello world"';
        $expected_result = array(
            0 => 'hello world'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing string with a "
     * Uses a multi-word string, including a "
     */
    public function testParseStringNotLiteral()
    {
        // Arrange
        $test_string = '"hello world';
        $expected_result = array(
            0 => '"hello',
            1 => 'world'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests a complex string with literals and non literals
     */
    public function testParseStringComplex()
    {
        // Arrange
        $test_string = 'hello "hello world"';
        $expected_result = array(
            0 => 'hello world',
            1 => 'hello'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests a multidimensional array
     */
    public function testParseMultiDimensionalArraySingle()
    {
        // Arrange
        $test_string = array(
            0 => array(
                'hello world'
            ),
            1 => 'foo'
        );
        $expected_result = array(
            0 => 'hello',
            1 => 'world',
            2 => 'foo'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing a bad type - object
     * Uses a stdClass to simulate a bad type
     */
    public function testBadTypeObject()
    {
        // Arrange
        $test_item = new stdClass();
        $expected_result = false;

        // Act
        $test_result = $this->ssp->parse($test_item);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing a bad type - bool
     * Uses a bool to simulate a bad type
     */
    public function testBadTypeBool()
    {
        // Arrange
        $test_item = true;
        $expected_result = false;

        // Act
        $test_result = $this->ssp->parse($test_item);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests a complex array with literals and non literals
     */
    public function testParseComplexComplex()
    {
        // Arrange
        $test_string = array(
            0 => 'hello world',
            1 => 'foo',
            2 => 'bar "literal string"',
            3 => 3,
            4 => -19.27
        );
        $expected_result = array(
            0 => 'literal string',
            1 => 'hello',
            2 => 'world',
            3 => 'foo',
            4 => 'bar',
            5 => '3',
            6 => '-19.27'
        );

        // Act
        $test_result = $this->ssp->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

} 