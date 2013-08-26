<?php

namespace LB\Tests\Algorithm\UnionFind;

use LB\Algorithm\UnionFind\QuickUnion;

class LazyQuickUnionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getFindAssertions
     */
    public function testFind($p, $q, $result)
    {
        $qf = new QuickUnion(array(0, 1, 9, 4, 9, 6, 6, 7, 8, 9));
        $this->assertEquals($qf->find($p, $q), $result);
    }

    /**
     * @return array
     */
    public function getFindAssertions()
    {
        return array(
            array(0, 1, false),
            array(7, 8, false),
            array(2, 6, false),
            array(2, 3, true),
            array(5, 6, true),
            array(4, 2, true),
        );
    }

    public function testUnion()
    {
        $qf = new QuickUnion(10);
        $qf->union(4, 3);
        $qf->union(3, 8);
        $qf->union(6, 5);
        $qf->union(9, 4);
        $qf->union(2, 1);

        $this->assertTrue($qf->find(8, 9));
        $this->assertFalse($qf->find(5, 4));

        $qf->union(5, 0);
        $qf->union(7, 2);
        $qf->union(6, 1);
        $qf->union(7, 3);

        $this->assertEquals(array(1, 8, 1, 8, 3, 0, 5, 1, 8, 8), $qf->getValues());
    }
}
