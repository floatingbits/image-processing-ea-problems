<?php

namespace Floatingbits\ImageProcessingEaProblems\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionRandomizerInterface;

/**
 * @implements MutatorInterface<TreeGraphGenotypeInterface<DrawActionNode>>
 */
class DrawActionReplaceMutator implements MutatorInterface
{
    public function __construct(private readonly DrawActionRandomizerInterface $drawActionRandomizer)
    {
    }

    /**
     * @param TreeGraphGenotypeInterface<DrawActionNode> $genotype
     * @return mixed|void
     */
    public function mutate($genotype)
    {
        $returnGenotype = clone $genotype;
        /** @var DrawActionNode $rootNode */
        $rootNode = $returnGenotype->getTreeGraph()->getRootNode();
        $rootNode->setDrawAction($this->drawActionRandomizer->getRandomDrawAction());
        return $returnGenotype;
    }


}