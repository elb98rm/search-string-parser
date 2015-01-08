<?php
/**
 * SearchStringParserEn.php
 *
 * Class to allow advanced string parsing
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
 * Class SearchStringParserEn
 *
 * Extends SearchStringParser
 *
 * Provides an advanced set of parsing tools for search items that are
 * specific to the "En" language (English general)
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
class SearchStringParserEn extends ParserImplementation implements LanguageToolsInterface
{

    /**
     * Extends parent parse(), adding in localisation if specified
     *
     * @param mixed $mixed item to parse
     * @param array $options Array of options for extended searching in children
     * @return array $return
     *
     * @todo Extend this appropriately - currently a basic copy of ParserSimple
     *
     * @throws \Exception Generic exception if there is an issue
     */
    public function parse($mixed)
    {
        $this->setSearchStrings($mixed);
        $return = array();

        // Parse $mixed to be string
        $string = $this->validateInput($mixed);

        // string cleaning functions
        $literals = $this->extractLiterals($string);
        $terms = $this->splitTerms($string);

        $this->setReturnStrings(array_merge($return, $literals, $terms));

        return $this->getReturnStrings();
    }


    public function parseStems($array)
    {
        // TODO: Implement parseStems() method.
    }

    public function parseNGram($array)
    {
        // TODO: Implement parseNGram() method.
    }
}