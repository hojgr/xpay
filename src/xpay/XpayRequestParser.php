<?php


namespace Hicoria\Xpay;


use Nette\Object;

class XpayRequestParser extends Object {
    public static function parse(array $arr) {
        $entity = new XpayMessageEntity();

        foreach($arr as $index => $contents) {
            if(property_exists($entity, $index))
                $entity->$index = $contents;
        }

        return $entity;
    }
} 