<?php


namespace Hicoria\Xpay;


use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;

class XpayExtension extends CompilerExtension {
    public function loadConfiguration()
    {
        $config = $this->getConfig();
        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('xpaySmsDispatcher'))
            ->setClass('Hicoria\Xpay\XpaySmsDispatcher')
            ->addTag('xpaySmsDispatcher');
    }

    /**
     * @param ClassType $class
     */
    public function afterCompile(ClassType $class) {
        /**
         * @var IMessageProcessor $tagged
         */

        $initialize = $class->methods['initialize'];
        $containerBuilder = $this->getContainerBuilder();

        $dispatcher_name = key($containerBuilder->findByTag('xpaySmsDispatcher'));

        foreach($containerBuilder->findByTag("xpaySmsProcessor") as $index => $value) {
            $initialize->addBody(
                '$this->getService(?)->register($this->getService(?)->getRegexp(), $this->getService(?));',
                array(
                    $dispatcher_name,
                    $index,
                    $index
                )
            );
        }
    }
} 