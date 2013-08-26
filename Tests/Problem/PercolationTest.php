<?php

namespace LB\Tests\Problem;

use LB\Problem\Percolation;

class PercolationTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $p = new Percolation(5);
        $this->assertTrue($p->isBlockedCell(0));
        $this->assertTrue($p->isBlockedCell(24));
    }

    public function testSetCells()
    {
        $p = new Percolation(3);
        $p->setCells(array(
            '#', ' ', '#',
            '#', '#', ' ',
            ' ', ' ', '#'
        ));

        $this->assertTrue($p->isBlockedCell(0));
        $this->assertTrue($p->isBlankCell(1));
        $this->assertTrue($p->isBlankCell(5));
        $this->assertTrue($p->isBlankCell(6));
        $this->assertTrue($p->isBlankCell(7));
        $this->assertTrue($p->isBlockedCell(8));
    }

    public function testPercolates()
    {
        $p = new Percolation(5);
        $p->setCells(array(
            ' ', ' ', '#', ' ', '#',
            '#', '#', '#', ' ', '#',
            '#', ' ', '#', ' ', ' ',
            ' ', '#', ' ', '#', '#',
            ' ', ' ', '#', ' ', ' ',
        ));
        $this->assertFalse($p->percolates('LB\Algorithm\UnionFind\WeightedQuickUnionWithPathCompression'));

        $uf = $p->getLastResult();

        $this->assertTrue($uf->find(0, 1));
        $this->assertTrue($uf->find(3, 8));
        $this->assertTrue($uf->find(3, 13));
        $this->assertTrue($uf->find(3, 14));
        $this->assertTrue($uf->find(15, 20));
        $this->assertTrue($uf->find(15, 21));
        $this->assertTrue($uf->find(23, 24));
    }

    /**
     * @dataProvider getData
     */
    public function testPercolates2($n, $cells, $result)
    {
        $p = new Percolation($n);
        $p->setCells($cells);

        $this->assertEquals($result, $p->percolates('LB\Algorithm\UnionFind\WeightedQuickUnionWithPathCompression'));
    }

    public function getData()
    {
        return array(
            array(
                3,
                array(
                    '#', ' ', '#',
                    '#', ' ', ' ',
                    '#', '#', ' '
                ),
                true
            ),
            array(
                3,
                array(
                    '#', ' ', '#',
                    '#', ' ', '#',
                    ' ', '#', ' '
                ),
                false
            ),
            array(
                3,
                array(
                    ' ', '#', '#',
                    ' ', '#', '#',
                    ' ', '#', '#'
                ),
                true
            ),
            array(
                5,
                array(
                    ' ', '#', '#', '#', '#',
                    ' ', ' ', ' ', ' ', ' ',
                    '#', '#', '#', '#', ' ',
                    ' ', ' ', ' ', ' ', ' ',
                    ' ', '#', '#', '#', '#',
                ),
                true
            ),
        );
    }
}
