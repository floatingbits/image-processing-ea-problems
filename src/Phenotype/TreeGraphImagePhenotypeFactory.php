<?php

namespace Floatingbits\ImageProcessingEaProblems\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotype;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;

class TreeGraphImagePhenotypeFactory implements PhenotypeGeneratorInterface
{
    /**
     * @param TreeGraphGenotype<DrawActionNode> $genotype
     * @return mixed|void
     */
    public function generatePhenotype($genotype)
    {
        return new TreeGraphImageProcessorPhenotype($genotype);
    }

}