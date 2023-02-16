<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

/**
 * @todo AbstractImageProcessingNode not really needed
 */
class DrawActionNode extends AbstractImageProcessingNode
{
    private ?AbstractDrawAction $drawAction = null;

    public function __clone(): void
    {
        parent::__clone();
        $this->drawAction = clone $this->drawAction;
    }

    /**
     * @return AbstractDrawAction|null
     */
    public function getDrawAction(): ?AbstractDrawAction
    {
        return $this->drawAction;
    }

    /**
     * @param AbstractDrawAction|null $drawAction
     */
    public function setDrawAction(?AbstractDrawAction $drawAction): void
    {
        $this->drawAction = $drawAction;
    }

}