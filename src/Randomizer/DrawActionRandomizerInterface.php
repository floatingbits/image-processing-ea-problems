<?php

namespace Floatingbits\ImageProcessingEaProblems\Randomizer;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

interface DrawActionRandomizerInterface
{
    public function getRandomDrawAction(): AbstractDrawAction;
}