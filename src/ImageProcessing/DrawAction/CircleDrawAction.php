<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction;

class CircleDrawAction extends AbstractDrawAction
{
    private float $relativeRadius;

    /**
     * @return float
     */
    public function getRelativeRadius(): float
    {
        return $this->relativeRadius;
    }

    /**
     * @param float $relativeRadius
     */
    public function setRelativeRadius(float $relativeRadius): void
    {
        $this->relativeRadius = $relativeRadius;
    }

}