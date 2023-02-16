<?php

namespace Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\Modifier;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

abstract class AbstractModifierDecorator extends AbstractModifier
{
    public function __construct(protected ?AbstractModifier $decoratedModifier = null)
    {
    }

    public function getModifiedVersion(): AbstractDrawAction
    {
        if ($this->decoratedModifier) {
            return $this->decoratedModifier->getModifiedVersion();
        }
        return $this->drawAction;
    }

    /**
     * @param AbstractModifier|null $decoratedModifier
     */
    public function setDecoratedModifier(?AbstractModifier $decoratedModifier): void
    {
        $this->decoratedModifier = $decoratedModifier;
    }

    public function setOriginalVersion(AbstractDrawAction $drawAction)
    {
        parent::setOriginalVersion($drawAction);
        if ($this->decoratedModifier) {
            $this->decoratedModifier->setOriginalVersion($drawAction);
        }

    }


}