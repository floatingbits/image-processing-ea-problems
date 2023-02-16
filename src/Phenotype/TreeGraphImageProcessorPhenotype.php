<?php

namespace Floatingbits\ImageProcessingEaProblems\Phenotype;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotype;
use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotypeInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode;
use Floatingbits\ImageProcessingEaProblems\Graph\ImageProcessingLinkCallable;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\Imagick\ImagickImageProcessor;
use \Imagick;

class TreeGraphImageProcessorPhenotype implements ImagePhenotypeInterface
{
    /**
     * @var TreeGraphGenotypeInterface<DrawActionNode>
     */
    private TreeGraphGenotypeInterface $treeGraphGenotype;

    /**
     * @param TreeGraphGenotypeInterface<DrawActionNode> $treeGraphGenotype
     */
    public function __construct(TreeGraphGenotypeInterface $treeGraphGenotype)
    {
        $this->treeGraphGenotype = $treeGraphGenotype;
    }

    /**
     * @return Imagick
     */
    public function getImage()
    {
        $image = new Imagick();
        $image->newImage(200,200,new \ImagickPixel('white'));
        $imageProcessor = new ImagickImageProcessor();
        /**
         * @var ImageProcessingLinkCallable<Imagick>
         */
        $callable = new \Floatingbits\ImageProcessingEaProblems\Graph\ImageProcessingLinkCallable();
        $callable->setImage($image);
        $callable->setImageProcessor($imageProcessor);
        $graph = $this->treeGraphGenotype->getTreeGraph();
        $graph->iterateUp($callable);
        return $image;
    }


}