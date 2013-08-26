<?php

namespace LB\Algorithm\UnionFind;

class QuickFind extends UnionFind
{
    public function union($p, $q)
    {
        $pVal = $this->ids[$p];
        $qVal = $this->ids[$q];

        for ($i = 0; $i < $this->count; $i++) {
            if ($this->ids[$i] === $pVal) {
                $this->ids[$i] = $qVal;
            }
        }
    }

    public function find($p, $q)
    {
        return $this->ids[$p] === $this->ids[$q];
    }
}
