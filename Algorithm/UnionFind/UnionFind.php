<?php

namespace LB\Algorithm\UnionFind;

abstract class UnionFind implements UnionFindInterface
{
    protected $ids;
    protected $count;

    public function __construct($count)
    {
        if (is_array($count)) {
            $this->ids = array_values($count);
            $this->count = count($count);
        } else {
            $this->ids = range(0, $count - 1);
            $this->count = $count;
        }
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param integer $i
     *
     * @return bool
     */
    public function hasKey($i)
    {
        return $i >= 0 && $this->count > $i;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->ids;
    }
}
