<?php


namespace tests;

use Hicoria\Xpay\IMessageProcessor;
use Hicoria\Xpay\response\IXpayResponse;
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
            ->setMethods(["process", "getRegexp", "getPriority", "getResponse"])
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
            ->setMethods(["process", "getRegexp", "getPriority", "getResponse"])
            ->getMock();

        $xpaySmsDispatcher->expects($this->once())
            ->method("getProcessors")
            ->will($this->returnValue(['keyword ([0-9]+)' => $processor_mock]));

        $result = $xpaySmsDispatcher->process(new XpayMessageEntity());

        $this->assertSame(true, $result);
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
            ->setMethods(["process", "getRegexp", "getPriority", "getResponse"])
            ->getMock();

        $xpaySmsDispatcher->expects($this->once())
            ->method("getProcessors")
            ->will($this->returnValue(['keyword ~([0-9]+)' => $processor_mock]));

        $xpaySmsDispatcher->process(new XpayMessageEntity());
    }

    public function testPriority() {
        $testProcessors = [];
        $testProcessors[] = new PriorityTestClassA(1);
        $testProcessors[] = new PriorityTestClassA(999);
        $testProcessors[] = new PriorityTestClassA(80);
        $testProcessors[] = new PriorityTestClassA(20);
        $testProcessors[] = new PriorityTestClassA(2000);

        $dispatcher = new XpaySmsDispatcher();
        $refDispatcher = new \ReflectionObject($dispatcher);
        $refProperty = $refDispatcher->getProperty('processors');
        $refProperty->setAccessible(true);
        $refProperty->setValue($dispatcher, $testProcessors);

        $dispatcher->sortByPriority();

        $this->assertSame(2000, $refProperty->getValue($dispatcher)[0]->getPriority());
        $this->assertSame(999, $refProperty->getValue($dispatcher)[1]->getPriority());
        $this->assertSame(80, $refProperty->getValue($dispatcher)[2]->getPriority());
        $this->assertSame(20, $refProperty->getValue($dispatcher)[3]->getPriority());
        $this->assertSame(1, $refProperty->getValue($dispatcher)[4]->getPriority());
    }
}

class PriorityTestClassA implements IMessageProcessor {

    public $priority;

    public function __construct($p) {
        $this->priority = $p;
    }

    public function getPriority(){
        return $this->priority;
    }
    public function getRegexp(){}
    public function process(XpayMessageEntity $xpayMessageEntity, array $args){}
    public function getResponse(){}
}