<?php
/**
 * ParserImplementation.php
 *
 * Abstract class to specify basic functionality requirements
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
 * Class ParserImplementation
 *
 * Abstract class to specify basic functionality requirements
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
abstract class ParserImplementation
{

    /**
     * @var mixed $search_strings Items submitted to parse.
     */
    protected $search_strings;

    /**
     * @var array $return_strings Array of items returned
     */
    protected $return_strings;

    /**
     * @var array $delimiter Delimiter to mark boundaries of literals
     */
    protected $delimiter;

    // Accessors

    /**
     * get Search Strings
     * @return mixed $this->search_strings
     */
    public function getSearchStrings()
    {
        return $this->search_strings;
    }

    /**
     * Set the search strings
     * Protected - should only be used internally
     *
     * @param mixed $search_strings
     * @return ParserImplementation $this
     */
    protected function setSearchStrings($search_strings)
    {
        $this->search_strings = $search_strings;
        return $this;
    }

    /**
     * get Return Strings
     * @return mixed $this->return_strings
     */
    public function getReturnStrings()
    {
        return $this->return_strings;
    }

    /**
     * Set the search strings
     * Protected - should only be used internally
     *
     * @param mixed $return_strings
     * @return ParserImplementation $this
     */
    protected function setReturnStrings($return_strings)
    {
        $this->return_strings = $return_strings;
        return $this;
    }

    /**
     * get delimiter to use while parsing strings
     * @return string $this->delimiter
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * Set the delimiter to use while parsing strings
     *
     * @param string $delimiter
     * @return ParserImplementation $this
     *
     * @throws \Exception Generic exception if there is an issue
     */
    public function setDelimiter($delimiter)
    {
        if (is_string($delimiter)) {
            $this->delimiter = $delimiter;
            return $this;
        } else {
            throw new \Exception('Attempted to set a delimiter that was not a string.');
        }
    }

    // Constructor

    /**
     * @param string $delimiter Delimiter to use within the search object.
     */
    public function __construct($delimiter = '"') {
        $this->setDelimiter($delimiter);
    }

    // Other functions

    /**
     * @param $mixed
     * @return bool|string
     * @throws \Exception
     */
    protected function validateInput($mixed)
    {
        // Parse $mixed
        if (is_string($mixed)) {
            // string
            $string = $mixed;
        } elseif(is_array($mixed)) {
            // array:
            $string = $this->recursiveArrayImplode($mixed);
        } elseif (
            is_int($mixed) ||
            is_float($mixed)
        ) {
            $string = (string)$mixed;
        }
        else {
            throw new \Exception('Attempted to parse a bad data type.');
        }
        return $string;
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
    protected function extractLiterals($string)
    {
        $array = array();

        while (
            // 0 is false AND the first position of a string. Urgh!
            is_int(strpos($string, $this->getDelimiter())) &&
            strpos($string, $this->getDelimiter(), strpos($string, $this->getDelimiter())+1)
        ) {
            $start = strpos($string, $this->getDelimiter()) + 1;
            $length = strpos($string, $this->getDelimiter(), strpos($string, $this->getDelimiter())+1) - $start;

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
    protected function splitTerms($string)
    {
        $array = array();

        // Does it have any literal strings
        while (
            // 0 is false AND the first position of a string. Urgh!
            is_int(strpos($string, $this->getDelimiter())) &&
            strpos($string, $this->getDelimiter(), strpos($string, $this->getDelimiter())+1)
        ) {
            $start = strpos($string, $this->getDelimiter());
            $length = strpos($string, $this->getDelimiter(), strpos($string, $this->getDelimiter())+1) - $start +1;
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

    /**
     * Converts a multidimensional array to an imploded string
     *
     * @param array $array Multidimensional array to implode
     * @param string $glue Glue to implode with together
     * @return string Converted string
     */
    protected function recursiveArrayImplode($array, $glue = ' ') {
        $return = '';
        foreach($array as $item) {
            if(is_array($item)) {
                $return .= $glue . $this->recursiveArrayImplode($item);
            } else {
                $return .= $glue . $item;
            }
        }
        return trim($return);
    }

    // Inherited functions

    /**
     * This function "auto parses" the file.
     *
     * It is meant as catch all, and will attempt to make the best
     * of the data it is given.
     *
     * This takes a "mixed", auto switching depending on the context.
     * Accepts: string, multi-dimensional array, int, float
     *
     * @param mixed $mixed item to parse
     * @return array $return
     *
     * @throws \Exception Generic exception if there is an issue
     */
    abstract public function parse($mixed);

} 