<?php
/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Jan Schneider <jan@horde.org>
 * @copyright 2017 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */

namespace phpDocumentor\Reflection\DocBlock\Tags\Formatter;

use phpDocumentor\Reflection\DocBlock\Description;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use phpDocumentor\Reflection\DocBlock\Tags\Version;
use phpDocumentor\Reflection\Types\String_;

/**
 * @coversDefaultClass \phpDocumentor\Reflection\DocBlock\Tags\Formatter\AlignFormatter
 */
class PassthroughFormatterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::format
     * @uses \phpDocumentor\Reflection\DocBlock\Description
     * @uses \phpDocumentor\Reflection\DocBlock\Tags\BaseTag
     * @uses \phpDocumentor\Reflection\DocBlock\Tags\Link
     * @uses \phpDocumentor\Reflection\DocBlock\Tags\Param
     * @uses \phpDocumentor\Reflection\DocBlock\Tags\Version
     * @uses \phpDocumentor\Reflection\Types\String_
     */
    public function testFormatterCallsToStringAndReturnsAStandardRepresentation()
    {
        $tags = array(
            new Param('foobar', new String_()),
            new Version('1.2.0'),
            new Link('http://www.example.com', new Description('Examples'))
        );
        $fixture = new AlignFormatter($tags);

        $expected = array(
            '@param   string $foobar',
            '@version 1.2.0',
            '@link    http://www.example.com Examples'
        );

        foreach ($tags as $key => $tag) {
            $this->assertSame(
                $expected[$key],
                $fixture->format($tag)
            );
        }
    }
}
