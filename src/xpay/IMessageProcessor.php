<?php


namespace Hicoria\Xpay;


interface IMessageProcessor {
    public function getRegexp();
    public function process(XpayMessageEntity $xpayMessageEntity, array $args);
}