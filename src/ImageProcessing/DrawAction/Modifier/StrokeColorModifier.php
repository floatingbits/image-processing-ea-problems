<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

class StrokeColorModifier extends AbstractModifierDecorator
{
    use ColorModifierTrait;
    public function __construct(int $deltaR, int $deltaG, int $deltaB, ?AbstractModifier $decoratedModifier = null)
    {
        parent::__construct($decoratedModifier);
        $this->deltaR = $deltaR;
        $this->deltaG = $deltaG;
        $this->deltaB = $deltaB;
    }
    public function getModifiedVersion(): AbstractDrawAction
    {
        $this->drawAction->setStrokeColor($this->modifyColor($this->drawAction->getStrokeColor()));
        return $this->drawAction;
    }



}