<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkCallableInterface;
use \FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\ImageProcessorInterface;

/**
 * @template T
 */
class ImageProcessingLinkCallable implements FollowLinkCallableInterface
{
    /**
     * @var T
     */
    private $image;
    /**
     * @var ImageProcessorInterface<T>
     */
    private ImageProcessorInterface $imageProcessor;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @param DirectedLinkInterface $directedLink
     * @return bool true if iteration is supposed to break
     */
    public function __invoke(DirectedLinkInterface $directedLink): bool
    {
        if ($directedLink instanceof FollowLinkInterface) {
            $directedLink->follow();
        }
        /**
         * @var $endNode DrawActionNode
         */
        $endNode = $directedLink->getEndNode();
        /**
         * @todo this is where we could use abstraction to be a bit more type safe when it comes to different image processors
         */
        $this->imageProcessor->process($this->image, $endNode->getDrawAction());
        return false;
    }

    /**
     * @return ImageProcessorInterface
     */
    public function getImageProcessor(): ImageProcessorInterface
    {
        return $this->imageProcessor;
    }

    /**
     * @param ImageProcessorInterface $imageProcessor
     */
    public function setImageProcessor(ImageProcessorInterface $imageProcessor): void
    {
        $this->imageProcessor = $imageProcessor;
    }


    public function startNode(NodeInterface $node) {}
    public function endNode(NodeInterface $node) {}

}