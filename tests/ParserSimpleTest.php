<?php
/**
 * ParserSimpleTest.php
 *
 * PHPUnit tests for ParserSimple
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
 * Class ParserSimpleTest
 *
 * Provides a set of testing tools for the ParserSimple class.
 *
 * @category  None
 * @package   Floor9design\SearchStringParser;
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.9
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 */
class ParserSimpleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Set up objects for testing
     */
    function setUp() {

        // Create a stub for the SearchStringParser class.
        $this->ps = new Floor9design\SearchStringParser;
        ParserSimple;
    }

    /**
     * Clear object after use
     */
    function tearDown() {
        unset($this->ps);
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

        // Covers get/set string vars
        $test_string = 'hello';
        $this->ps->parse($test_string);

        // covers delimiter
        $test_delimiter = 'P';

        // Act
        $result_string = $this->ps->getSearchStrings();

        $this->ps->setDelimiter($test_delimiter);
        $result_delimiter = $this->ps->getDelimiter();

        // Assert
        $this->assertEquals($test_string, $result_string);
        $this->assertEquals($test_delimiter, $result_delimiter);
    }

    /*
     * Tests attempting to set a delimiter badly, and checks that a correct exception is thrown.
     */
    public function testDelimiterException()
    {
        $this->setExpectedException('\Exception', 'Attempted to set a delimiter that was not a string.');

        // invalid data type
        $test_delimiter = array();
        $this->ps->setDelimiter($test_delimiter);
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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

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
        $test_result = $this->ps->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

    /**
     * Tests parsing a bad type - object
     * Uses a stdClass to simulate a bad type
     */
    public function testSearchExceptionObject()
    {
        // Arrange
        $test_item = new stdClass();
        $this->setExpectedException('\Exception', 'Attempted to parse a bad data type.');

        // Act
        $this->ps->parse($test_item);
    }

    /**
     * Tests parsing a bad type - bool
     * Uses a bool to simulate a bad type
     */
    public function testSearchExceptionBool()
    {
        // Arrange
        $test_item = true;
        $this->setExpectedException('\Exception', 'Attempted to parse a bad data type.');

        // Act
        $this->ps->parse($test_item);
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
        $test_result = $this->ps->parse($test_string);

        // Assert
        $this->assertEquals($test_result, $expected_result);
    }

}