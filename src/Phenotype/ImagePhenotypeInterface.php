<?php

namespace Floatingbits\ImageProcessingEaProblems\Phenotype;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeInterface;

/**
 * @template T
 */
interface ImagePhenotypeInterface extends PhenotypeInterface
{
    /**
     * @return T
     */
    public function getImage();
}