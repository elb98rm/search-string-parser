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
 * @version   1.0
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 *
 * @todo      Change filestructure to be PSR-4 compliant
 * @todo      Think about changing this to return an object
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
 * @version   1.0
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @since     File available since Release 1.0
 */
class SearchStringParser {

    /**
     * This function "auto parses" the file.
     *
     * It is meant as catch all, and will attempt to make the best
     * of the data it is given.
     *
     * This takes a "mixed", auto switching depending on the context.
     * it returns an array of search terms with indexes as follows:
     *
     * "original" == original term (optional = set false by default)
     * [number items] == the various search terms
     *
     * @todo expand this to tackle more than strings
     * @todo create a returned status code key/value that gives accurate information
     *
     * @param mixed $mixed    item to parse
     * @param bool  $original include the original mixed as an array element
     *
     * @return array $return
     */
    public function parse($mixed, $original=false)
    {
        $return = array();

        // add original $mixed to return if specified
        if ($original) {
           $return['original'] = $mixed;
        }

        // Currently this is work in progress, so only look at the case of strings:
        if (!is_string($mixed)) {
            $return = false;
        }
        // cleaning function will eventually return $string
        $string = $mixed;

        // string cleaning functions
        $literals = $this->extractLiterals($string);
        $terms = $this->splitTerms($string);

        $return = array_merge($return, $literals, $terms);

        return $return;
    }

    /**
     * extractLiterals
     *
     * Parses a string for literals i.e things in quotes
     * Returns an array of literals.
     * Note - ignores non literal searched items.
     *
     * @param string $string string of items to parse
     * @return array $array parsed search items
     */
    private function extractLiterals($string)
    {
        $array = array();

        while (
            // 0 is false AND the first position of a string. Urgh!
            is_int(strpos($string, '"')) &&
            strpos($string, '"', strpos($string, '"')+1)
        ) {
            $start = strpos($string, '"') + 1;
            $length = strpos($string, '"', strpos($string, '"')+1) - $start;

            // add it to the array
            $array[] = substr($string, $start, $length);
            $string = substr($string, $start+$length+1);
        }

        return $array;
    }

    /**
     * splitTerms
     *
     * Breaks string items into an array
     * Takes " " as the word break
     * Ignores literals i.e things in quotes
     * Returns an array of items
     *
     * @param string $string string of items to parse
     * @return array $array parsed search items

     */
    private function splitTerms($string)
    {
        $array = array();

        // Does it have any literal strings
        while (
            // 0 is false AND the first position of a string. Urgh!
            is_int(strpos($string, '"')) &&
            strpos($string, '"', strpos($string, '"')+1)
        ) {
            $start = strpos($string, '"');
            $length = strpos($string, '"', strpos($string, '"')+1) - $start +1;
            $string = substr_replace($string, ' ', $start, $length);
        }

        // Clean the string of excess whitespace
        $string = trim(preg_replace('/\s+/', ' ', $string));

        // is there any string left...
        if(strlen($string)) {
            $results = explode(' ', $string);
            // and join back to the main
            if (count($results) > 0) {
                $array = array_merge($array, $results);
            }
        }
        return $array;
    }

} 