<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\Imagick;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\ImageProcessorFactoryInterface;

class ImageProcessorFactory implements ImageProcessorFactoryInterface
{
    public function createImageProcessor()
    {
        return new ImagickImageProcessor();
    }


}