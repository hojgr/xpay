<?php


namespace tests;


use Hicoria\Xpay\XpayMessageEntity;
use Hicoria\Xpay\XpayRequestParser;
use PHPUnit_Framework_TestCase;

class XpayRequestParserTest extends PHPUnit_Framework_TestCase {
    public function testParse() {
        $example = [
            'modified' => 'base text',
            'currency' => 'CZK',
            'memberId' => 2
        ];

        /**
         * @var XpayMessageEntity $parsed
         */
        $parsed = XpayRequestParser::parse($example);

        $this->assertSame('base text', $parsed->getModified());
        $this->assertSame('CZK', $parsed->getCurrency());
        $this->assertSame(2, $parsed->getMemberId());
    }
} 