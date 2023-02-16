<?php

namespace Floatingbits\ImageProcessingEaProblems\Problem\RandomEvaluator;

use FloatingBits\EvolutionaryAlgorithm\Evolution\EvolverFactoryInterface;
use FloatingBits\EvolutionaryAlgorithm\Problem\ProblemInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;
use Floatingbits\ImageProcessingEaProblems\Specimen\ImageGenerationSpecimenGenerator;

class Problem implements ProblemInterface
{
    public function getEvolverFactory(): EvolverFactoryInterface
    {
        return new EvolverFactory();
    }

    public function getSpecimenGenerator(): SpecimenGeneratorInterface
    {
       return new ImageGenerationSpecimenGenerator();
    }

}