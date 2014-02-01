<?php


namespace Hicoria\Xpay;


use Nette\Object;

class XpaySmsDispatcher extends Object {

    /**
     * @var IMessageProcessor[]
     */
    private $processors;

    public function register($regex, IMessageProcessor $processor) {
        $this->processors[$regex] = $processor;
    }

    public function process(XpayMessageEntity $paymentEntity) {
        foreach($this->getProcessors() as $regexp => $processor) {
            $success = preg_match(
                "~" . preg_replace("/~/", "\\~", $regexp) . "~",
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