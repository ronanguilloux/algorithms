<?php

namespace LB\Tests\Algorithm\UnionFind;

use LB\Algorithm\UnionFind\WeightedQuickUnion;

class WeightedQuickUnionTest extends \PHPUnit_Framework_TestCase
{
    public function testUnion()
    {
        $qf = new WeightedQuickUnion(10);
        $qf->union(4, 3);
        $qf->union(3, 8);
        $qf->union(6, 5);
        $qf->union(9, 4);
        $qf->union(2, 1);
        $qf->union(5, 0);
        $qf->union(7, 2);
        $qf->union(6, 1);
        $qf->union(7, 3);

        $this->assertEquals(array(6, 2, 6, 4, 6, 6, 6, 2, 4, 4), $qf->getValues());
    }
}
