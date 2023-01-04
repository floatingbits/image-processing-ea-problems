<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing;

class Color
{
    private int $r,$g,$b;
    private float $alpha;

    public function __construct(int $r, int $g, int $b, float $alpha = 1.0)
    {
        $this->r = $r;
        $this->g = $g;
        $this->b = $b;
        $this->alpha = $alpha;
    }

    /**
     * @return int
     */
    public function getR(): int
    {
        return $this->r;
    }

    /**
     * @param int $r
     */
    public function setR(int $r): void
    {
        $this->r = $r;
    }

    /**
     * @return int
     */
    public function getG(): int
    {
        return $this->g;
    }

    /**
     * @param int $g
     */
    public function setG(int $g): void
    {
        $this->g = $g;
    }

    /**
     * @return int
     */
    public function getB(): int
    {
        return $this->b;
    }

    /**
     * @param int $b
     */
    public function setB(int $b): void
    {
        $this->b = $b;
    }

    /**
     * @return float
     */
    public function getAlpha(): float
    {
        return $this->alpha;
    }

    /**
     * @param float $alpha
     */
    public function setAlpha(float $alpha): void
    {
        $this->alpha = $alpha;
    }



}