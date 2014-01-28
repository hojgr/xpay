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

    public function process(PaymentEntity $paymentEntity) {
        foreach($this->getProcessors() as $regexp => $processor) {
            $success = preg_match_all("~" . preg_replace("/~/", "\\~", $regexp) . "~", $paymentEntity->getModified(), $matches);

            // drop first element - we want matches in parentheses
            array_shift($matches);

            // continue for both, error and no match
            if(!$success)
                return $success;

            $processor->process($matches);

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