<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\DirectedLinksContainerTrait;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\ImageProcessorInterface;

/**
 * @template T1
 * @template-implements NodeInterface<T1>
 */
abstract class AbstractImageProcessingNode implements NodeInterface
{
    use DirectedLinksContainerTrait;

    public function __construct()
    {
        $this->incomingLinks = new \SplObjectStorage();
        $this->outgoingLinks = new \SplObjectStorage();
    }

    public function __clone(): void
    {
        $this->incomingLinks = clone $this->incomingLinks;
        $this->outgoingLinks = clone $this->outgoingLinks;
    }

    /**
     * @var T1
     */
    private ?ImageProcessorInterface $processor = null;
    /**
     * @return T1
     */
    public function getContent()
    {
        return $this->processor;
    }

    /**
     * @param T1 $content
     * @return void
     */
    public function setContent($content): void
    {
        $this->processor = $content;
    }



}