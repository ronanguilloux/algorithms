<?php

namespace LB\Problem;

use LB\Algorithm\UnionFind\UnionFindInterface;

class Percolation
{
    const CELL_BLANK = ' ';
    const CELL_BLOCKED = '#';

    /**
     * @var integer
     */
    private $n;

    /**
     * @var array
     */
    private $cells;

    /**
     * @var UnionFindInterface
     */
    private $uf;

    public function __construct($n)
    {
        $this->n = $n;
        $this->cells = array_fill(0, $this->n * $this->n, self::CELL_BLOCKED);
    }

    /**
     * @param integer $index
     *
     * @return bool
     */
    public function isBlankCell($index)
    {
        return $this->cells[$index] === self::CELL_BLANK;
    }

    /**
     * @param integer $index
     *
     * @return bool
     */
    public function isBlockedCell($index)
    {
        return $this->cells[$index] === self::CELL_BLOCKED;
    }

    /**
     * @param array $cells
     */
    public function setCells(array $cells)
    {
        $this->cells = $cells;
    }

    /**
     * Top should connect with bottom in order to percolate.
     *
     * @param string $ufClass
     *
     * @return bool
     */
    public function percolates($ufClass)
    {
        /* @var $uf UnionFindInterface */
        $uf = new $ufClass($this->n * $this->n + 2);

        for ($i = 0; $i < $this->n * $this->n; $i++) {
            if ($this->isBlankCell($i)) {
                $this->connect($uf, $i);
            }
        }

        $this->uf = $uf;

        return $uf->find($this->getTop(), $this->getBottom());
    }

    /**
     * @return UnionFindInterface
     */
    public function getLastResult()
    {
        return $this->uf;
    }

    /**
     * Index of top root.
     *
     * @return int
     */
    private function getTop()
    {
        return $this->n * $this->n;
    }

    /**
     * Index of bottom root.
     *
     * @return int
     */
    private function getBottom()
    {
        return $this->n * $this->n + 1;
    }

    private function connect(UnionFindInterface $uf, $index)
    {
        $x = $index % $this->n;
        $y = intval($index / $this->n);

        // Connect with top
        if ($y === 0) {
            $top = $this->getTop();
            for ($i = 0; $i < $this->n; $i++) {
                $uf->union($top, $i);
            }
        }

        // Connect with bottom
        if ($y === $this->n - 1) {
            $bottom = $this->getBottom();
            for ($i = 0; $i < $this->n; $i++) {
                $uf->union($bottom, $this->n * $y + $i);
            }
        }

        // Connect with left
        if ($x > 0 && $this->isBlankCell($index - 1)) {
            $uf->union($index, $index - 1);
        }

        // Connect with top
        if ($y > 0 && $this->isBlankCell($index - $this->n)) {
            $uf->union($index, $index - $this->n);
        }
    }
}
