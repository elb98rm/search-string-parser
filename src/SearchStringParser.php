<?php
/**
 * SearchStringParser.php
 *
 * Class to allow string parsing
 *
 * php 5.3+
 *
 * @category  None
 * @package   League\Floor9design\SearchStringParser
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.9.2
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 *
 *
 */

namespace League\Floor9design\SearchStringParser;

/**
 * Class SearchStringParser
 *
 * Provides a set of parsing tools for search items.
 * if you create a search feature, searching by string can be a minefield.
 * This is a simple tool to help organise this process
 *
 * @category  None
 * @package   League\Floor9design\SearchStringParser\
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.9.2
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 */
class SearchStringParser
{

    private $parser_implementation;

    // Accessors

    /**
     * @param string $delimiter Delimiter to use within the search object.
     */
    public function __construct(ParserImplementation $parser_implementation)
    {
        $this->setParserImplementation($parser_implementation);
    }

    /**
     * get delimiter to use while parsing strings
     * @return string $this->getParserImplementation()->getDelimiter()
     */
    public function getDelimiter()
    {
        return $this->getParserImplementation()->getDelimiter();
    }

    /**
     * get ParserImplementation object
     * @return mixed $this->search_strings
     */
    public function getParserImplementation()
    {
        return $this->parser_implementation;
    }

    /**
     * Set the ParserImplementation object (actually.. a child of)
     *
     * @param ParserImplementation $parser_implementation
     * @return SearchStringParser $this
     */
    public function setParserImplementation(ParserImplementation $parser_implementation)
    {
        $this->parser_implementation = $parser_implementation;
        return $this;
    }

    /**
     * Set the delimiter to use while parsing strings
     *
     * @param string $delimiter
     * @return ParserImplementation $this
     */
    public function setDelimiter($delimiter)
    {
        return $this->getParserImplementation()->setDelimiter($delimiter);
    }

    // Other functions

    /**
     * Runs Parse on the injected class.
     *
     * It is meant as catch all, and will attempt to make the best
     * of the data it is given.
     *
     * This takes a "mixed", auto switching depending on the context.
     * Accepts: string, multi-dimensional array, int, float
     *
     * @param mixed $mixed item to parse
     * @param array $options Array of options for extended searching in children
     * @return array $return
     *
     * @throws \Exception Generic exception if there is an issue
     */
    public function parse($mixed)
    {
        return $this->getParserImplementation()->parse($mixed);
    }
}