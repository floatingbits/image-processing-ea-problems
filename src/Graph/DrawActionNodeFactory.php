<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionRandomizerInterface;

class DrawActionNodeFactory implements NodeFactoryInterface
{

    public function __construct(private readonly DrawActionRandomizerInterface $drawActionRandomizer)
    {
    }

    /**
     * @return DrawActionNode
     */
    public function createNode()
    {
        $node = new DrawActionNode();
        $node->setDrawAction($this->drawActionRandomizer->getRandomDrawAction());
        return $node;
    }


}