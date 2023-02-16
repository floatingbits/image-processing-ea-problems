<?php

namespace Floatingbits\ImageProcessingEaProblems\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionModifierRandomizerInterface;

class DrawActionModifierDeltaMutator extends AbstractDrawActionModifierMutator
{
    public function __construct(
        private readonly DrawActionModifierRandomizerInterface $drawActionModifierRandomizer,
        private  ?ConfigurableIntRandomizerInterface $intRandomizer = null
    )
    {
        parent::__construct($this->intRandomizer);
    }

    /**
     * @param TreeGraphGenotypeInterface<DrawActionNode> $genotype
     * @return mixed|void
     */
    public function mutate($genotype)
    {
        $returnGenotype = clone $genotype;
        $link = $this->getRandomLink($returnGenotype->getTreeGraph());
        if ($link) {
            $newModifier = $this->drawActionModifierRandomizer->getRandomDrawActionModifier();
            $newModifier->setDecoratedModifier($link->getModifier());
            $link->setModifier($newModifier);
        }

        return $returnGenotype;
    }

}