<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

/**
 * @template T
 */
interface ImageProcessorInterface
{
    /**
     * @param T $image
     * @return void
     */
    public function process(mixed $image, AbstractDrawAction $drawAction): void;
}