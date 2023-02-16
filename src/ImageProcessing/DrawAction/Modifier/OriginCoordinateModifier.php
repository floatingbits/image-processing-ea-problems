<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

class OriginCoordinateModifier extends AbstractModifierDecorator
{
    private float $deltaX;
    private float $deltaY;
    public function __construct($deltaX, $deltaY, AbstractModifierDecorator $decoratedModifier = null)
    {
        parent::__construct($decoratedModifier);
        $this->deltaX = $deltaX;
        $this->deltaY = $deltaY;
    }

    public function getModifiedVersion(): AbstractDrawAction
    {
        $this->drawAction = parent::getModifiedVersion();
        $this->drawAction->setRelativeX($this->assureRange($this->drawAction->getRelativeX() + $this->deltaX));
        $this->drawAction->setRelativeY($this->assureRange($this->drawAction->getRelativeY() + $this->deltaY));
        return $this->drawAction;
    }

    private function assureRange(float $number): float {
        if ($number < 0) {
            $number = -$number;
        }
        if ($number <= 1) {
            return $number;
        }
        //Mirror with 1 as axis
        $aux = $number;
        while ( $aux > 1 ) {
            $aux--;
        }
        return 1 - $aux;
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