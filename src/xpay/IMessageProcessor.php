<?php


namespace Hicoria\Xpay;


use Hicoria\Xpay\response\IXpayResponse;

interface IMessageProcessor {
    public function getRegexp();
    public function process(XpayMessageEntity $xpayMessageEntity, array $args);

    /**
     * @return IXpayResponse
     */
    public function getResponse();
}