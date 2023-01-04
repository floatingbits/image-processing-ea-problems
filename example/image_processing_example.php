<?php
require_once '../vendor/autoload.php';
use FloatingBits\EvolutionaryAlgorithm\Graph\Tree\TreeGraph;
use Floatingbits\ImageProcessingEaProblems\Graph\DirectedImageProcessingLink;
$rootNode = new \Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode();
$secondNode = new \Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode();
$thirdNode = new \Floatingbits\ImageProcessingEaProblems\Graph\DrawActionNode();

$imageProcessor = new \Floatingbits\ImageProcessingEaProblems\ImageProcessing\Imagick\ImagickImageProcessor();
$drawAction = new \Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\CircleDrawAction();
$drawAction->setFillColor(new \Floatingbits\ImageProcessingEaProblems\ImageProcessing\Color(50,200,200));
$drawAction->setStrokeColor(new \Floatingbits\ImageProcessingEaProblems\ImageProcessing\Color(50,40,30));
$drawAction->setRelativeX(0.5);
$drawAction->setRelativeY(0.5);
$drawAction->setRelativeRadius(0.2);
$rootNode->setDrawAction($drawAction);

$modifier = new \Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\OriginCoordinateModifier(0.1,0.1);
$directedLink = new DirectedImageProcessingLink();
$directedLink->setModifier($modifier);
$directedLink->setStartNode($rootNode);
$directedLink->setEndNode($secondNode);
$rootNode->addOutgoingLink($directedLink);

$directedLink = new DirectedImageProcessingLink();
$directedLink->setModifier($modifier);
$directedLink->setStartNode($secondNode);
$directedLink->setEndNode($thirdNode);

$secondNode->addOutgoingLink($directedLink);



$image = new \Imagick();
$image->newImage(200,200,new ImagickPixel('white'));

$graph = new TreeGraph($rootNode);
print $graph->countLinks();
$callable = new \Floatingbits\ImageProcessingEaProblems\Graph\ImageProcessingLinkCallable();
$callable->setImage($image);
$callable->setImageProcessor($imageProcessor);

$graph->iterateUp($callable);

$image->writeImage('hello.png');


