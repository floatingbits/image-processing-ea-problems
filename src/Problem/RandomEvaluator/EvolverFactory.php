<?php

namespace Floatingbits\ImageProcessingEaProblems\Problem\RandomEvaluator;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\RandomEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Evolution\AbstractEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Mutation\CollectionMutator;
use FloatingBits\EvolutionaryAlgorithm\Mutation\Graph\SwitchBranchesTreeGraphMutator;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphLinkRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphNodeRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector;
use FloatingBits\EvolutionaryAlgorithm\Specimen\CollectionReplenishInterface;
use Floatingbits\ImageProcessingEaProblems\Mutation\DrawActionModifierDeltaMutator;
use Floatingbits\ImageProcessingEaProblems\Phenotype\TreeGraphImagePhenotypeFactory;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DefaultDrawActionModifierRandomizer;

class EvolverFactory extends AbstractEvolverFactory
{
    protected function createSelector(): SelectorInterface
    {
        return new SimpleSelector(0.3);
    }

    protected function createEvaluator(): EvaluatorInterface
    {
        return new RandomEvaluator();
    }

    /**
     * @return CollectionReplenishInterface[]
     */
    protected function createReplenishers(): array
    {
        return [
            $this->createDrawActionModifierMutator(),
            $this->createSwitchBranchesMutator()
        ];
    }
    private function createSwitchBranchesMutator(): CollectionReplenishInterface{
        return new CollectionMutator(
            new SwitchBranchesTreeGraphMutator(
                new TreeGraphLinkRandomizer(),
                new TreeGraphNodeRandomizer()
            ),
            new IntRandomizer(),
            1
        );
    }
    private function createDrawActionModifierMutator(): CollectionReplenishInterface {
        return new CollectionMutator(
            new DrawActionModifierDeltaMutator(
                new DefaultDrawActionModifierRandomizer(),
            ),
            new IntRandomizer(),
            1
        );
    }

    protected function createPhenotypeGenerator(): PhenotypeGeneratorInterface
    {
        return new TreeGraphImagePhenotypeFactory();
    }


}