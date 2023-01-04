<?php

namespace Floatingbits\ImageProcessingEaProblems\Graph;

use Floatingbits\ImageProcessingEaProblems\ImageProcessing\DrawAction\AbstractDrawAction;

/**
 * @todo AbstractImageProcessingNode not really needed
 */
class DrawActionNode extends AbstractImageProcessingNode
{
    public ?AbstractDrawAction $drawAction = null;

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