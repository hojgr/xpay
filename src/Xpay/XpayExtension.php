<?php


namespace Hicoria\Xpay;


use Nette\DI\CompilerExtension;

class XpayExtension extends CompilerExtension {
    public function loadConfiguration()
    {
        $config = $this->getConfig();
        $builder = $this->getContainerBuilder();

        $this->compiler->parseServices($builder, $this->loadFromFile(__DIR__ . '/blog.neon'));

    }
} 