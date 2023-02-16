<?php

namespace Floatingbits\ImageProcessingEaProblems\Randomizer;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\AbstractModifierDecorator;

interface DrawActionModifierRandomizerInterface
{
    public function getRandomDrawActionModifier(): AbstractModifierDecorator;
}