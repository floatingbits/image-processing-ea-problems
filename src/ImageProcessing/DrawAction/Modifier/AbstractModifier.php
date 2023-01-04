<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

abstract class AbstractModifier implements ModifierInterface
{
    protected AbstractDrawAction $drawAction;
    public function setOriginalVersion(AbstractDrawAction $drawAction)
    {
        $this->drawAction = clone $drawAction;
    }

}