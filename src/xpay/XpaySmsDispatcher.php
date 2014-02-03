<?php


namespace Hicoria\Xpay;


use Nette\Object;

class XpaySmsDispatcher extends Object {

    /**
     * @var IMessageProcessor[]
     */
    private $processors = [];

    public function register(IMessageProcessor $processor) {
        $this->processors[] = $processor;
    }

    public function sortByPriority() {
        usort($this->processors, function($a, $b) {
            return $b->getPriority() - $a->getPriority();
        });
    }

    public function process(XpayMessageEntity $paymentEntity) {
        foreach($this->getProcessors() as $processor) {
            $success = preg_match(
                "~" . preg_replace("/~/", "\\~", $processor->getRegexp()) . "~i",
                trim($paymentEntity->getModified()),
                $matches);

            // continue for both, error and no match
            if(!$success)
                continue;

            // drop first element - we want matches in parentheses
            array_shift($matches);

            $processor->process($paymentEntity, $matches);
            $processor->getResponse()->sendResponse();
            break;
        }

        return true;
    }

    /**
     * @return \Hicoria\Xpay\IMessageProcessor[]
     */
    public function getProcessors()
    {
        return $this->processors;
    }
}