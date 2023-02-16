<?php

namespace Floatingbits\ImageProcessingEaProblems\Mutation;

use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\LinkIndexFinder;
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraphInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use Floatingbits\ImageProcessingEaProblems\Graph\DirectedImageProcessingLink;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DrawActionModifierRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
/**
 * @implements MutatorInterface<TreeGraphGenotypeInterface<DrawActionNode>>
 */
abstract class AbstractDrawActionModifierMutator implements MutatorInterface
{
    public function __construct(
        private  ?ConfigurableIntRandomizerInterface $intRandomizer = null
    )
    {
        if ($this->intRandomizer === null) {
            $this->intRandomizer = new IntRandomizer();
        }
    }

    /**
     * @param TreeGraphInterface<DrawActionNode> $treeGraph
     * @return ?DirectedImageProcessingLink
     */
    protected function getRandomLink(TreeGraphInterface $treeGraph) {
        $numLinks = $treeGraph->countLinks();
        if (!$numLinks) {
            return null;
        }
        $this->intRandomizer->setMin(0);
        $this->intRandomizer->setMax($numLinks - 1);
        $randomLinkIndex = $this->intRandomizer->randomInt();
        $linkIndexFinder = new LinkIndexFinder($randomLinkIndex);
        $treeGraph->iterateUp($linkIndexFinder);
        return $linkIndexFinder->getDirectedLink();
    }

}