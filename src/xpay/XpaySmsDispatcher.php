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
            $success = preg_match_all(
                "~" . preg_replace("/~/", "\\~", $regexp) . "~",
                trim($paymentEntity->getModified()),
                $matches);

            // matched string is not required
            $matches = $matches[1];

            // continue for both, error and no match
            if(!$success)
                return $success;

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