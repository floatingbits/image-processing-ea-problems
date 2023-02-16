<?php
require_once '../vendor/autoload.php';

$problem = new \Floatingbits\ImageProcessingEaProblems\Problem\RandomEvaluator\Problem();
$factory = $problem->getEvolverFactory();
$evolver = $factory->createEvolver();
$specimenGenerator = $problem->getSpecimenGenerator();
$tournament = new \FloatingBits\EvolutionaryAlgorithm\Evolution\DefaultTournament();
$tournament->setEvolver($evolver);
$tournament->setNumRounds(10);
$tournament->setSpecimenCollection($specimenGenerator->generateSpecimen(50));
$currentPopulation = $tournament->getSpecimenCollection();
printPopulation($currentPopulation,'_');

for ($i = 0; $i < 20; $i++) {
    print('Running 10 rounds' . "\n");
    $tournament->runTournament();
    $currentPopulation = $tournament->getSpecimenCollection();
    printPopulation($currentPopulation,$i, 5);
}

function printPopulation(\FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection $population,$round, $max = 0) {
    $population->sortByFitness();
    /** @var \FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface $specimen */
    foreach ($population as $key => $specimen) {
        if ($max && $key >= $max) {
            break;
        }
        /** @var \Floatingbits\ImageProcessingEaProblems\Phenotype\ImagePhenotypeInterface<\Imagick> $phenotype */
        $phenotype = $specimen->getPhenotype();
        if ($phenotype) {
            $image = $phenotype->getImage();
            $image->writeImage('output/' . $round . '_'. $key . '.png');
        }


    }
    print("\n");
}
