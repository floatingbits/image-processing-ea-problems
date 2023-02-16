<?php

namespace Floatingbits\ImageProcessingEaProblems\Specimen;

use FloatingBits\EvolutionaryAlgorithm\Genotype\TreeGraphGenotype;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphNodeRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Specimen\Specimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;
use Floatingbits\ImageProcessingEaProblems\Graph\DirectedImageProcessingLinkFactory;
use Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNodeFactory;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DefaultDrawActionModifierRandomizer;
use Floatingbits\ImageProcessingEaProblems\Randomizer\DefaultDrawActionRandomizer;

class ImageGenerationSpecimenGenerator implements SpecimenGeneratorInterface
{

    public function generateSpecimen(int $populationSize): SpecimenCollection
    {
        $treeRandomizer = new TreeGraphRandomizer(
            new IntRandomizer(10),
            new TreeGraphNodeRandomizer(new IntRandomizer()),
            new DrawActionNodeFactory(new DefaultDrawActionRandomizer()),
            new DirectedImageProcessingLinkFactory(new DefaultDrawActionModifierRandomizer())
        );
        $specimenCollection = new SpecimenCollection();
        while ($populationSize--) {
            $specimen = new Specimen();
            $genotype = new TreeGraphGenotype();
            $genotype->setTreeGraph($treeRandomizer->randomTreeGraph());
            $specimen->setGenotype($genotype);
            $specimenCollection->addSpecimen($specimen);
        }
        return $specimenCollection;
    }


}