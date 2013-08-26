<?php

namespace LB\Algorithm\UnionFind;

interface UnionFindInterface
{
    /**
     * Union operation on 2 two objects.
     *
     * @param mixed $p
     * @param mixed $q
     */
    public function union($p, $q);

    /**
     * Test if 2 objects are connected.
     *
     * @param mixed $p
     * @param mixed $q
     *
     * @return boolean
     */
    public function find($p, $q);
}
