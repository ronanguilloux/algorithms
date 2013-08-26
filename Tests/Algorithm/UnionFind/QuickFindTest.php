<?php

namespace LB\Tests\Algorithm\UnionFind;

use LB\Algorithm\UnionFind\QuickFind;

class QuickFindTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $qf = new QuickFind(10);
        $this->assertEquals(10, $qf->getCount());
        $this->assertTrue($qf->hasKey(0));
        $this->assertTrue($qf->hasKey(9));
        $this->assertFalse($qf->hasKey(10));
    }

    public function testInitializeWithArray()
    {
        $qf = new QuickFind(array(1, 1, 5, 4, 1));
        $this->assertEquals(5, $qf->getCount());
        $this->assertTrue($qf->hasKey(0));
        $this->assertTrue($qf->hasKey(4));
        $this->assertFalse($qf->hasKey(5));
    }

    /**
     * @dataProvider getFindAssertions
     */
    public function testFind($p, $q, $result)
    {
        $qf = new QuickFind(array(0, 1, 1, 8, 8, 0, 0, 1, 8, 8));
        $this->assertEquals($qf->find($p, $q), $result);
    }

    public function testUnion()
    {
        $qf = new QuickFind(10);
        $qf->union(4, 3);
        $qf->union(3, 8);
        $qf->union(6, 5);
        $qf->union(9, 4);
        $qf->union(2, 1);

        $this->assertTrue($qf->find(8, 9));
        $this->assertFalse($qf->find(5, 0));

        $qf->union(5, 0);
        $qf->union(7, 2);
        $qf->union(6, 1);

        $this->assertEquals(array(1, 1, 1, 8, 8, 1, 1, 1, 8, 8), $qf->getValues());
    }

    public function testUnion2()
    {
        $qf = new QuickFind(10);
        $qf->union(4, 7);
        $qf->union(6, 5);
        $qf->union(1, 2);
        $qf->union(2, 5);
        $qf->union(5, 0);
        $qf->union(1, 9);

        $this->assertEquals(array(9, 9, 9, 3, 7, 9, 9, 7, 8, 9), $qf->getValues());
    }

    /**
     * @return array
     */
    public function getFindAssertions()
    {
        return array(
            array(0, 1, false),
            array(1, 2, true),
            array(1, 7, true),
            array(3, 4, true),
            array(4, 5, false),
            array(5, 6, true),
        );
    }
}
