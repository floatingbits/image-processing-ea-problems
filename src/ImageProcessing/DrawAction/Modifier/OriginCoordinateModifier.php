<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

class OriginCoordinateModifier extends AbstractModifier
{
    private float $deltaX;
    private float $deltaY;
    public function __construct($deltaX, $deltaY)
    {
        $this->deltaX = $deltaX;
        $this->deltaY = $deltaY;
    }

    public function getModifiedVersion(): AbstractDrawAction
    {
        $this->drawAction->setRelativeX($this->drawAction->getRelativeX() + $this->deltaX);
        $this->drawAction->setRelativeY($this->drawAction->getRelativeY() + $this->deltaY);
        return $this->drawAction;
    }

    /**
     * @return float
     */
    public function getDeltaX(): float
    {
        return $this->deltaX;
    }

    /**
     * @param float $deltaX
     */
    public function setDeltaX(float $deltaX): void
    {
        $this->deltaX = $deltaX;
    }

    /**
     * @return float
     */
    public function getDeltaY(): float
    {
        return $this->deltaY;
    }

    /**
     * @param float $deltaY
     */
    public function setDeltaY(float $deltaY): void
    {
        $this->deltaY = $deltaY;
    }



}