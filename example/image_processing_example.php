<?php
require_once '../vendor/autoload.php';
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraph;
use Floatingbits\ImageProcessingEaProblems\Graph\DirectedImageProcessingLink;

$populationSize = 5;
$generator = new \Floatingbits\ImageProcessingEaProblems\Specimen\ImageGenerationSpecimenGenerator();
$specimenCollection = $generator->generateSpecimen($populationSize);
$selector = new \FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector(0.5);
$mutator = new \FloatingBits\EvolutionaryAlgorithm\Mutation\CollectionMutator(
  new \Floatingbits\ImageProcessingEaProblems\Mutation\DrawActionModifierDeltaMutator(
      new \Floatingbits\ImageProcessingEaProblems\Randomizer\DefaultDrawActionModifierRandomizer(),
  ),
  new \FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer(),
  1
);
$mutator2 = new \FloatingBits\EvolutionaryAlgorithm\Mutation\CollectionMutator(
    new \FloatingBits\EvolutionaryAlgorithm\Mutation\Graph\SwitchBranchesTreeGraphMutator(
      new \FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphLinkRandomizer(),
      new \FloatingBits\EvolutionaryAlgorithm\Randomizer\TreeGraphNodeRandomizer()
    ),
    new \FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer(),
    1
);
for ($i = 0; $i< 200; $i++) {
    print "Generation: " . $i. "\n";
    foreach ($specimenCollection as $key => $specimen) {
        print "Specimen: " . $key. "\n";
        $phenotype = new \Floatingbits\ImageProcessingEaProblems\Phenotype\TreeGraphImageProcessorPhenotype($specimen->getGenotype());
        $image = $phenotype->getImage();
        $image->writeImage('output/' . $i . '_'. $key . '.png');
        $specimen->setEvaluation(new \FloatingBits\EvolutionaryAlgorithm\Evaluation\SimpleFitness(mt_rand()));
    }
    $specimenCollection = $selector->select($specimenCollection);
    $specimenCollection = $mutator->replenish($specimenCollection, $populationSize - 1);
    $specimenCollection = $mutator2->replenish($specimenCollection, $populationSize);
}



