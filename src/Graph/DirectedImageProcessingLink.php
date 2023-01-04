<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\DirectedLinksContainerTrait;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\DirectedLinkTrait;
use FloatingBits\EvolutionaryAlgorithm\Graph\Link\FollowLinkInterface;
use FloatingBits\EvolutionaryAlgorithm\Graph\Node\NodeInterface;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;
use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier\ModifierInterface;

/**
 * @template-implements DirectedLinkInterface<DrawActionNode>
 */
class DirectedImageProcessingLink implements DirectedLinkInterface, FollowLinkInterface
{


    private ?ModifierInterface $modifier = null;

    private ?DrawActionNode $startNode;
    private ?DrawActionNode $endNode;

    public function follow(): void {
        $originAction = $this->startNode->getDrawAction();
        $this->modifier->setOriginalVersion($originAction);
        $this->endNode->setDrawAction($this->modifier->getModifiedVersion());
    }

    /**
     * @return ModifierInterface|null
     */
    public function getModifier(): ?ModifierInterface
    {
        return $this->modifier;
    }

    /**
     * @param ModifierInterface|null $modifier
     */
    public function setModifier(?ModifierInterface $modifier): void
    {
        $this->modifier = $modifier;
    }

    /**
     * @return DrawActionNode
     */
    public function getStartNode(): NodeInterface
    {
        return $this->startNode;
    }

    /**
     * @param DrawActionNode $startNode
     */
    public function setStartNode( $startNode): void
    {
        $this->startNode = $startNode;
    }

    /**
     * @return DrawActionNode
     */
    public function getEndNode(): NodeInterface
    {
        return $this->endNode;
    }

    /**
     * @param DrawActionNode $endNode
     */
    public function setEndNode( $endNode): void
    {
        $this->endNode = $endNode;
    }





}