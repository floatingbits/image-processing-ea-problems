<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\Imagick;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\Color;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\ImageProcessorInterface;
use Imagick;

/**
 * @template-implements ImageProcessorInterface<Imagick>
 */
class ImagickImageProcessor implements ImageProcessorInterface
{
    private ?\ImagickDraw $draw = null;

    /**
     * @param Imagick $image
     * @return void
     */
    public function process(mixed $image, DrawAction\AbstractDrawAction $drawAction): void
    {
        $this->initDraw($drawAction);
        $this->configureDrawActions($image, $drawAction);
        $image->drawImage($this->draw);
    }

    private function configureDrawActions(\Imagick $image, DrawAction\AbstractDrawAction $drawAction) {
        $x = $image->getImageWidth() * $drawAction->getRelativeX();
        $y = $image->getImageHeight() * $drawAction->getRelativeY();
        if ($drawAction instanceof DrawAction\CircleDrawAction) {
            $radius = $image->getImageWidth() * $drawAction->getRelativeRadius();
            $this->draw->circle(
                $x,
                $y, $x + $radius, $y);
        }

    }

    private function initDraw(DrawAction\AbstractDrawAction $drawAction) {
        $this->draw = new \ImagickDraw();
        $this->draw->setStrokeColor($this->convertColor($drawAction->getStrokeColor()));
        $this->draw->setFillColor($this->convertColor($drawAction->getFillColor()));
    }

    /**
     * @param Color $color
     * @return \ImagickPixel
     * @throws \ImagickPixelException
     */
    private function convertColor(Color $color) {
        return new \ImagickPixel(
            sprintf('rgba(%d,%d,%d,%.2f)',
                $color->getR(),
                $color->getG(),
                $color->getB(),
                $color->getAlpha()
            )
        );
    }
}