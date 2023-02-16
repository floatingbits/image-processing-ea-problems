<?php

namespace Floatingbits\ImageProcessingEaProblems\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use Floatingbits\ImageProcessingEaProblems\Graph\DirectedImageProcessingLink;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionModifierRandomizerInterface;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionRandomizerInterface;


class DrawActionModifierReplaceMutator extends AbstractDrawActionModifierMutator
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
        $link->setModifier($this->drawActionModifierRandomizer->getRandomDrawActionModifier());
        return $returnGenotype;
    }



}