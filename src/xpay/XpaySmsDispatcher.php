<?php


namespace Hicoria\Xpay;


use Hicoria\Xpay\response\XpayResponse;
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
        if(in_array($paymentEntity->getTransactionId(), ["delivered", "undelivered"])) {
            $response = new XpayResponse(XpayResponse::TYPE_ANSWER, sprintf("Vase SMS nemohla byt zpracovana. Kontaktujte podporu hostingu Hicoria.com s kodem: %s", $paymentEntity->getPassword()));
            $response->sendResponse();

        } else {
            foreach($this->getProcessors() as $processor) {
                $success = preg_match(
                    "~" . preg_replace("/~/", "\\~", $processor->getRegexp()) . "~i",
                    trim($paymentEntity->getRaw()),
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