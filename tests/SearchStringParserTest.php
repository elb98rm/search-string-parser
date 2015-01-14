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
class SearchStringParserTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Set up objects for testing
     */
    function setUp() {

        // Create a stub for the SearchStringParser class.
        $stub = $this->getMockBuilder('League\Floor9design\SearchStringParser\ParserSimple')
            ->getMock();

        // parse function
        $stub->expects($this->any())
            ->method('parse')
            ->will(
                $this->returnValue(
                    array(
                        0 => 'hello world'
                    )
                )
            );

        // setDelimiter
        $stub->expects($this->any())
            ->method('setDelimiter')
            ->will($this->returnValue('delimiter is set'));

        // getDelimiter
        $stub->expects($this->any())
            ->method('getDelimiter')
            ->will($this->returnValue('delimiter is set'));

        $this->ssp = new League\Floor9design\SearchStringParser\SearchStringParser($stub);
    }

    /**
     * Tests the dependency injection has worked
     */
    public function testDependencyInjection()
    {
        // Set it up
        $injected = new League\Floor9design\SearchStringParser\ParserSimple();
        $test = new League\Floor9design\SearchStringParser\SearchStringParser($injected);

        // Test
        $output = $test->getParserImplementation();
        $this->assertInstanceOf('League\Floor9design\SearchStringParser\ParserSimple', $output);
    }

    /**
     * Tests the dependency injection has worked
     * @expects PHPException
     */
    public function testDependencyInjectionBad()
    {
        $this->setExpectedException(get_class(new PHPUnit_Framework_Error("", 0, "", 1)));
        $injected = new \stdClass();
        new League\Floor9design\SearchStringParser\SearchStringParser($injected);
    }

    /**
     * Tests calling the parse function
     */
    public function testParse()
    {
        // Arrange
        $expected = array(
            0 => 'hello world'
        );

        // Act
        $output = $this->ssp->parse('hello world');
        $this->assertEquals($expected, $output);
    }

    /**
     * Tests calling the getDelimiter method
     */
    public function testGetDelimiter()
    {
        // Arrange
        $expected = 'delimiter is set';

        // Act
        $output = $this->ssp->getDelimiter();
        $this->assertEquals($expected, $output);
    }

    /**
     * Tests calling the setDelimiter method
     */
    public function testSetDelimiter()
    {
        // Arrange
        $expected = 'delimiter is set';
        $string = 'delimiter is set';

        // Act
        $output = $this->ssp->setDelimiter($string);
        $this->assertEquals($expected, $output);
    }

}