<?php declare(strict_types=1);

namespace SergeyNezbritskiy\XmlIo\tests;

use PHPUnit\Framework\TestCase;
use SergeyNezbritskiy\XmlIo\XmlReader;

/**
 * Class XmlReaderTest
 * @package SergeyNezbritskiy\XmlIo\tests
 */
class XmlReaderTest extends TestCase
{

    /**
     * @var XmlReader
     */
    private $xmlReader;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->xmlReader = new XmlReader();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->xmlReader = null;
    }

    public function testParseXmlIntoArray()
    {
        $content = file_get_contents(__DIR__ . '/data/sample.xml');
        $map = [
            'user[]' => [
                'id' => '@id',
                'name' => 'name',
                'age' => 'age',
            ],
        ];

        $xmlReader = new XmlReader();
        $result = $xmlReader->parse($content, $map);
        $this->assertEquals([
            ['id' => '1', 'name' => 'Sergey', 'age' => 29],
            ['id' => '2', 'name' => 'Victoria', 'age' => 22],
        ], $result);
    }

}