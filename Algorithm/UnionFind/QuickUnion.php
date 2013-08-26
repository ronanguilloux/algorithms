<?php

namespace LB\Algorithm\UnionFind;

class QuickUnion extends UnionFind
{
    public function union($p, $q)
    {
        $pRoot = $this->getRoot($p);
        $qRoot = $this->getRoot($q);

        $this->ids[$pRoot] = $this->ids[$qRoot];
    }

    public function find($p, $q)
    {
        return $this->getRoot($p) === $this->getRoot($q);
    }

    protected function getRoot($x)
    {
        while ($this->ids[$x] !== $x) {
            $x = $this->ids[$x];
        }

        return $x;
    }
}
