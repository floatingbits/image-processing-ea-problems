<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\CircleDrawAction;

class RadiusModifier extends AbstractModifierDecorator
{
    private float $delta;
    public function __construct($delta,  AbstractModifierDecorator $decoratedModifier = null)
    {
        parent::__construct($decoratedModifier);
        $this->delta = $delta;
    }

    public function getModifiedVersion(): AbstractDrawAction
    {
        $this->drawAction = parent::getModifiedVersion();
        if ($this->drawAction instanceof CircleDrawAction) {
            $this->drawAction->setRelativeRadius(
                max(0.01, min(0.1, $this->drawAction->getRelativeRadius() + $this->delta))
            );
        }


        return $this->drawAction;
    }
}