<?php


namespace tests;

use Hicoria\Xpay\XpayMessageEntity;
use Hicoria\Xpay\XpaySmsDispatcher;

class XpaySmsDispatcherTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var XpaySmsDispatcher
     */
    public $xpayDispatcher;

    public function setUp() {
        $this->xpayDispatcher = new XpaySmsDispatcher();
    }

    public function testRegister() {
        $mock = $this->getMockBuilder("Hicoria\\Xpay\\IMessageProcessor")
            ->setMethods(["process"])
            ->getMock();

        $this->xpayDispatcher->register("csmc ([a-z]+)", $mock);
    }

    public function testProcess() {
        /**
         * @var XpaySmsDispatcher|\PHPUnit_Framework_MockObject_MockObject $xpaySmsDispatcher
         */
        $xpaySmsDispatcher = $this->getMockBuilder("Hicoria\\Xpay\\XpaySmsDispatcher")
            ->setMethods(['getProcessors'])
            ->getMock();

        $processor_mock = $this->getMockBuilder("Hicoria\\Xpay\\IMessageProcessor")
            ->setMethods(["process"])
            ->getMock();

        $xpaySmsDispatcher->expects($this->once())
            ->method("getProcessors")
            ->will($this->returnValue(['keyword ([0-9]+)' => $processor_mock]));

        $result = $xpaySmsDispatcher->process(new XpayMessageEntity());

        $this->assertSame(0, $result);
    }

    /**
     * This tests only checks the preg_match evaulation
     * to allow tildes to be used in regexp and prevent
     * issues with it
     */
    public function testProcessWithTildeInRegexp() {
        /**
         * @var XpaySmsDispatcher|\PHPUnit_Framework_MockObject_MockObject $xpaySmsDispatcher
         */
        $xpaySmsDispatcher = $this->getMockBuilder("Hicoria\\Xpay\\XpaySmsDispatcher")
            ->setMethods(['getProcessors'])
            ->getMock();

        $processor_mock = $this->getMockBuilder("Hicoria\\Xpay\\IMessageProcessor")
            ->setMethods(["process"])
            ->getMock();

        $xpaySmsDispatcher->expects($this->once())
            ->method("getProcessors")
            ->will($this->returnValue(['keyword ~([0-9]+)' => $processor_mock]));

        $xpaySmsDispatcher->process(new XpayMessageEntity());
    }
} 