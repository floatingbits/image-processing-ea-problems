<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionModifierRandomizerInterface;

class DirectedImageProcessingLinkFactory implements DirectedLinkFactoryInterface
{
    public function __construct(private DrawActionModifierRandomizerInterface $modifierRandomizer)
    {
    }

    public function createDirectedLink()
    {
        $link = new DirectedImageProcessingLink();
        $link->setModifier($this->modifierRandomizer->getRandomDrawActionModifier());
        return $link;
    }


}