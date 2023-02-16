<?php

namespace Floatingbits\ImageProcessingEaProblems\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionModifierRandomizerInterface;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionRandomizerInterface;

/**
 * @implements MutatorInterface<TreeGraphGenotypeInterface<DrawActionNode>>
 */
class DrawActionDeltaMutator implements MutatorInterface
{
    public function __construct(private readonly DrawActionModifierRandomizerInterface $drawActionModifierRandomizer)
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
        $drawAction = $rootNode->getDrawAction();
        $modifier = $this->drawActionModifierRandomizer->getRandomDrawActionModifier();
        $modifier->setOriginalVersion($drawAction);
        $drawAction = $modifier->getModifiedVersion();
        $rootNode->setDrawAction($drawAction);
        return $returnGenotype;
    }


}