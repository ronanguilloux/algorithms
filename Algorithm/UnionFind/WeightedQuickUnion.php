<?php

namespace LB\Algorithm\UnionFind;

class WeightedQuickUnion extends QuickUnion
{
    private $sizes;

    public function __construct($count)
    {
        parent::__construct($count);

        $this->sizes = array_fill(0, $this->getCount(), 1);
    }

    public function union($p, $q)
    {
        $pRoot = $this->getRoot($p);
        $qRoot = $this->getRoot($q);
        $pSize = $this->getSize($p);
        $qSize = $this->getSize($q);

        if ($qSize > $pSize) {
            $this->ids[$pRoot] = $this->ids[$qRoot];
            $this->incrementSize($qRoot, $pSize);
        } else {
            $this->ids[$qRoot] = $this->ids[$pRoot];
            $this->incrementSize($pRoot, $qSize);
        }
    }

    /**
     * @param integer $root
     *
     * @return integer
     */
    private function getSize($root)
    {
        return $this->sizes[$root];
    }

    /**
     * @param integer $root
     * @param integer $size
     */
    private function incrementSize($root, $size)
    {
        $this->sizes[$root] += $size;
    }
}
