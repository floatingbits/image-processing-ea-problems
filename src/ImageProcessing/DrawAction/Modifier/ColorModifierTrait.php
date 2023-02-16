<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\Color;

trait ColorModifierTrait
{
    private int $deltaR, $deltaG, $deltaB;



    private function modifyColor(Color $color) {
        return new Color(
            max(min($color->getR() + $this->deltaR, 255), 0),
            max(min($color->getG() + $this->deltaG, 255), 0),
            max(min($color->getB() + $this->deltaB, 255), 0),
        );
    }
}