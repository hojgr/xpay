<?php


namespace Hicoria\Xpay;


use Nette\Object;

class XpayRequestParser extends Object {
    public static function parse(array $arr) {
        $entity = new XpayMessageEntity();

        foreach($arr as $index => $contents) {
            $index = preg_replace("/ID/", "Id", $index);
            $method = 'set' . ucfirst($index);
            if(method_exists($entity, $method))
                $entity->$method($contents);
        }

        return $entity;
    }
} 