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
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\AbstractModifier;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\AbstractModifierDecorator;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\FillColorModifier;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\ModifierEnum;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\OriginCoordinateModifier;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\StrokeColorModifier;

class DefaultDrawActionModifierRandomizer implements DrawActionModifierRandomizerInterface
{
    private IntRandomizer $modifierClassRandomizer;

    private FloatRandomizerInterface $coordinateRandomizer;
    public function __construct()
    {
        $this->modifierClassRandomizer = new IntRandomizer();
        $this->coordinateRandomizer = new FloatRandomizer(0.1);
    }

    public function getRandomDrawActionModifier(): AbstractModifierDecorator
    {
        $cases = ModifierEnum::cases();
        $this->modifierClassRandomizer->setMax(sizeof($cases) - 1);
        $case = $cases[$this->modifierClassRandomizer->randomInt()];
        switch ($case) {
            case ModifierEnum::OriginCoordinateModifier:
                $modifier = new OriginCoordinateModifier(
                    $this->coordinateRandomizer->randomFloat(),
                    $this->coordinateRandomizer->randomFloat()
                );
                break;

            case ModifierEnum::StrokeColorModifier:
                $modifier = new StrokeColorModifier(
                    mt_rand(-127,127),
                    mt_rand(-127,127),
                    mt_rand(-127,127),
                    new OriginCoordinateModifier(
                        $this->coordinateRandomizer->randomFloat(),
                        $this->coordinateRandomizer->randomFloat()
                    )
                );
                break;
            case ModifierEnum::FillColorModifier:
                $modifier = new FillColorModifier(
                    mt_rand(-127,127),
                    mt_rand(-127,127),
                    mt_rand(-127,127),
                    new OriginCoordinateModifier(
                        $this->coordinateRandomizer->randomFloat(),
                        $this->coordinateRandomizer->randomFloat()
                    )
                );
                break;
        }
        return $modifier;
    }

}