<?php
/**
 * ParserEn.php
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
 * Class ParserEn
 *
 * Extends SearchStringParser
 *
 * Provides an advanced set of parsing tools for search items that are
 * specific to the "En" language (English general)
 *
 * Follows the Porter2 process (see link below)
 *  *
 * @category  None
 * @package   League\Floor9design\SearchStringParser\
 * @author    Rick Morice <rick@floor9design.com>
 * @copyright floor9design.com
 * @license   GPL 3.0 (http://www.gnu.org/copyleft/gpl.html)
 * @version   0.9.2
 * @link      http://floor9design.com/
 * @see       http://floor9design.com/
 * @see       http://snowball.tartarus.org/algorithms/english/stemmer.html
 * @since     File available since Release 1.0
 */
class ParserEn extends ParserImplementation implements LanguageToolsInterface
{

    /**
     * @var array $vowels
     */
    protected $vowels = array (
        "a", "e", "i", "o", "u", "y"
    );

    /**
     * @var array $doubles
     */
    protected $doubles = array (
        "bb", "dd", "ff", "gg", "mm", "nn", "pp", "rr", "tt"
    );

    /**
     * @var array $valid_li
     */
    protected $valid_li = array (
        'c', 'd', 'e', 'g', 'h', 'k', 'm', 'n', 'r', 't'
    );

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

    /**
     * finds R1 within a word
     *
     * Definition of R1:
     * "R1 is the region after the first non-vowel following a vowel, or is the null region at the end of the
     * word if there is no such non-vowel."
     *
     * @param string $word Word to process
     * @return string $return R1 stem of the word
     */
    public function findR1($word)
    {
        $length = strlen($word);
        $end = $length;
        $position = 0;

        $vowels = implode($this->vowels);

        while ($position < $length) {

            $result = strcspn($word, $vowels, $position);
            $position = $position + $result;

            // if result is 0, then it has found a vowel at the current space:

            if (strcspn($word, $vowels, $position + 1) > 0) {
                // found R1 position... Now point it to the end char
                $end = $position + 2;
                break;
            } elseif ($result == 0) {
                // you have found a vowel but it's not following a non vowel
                $position++;
            }
        }

        return substr($word, $end, $length);
    }

    /**
     * finds R2 within a word
     *
     * Definition of R2:
     * "R2 is the region after the first non-vowel following a vowel in R1, or is the null region at the end of
     * the word if there is no such non-vowel."
     *
     * This is effectively findR1(findR1($word))
     *
     * @param string $word Word to process
     * @return string $return R2 stem of the word
     */
    public function findR2($word) {
        return $this->findR1($this->findR1($word));
    }



}