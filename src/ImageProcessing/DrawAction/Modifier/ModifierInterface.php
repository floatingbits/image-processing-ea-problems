<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

interface ModifierInterface
{
    public function getModifiedVersion(): AbstractDrawAction;
    public function setOriginalVersion(AbstractDrawAction $drawAction);
}