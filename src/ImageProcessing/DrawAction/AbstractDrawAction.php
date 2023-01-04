<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\Color;

abstract class AbstractDrawAction
{
    private Color $strokeColor;
    private Color $fillColor;
    private float $relativeX;
    private float $relativeY;
    /**
     * @return Color
     */
    public function getStrokeColor(): Color
    {
        return $this->strokeColor;
    }

    /**
     * @param Color $strokeColor
     */
    public function setStrokeColor(Color $strokeColor): void
    {
        $this->strokeColor = $strokeColor;
    }

    /**
     * @return Color
     */
    public function getFillColor(): Color
    {
        return $this->fillColor;
    }

    /**
     * @param Color $fillColor
     */
    public function setFillColor(Color $fillColor): void
    {
        $this->fillColor = $fillColor;
    }

    /**
     * @return float
     */
    public function getRelativeX(): float
    {
        return $this->relativeX;
    }

    /**
     * @param float $relativeX
     */
    public function setRelativeX(float $relativeX): void
    {
        $this->relativeX = $relativeX;
    }

    /**
     * @return float
     */
    public function getRelativeY(): float
    {
        return $this->relativeY;
    }

    /**
     * @param float $relativeY
     */
    public function setRelativeY(float $relativeY): void
    {
        $this->relativeY = $relativeY;
    }


}