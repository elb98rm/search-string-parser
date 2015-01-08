<?php
/**
 * LanguageToolsInterface.php
 *
 * Interface to enforce expected behaviour for children of SearchStringParser
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
 */

namespace League\Floor9design\SearchStringParser;

/**
 * Class LanguageToolsInterface
 *
 * Children of SearchStringParser can be used to offer advanced features.
 * Stemming. n-grams and other such features require a language specific behaviour.
 * This interface allows development of other children to the correct standards.
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
interface LanguageToolsInterface
{
    public function parseStems($array);
    public function parseNGram($array);

} 