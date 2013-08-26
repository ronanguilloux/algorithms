<?php

namespace LB\Algorithm\UnionFind;

class WeightedQuickUnionWithPathCompression extends WeightedQuickUnion
{
    protected function getRoot($x)
    {
        while ($this->ids[$x] !== $x) {
            $this->ids[$x] = $this->ids[$this->ids[$x]];
            $x = $this->ids[$x];
        }

        return $x;
    }
}
