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
 * @version   1.0
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
 * @version   1.0
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

} 