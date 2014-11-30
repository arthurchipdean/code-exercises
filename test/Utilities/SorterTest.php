<?php
use Utilities\Sorter;

class SorterTest extends PHPUnit_Framework_TestCase
{
    private $_sorter;
    public function setUp()
    {
        $this->_sorter = Sorter::get_instance();
    }
    /**
     * @expectedException Exception
     */
    public function testInvalidSort()
    {
        $this->_sorter->sort($this->getData(), 'id', '');

    }
    public function testInstanceOf()
    {
        $this->assertInstanceOf('Utilities\Sorter', $this->_sorter);
    }
    public function testNaturalSortAscending()
    {
        $sorted  = $this->_sorter->sort($this->getData(), 'number', 'asc', true);
        $this->assertEquals('img1', $sorted[0]['number']);
        $this->assertEquals('img2', $sorted[1]['number']);
        $this->assertEquals('img10', $sorted[2]['number']);
        $this->assertEquals('img12', $sorted[3]['number']);
    }
    public function testNaturalSortDescending()
    {
        $sorted  = $this->_sorter->sort($this->getData(), 'number', 'desc', true);
        $this->assertEquals('img12', $sorted[0]['number']);
        $this->assertEquals('img10', $sorted[1]['number']);
        $this->assertEquals('img2', $sorted[2]['number']);
        $this->assertEquals('img1', $sorted[3]['number']);
    }
    public function testSortAscending()
    {
        $sorted  = $this->_sorter->sort($this->getData(), 'number', 'asc');
        $this->assertEquals('img1', $sorted[0]['number']);
        $this->assertEquals('img10', $sorted[1]['number']);
        $this->assertEquals('img12', $sorted[2]['number']);
        $this->assertEquals('img2', $sorted[3]['number']);
    }
    public function testSortDescending()
    {
        $sorted  = $this->_sorter->sort($this->getData(), 'number', 'desc');
        $this->assertEquals('img2', $sorted[0]['number']);
        $this->assertEquals('img12', $sorted[1]['number']);
        $this->assertEquals('img10', $sorted[2]['number']);
        $this->assertEquals('img1', $sorted[3]['number']);
    }
    private function getData()
    {
        require 'test_data.php';
        return $data;
    }
}
