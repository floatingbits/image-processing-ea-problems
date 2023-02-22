<?php

namespace Floatingbits\ImageProcessingEaProblems\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\FloatRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\FloatRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizer;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\Color;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\CircleDrawAction;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\DrawActionEnum;

class DefaultDrawActionRandomizer implements DrawActionRandomizerInterface
{
    private IntRandomizer $actionClassRandomizer;

    private FloatRandomizerInterface $coordinateRandomizer;
    public function __construct()
    {
        $this->actionClassRandomizer = new IntRandomizer();
        $this->coordinateRandomizer = new FloatRandomizer();
    }

    public function getRandomDrawAction(): AbstractDrawAction
    {
        $cases = DrawActionEnum::cases();
        $this->actionClassRandomizer->setMax(sizeof($cases) - 1);
        $case = $cases[$this->actionClassRandomizer->randomInt()];
        switch ($case) {
            case DrawActionEnum::CircleDrawAction:
                $action = new CircleDrawAction();
                $this->configureCircleDrawAction($action);
                break;
        }
        return $action;
    }

    private function configureCircleDrawAction(CircleDrawAction $action) {
        $this->configureCommon($action);
        $action->setRelativeRadius($this->coordinateRandomizer->randomFloat()/2);
    }
    private function configureCommon(AbstractDrawAction $action) {
        $action->setRelativeX($this->coordinateRandomizer->randomFloat());
        $action->setRelativeY($this->coordinateRandomizer->randomFloat());
        $action->setFillColor($this->getRandomColor());
        $action->setStrokeColor($this->getRandomColor());
    }

    private function getRandomColor():Color {
        $color = new Color(mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        return $color;
    }
}