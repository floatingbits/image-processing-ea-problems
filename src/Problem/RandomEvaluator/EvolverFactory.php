<?php

namespace Floatingbits\ImageProcessingEaProblems\Problem\RandomEvaluator;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\RandomEvaluator;
use FloatingBits\EvolutionaryAlgorithm\Evolution\AbstractEvolverFactory;
use FloatingBits\EvolutionaryAlgorithm\Mutation\CollectionMutator;
use FloatingBits\EvolutionaryAlgorithm\Mutation\Graph\CreateBranchTreeGraphMutator;
use FloatingBits\EvolutionaryAlgorithm\Mutation\Graph\CutBranchTreeGraphMutator;
use FloatingBits\EvolutionaryAlgorithm\Mutation\Graph\SwitchBranchesTreeGraphMutator;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphLinkRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphNodeRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector;
use FloatingBits\EvolutionaryAlgorithm\Specimen\CollectionReplenishInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DirectedImageProcessingLinkFactory;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNodeFactory;
use Floatingbits\ImageProcessingEaProblems\Mutation\DrawActionModifierDeltaMutator;
use Floatingbits\ImageProcessingEaProblems\Phenotype\TreeGraphImagePhenotypeFactory;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DefaultDrawActionModifierRandomizer;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DefaultDrawActionRandomizer;

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
            $this->createSwitchBranchesMutator(),
            $this->createCopyBranchesMutator(),
            $this->createCutBranchesMutator(),
            $this->createCreateBranchesMutator()
        ];
    }
    private function createCreateBranchesMutator(): CollectionReplenishInterface{
        return new CollectionMutator(
            new CreateBranchTreeGraphMutator(
                new TreeGraphRandomizer(
                    new IntRandomizer(4),
                    new TreeGraphNodeRandomizer(new IntRandomizer()),
                    new DrawActionNodeFactory(new DefaultDrawActionRandomizer()),
                    new DirectedImageProcessingLinkFactory(new DefaultDrawActionModifierRandomizer())
                ),
                new TreeGraphNodeRandomizer()
            ),
            new IntRandomizer(),
            4
        );
    }
    private function createCutBranchesMutator(): CollectionReplenishInterface{
        return new CollectionMutator(
            new CutBranchTreeGraphMutator(
                new TreeGraphLinkRandomizer()
            ),
            new IntRandomizer(),
            5
        );
    }
    private function createCopyBranchesMutator(): CollectionReplenishInterface{
        return new CollectionMutator(
            new SwitchBranchesTreeGraphMutator(
                new TreeGraphLinkRandomizer(),
                new TreeGraphNodeRandomizer(),
                true
            ),
            new IntRandomizer(),
            4
        );
    }
    private function createSwitchBranchesMutator(): CollectionReplenishInterface{
        return new CollectionMutator(
            new SwitchBranchesTreeGraphMutator(
                new TreeGraphLinkRandomizer(),
                new TreeGraphNodeRandomizer()
            ),
            new IntRandomizer(),
            5
        );
    }
    private function createDrawActionModifierMutator(): CollectionReplenishInterface {
        return new CollectionMutator(
            new DrawActionModifierDeltaMutator(
                new DefaultDrawActionModifierRandomizer(),
            ),
            new IntRandomizer(),
            5
        );
    }

    protected function createPhenotypeGenerator(): PhenotypeGeneratorInterface
    {
        return new TreeGraphImagePhenotypeFactory();
    }


}