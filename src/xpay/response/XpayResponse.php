<?php


namespace Hicoria\Xpay\response;


use Nette\Application\AbortException;
use Nette\Object;

class XpayResponse extends Object implements IXpayResponse {
    const TYPE_ERROR = "ERROR";
    const TYPE_ANSWER = "XPAY_ANSWER";
    const TYPE_OK = "XPAY_OK";

    /**
     * @var string
     */
    private $text;

    /**
     * @var integer
     */
    private $type;

    public function __construct($type, $text) {
        $this->text = $text;
        $this->type = $type;
    }

    public function sendResponse() {
        http_response_code(200);
        if($this->type === self::TYPE_OK) {
            echo self::TYPE_OK . "\n";
        } else {
            echo self::TYPE_ANSWER . " $this->text\n";
        }
        throw new AbortException();
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
} 