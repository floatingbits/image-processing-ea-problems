<?php

namespace Floatingbits\ImageProcessingEaProblems\Evaluation;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\SimpleFitness;
use Floatingbits\ImageProcessingEaProblems\Phenotype\ImagePhenotypeInterface;
use \Imagick;
/**
 * @template-implements EvaluatorInterface<ImagePhenotypeInterface<Imagick>>
 */
class ImagickComparisonEvaluator implements EvaluatorInterface
{
    /**
     * @var Imagick
     */
    private Imagick $comparisonImage;
    public function __construct($comparisonImage)
    {
        $this->comparisonImage = $comparisonImage;
    }

    /**
     * @param ImagePhenotypeInterface<Imagick> $phenotype
     * @return FitnessInterface
     */
    public function evaluate($phenotype): FitnessInterface
    {
        [, $mainFitness] = $this->comparisonImage->compareImages($phenotype->getImage(), Imagick::METRIC_MEANSQUAREERROR);

        return new SimpleFitness($mainFitness);
    }
}