<?php


namespace Hicoria\Xpay;


use Nette\Object;

class PaymentEntity extends Object
{
    /**
     * Jedinečný identifikátor transakce
     *
     * @var integer
     * @length 20
     */
    protected $id;

    /**
     * Jedinečný identifikátor transakce platebním partnerem
     *
     * @var string
     * @length 32
     */
    protected $session_id;

    /**
     * Jedinečný identifikátor členství daného uživatele
     *
     * @var integer
     * @length 20
     */
    protected $member_id;

    /**
     * Jedinečný identifikátor vytvářený při volání platební brány před provedením transakce
     *
     * @var string
     * @length 32
     */
    protected $temp_id;

    /**
     * Identifikátor transakce
     *
     * @var string
     * @length 32
     */
    protected $transaction_id;

    /**
     * Datum přenosu informace ve formátu ISO 8601 s nahrazením znaku „T“ znakem mezera. Datum se uvádí v časovém pásmu CET, případně CEST
     *
     * @var \DateTime
     * @length -
     * @example 0000-00-00 00:00:00
     */
    protected $transfer_date;

    /**
     * Datum přenosu informace ve formátu UNIX timestamp
     *
     * @var integer
     * @length 20
     */
    protected $transfer_timestamp;

    /**
     * Označení druhu přenosu
     *
     * @var string
     * @length 8
     */
    protected $transfer_type;

    /**
     * Jedinečný identifikátor Vašeho projektu. Hodnota je Vám přidělena systémem Xpay
     *
     * @var integer
     * @length 20
     */
    protected $project_id;

    /**
     * Použitá platební metoda (jeden projekt může obsahovat více platebních metod
     *
     * @var integer
     * @length 20
     * @example 0 - 99
     */
    protected $payment_method;

    /**
     * Identifikuje použitý tarif (jeden projekt může obsahovat více tarifů
     *
     * @var integer
     * @length 20
     */
    protected $payment_method_id;

    /**
     * Identifikuje použitou cenu (jeden tarif může obsahovat více cen
     *
     * @var integer
     * @length 20
     */
    protected $payment_amount_id;

    /**
     * Obchodní model transakce. Hodnota 0 znamená prodej členství/přístupů. Hodnota 1 znamená prodej fyzického zboží
     *
     * @var integer
     * @length 1
     * @example 0
     * @example 1
     */
    protected $sell_type;

    /**
     * Uživatelské jméno pokud je pro danou platební metodu aplikovatelné
     *
     * @var string
     * @length 64
     */
    protected $username;

    /**
     * Uživatelské heslo pokud je pro danou platební metodu aplikovatelné
     *
     * @var string
     * @length 64
     */
    protected $password;

    /**
     * Délka trvání placeného přístupu v hodinách pokud je pro danou platební metodu aplikovatelná
     *
     * @var integer
     * @length 15
     */
    protected $duration;

    /**
     * Zaplacená částka. V případě storna je záporná. V případě více SMS se jedná o cenu za jednu SMS
     *
     * @var float
     * @length 20.2
     * @example 12345.67
     */
    protected $amount;

    /**
     * Celková zaplacená částka. V případě storna je záporná. V případě více SMS se jedná o cenu za všechny SMS
     *
     * @var float
     * @length 20.2
     * @example 12345.67
     */
    protected $total_amount;

    /**
     * Měna použitá při platbě ve formátu ISO 4217
     *
     * @var string
     * @length 3
     */
    protected $currency;

    /**
     * Emailová adresa zákazníka pokud ji vyplnil a je pro danou platební metodu aplikovatelná
     *
     * @var string
     * @length 255
     */
    protected $email;

    /**
     * Datum platby ve formátu ISO 8601 s nahrazením znaku „T“ znakem mezera. Datum se uvádí v časovém pásmu CET, případně CEST
     *
     * @var \DateTime
     * @length -
     * @example 0000-00-00 00:00:00
     */
    protected $transaction_date;

    /**
     * Datum platby ve formátu UNIX timestamp
     *
     * @var integer
     * @length 20
     */
    protected $transaction_timestamp;

    /**
     * Platnost ve formátu ISO 8601 s nahrazením znaku „T“ znakem mezera. Datum se uvádí v časovém pásmu CET, případně CEST.
     *
     * @var \DateTime
     * @length -
     * @example 0000-00-00 00:00:00
     */
    protected $validity_date;

    /**
     * Platnost ve formátu UNIX timestamp
     *
     * @var integer
     * @length 20
     */
    protected $validity_timestamp;

    /**
     * Volitelný parametr pro libovolné použití klientem
     *
     * @var string
     * @length 32
     */
    protected $P1;

    /**
     * Volitelný parametr pro libovolné použití klientem
     *
     * @var string
     * @length 32
     */
    protected $P2;

    /**
     * Volitelný parametr pro libovolné použití klientem
     *
     * @var string
     * @length 32
     */
    protected $P3;

    /**
     * Identifikační parametr pro provizní systém. Nemáte-li od nás tyto hodnoty přiděleny, ponechejte 0
     *
     * @var integer
     * @length 20
     */
    protected $TID;

    /**
     * Identifikační parametr pro provizní systém. Nemáte-li od nás tyto hodnoty přiděleny, ponechejte 0
     *
     * @var integer
     * @length 20
     */
    protected $TID1;

    /**
     * Identifikační parametr provizního systému. Hodnoty 0,1,2,3,4,5,6 jsou rezervované hodnoty. Nemáte-li od nás tyto hodnoty přiděleny, ponechejte 0
     *
     * @var integer
     * @length 20
     * @example 0 - 99
     */
    protected $TID2;

    /**
     * IP adresa zákazníka
     *
     * @var string
     * @length 15
     * @example xxx.xxx.xxx.xxx
     */
    protected $IP;

    /**
     * Typ transakce
     *
     * @var string
     * @length 8
     */
    protected $action;

    /**
     * Jazyk zvolený při platbě v dvoupísmenném kódu
     *
     * @var string
     * @length 2
     * @example cz
     * @example de
     * @example en
     * @example pl
     */
    protected $language;

    /**
     * Země zvolená zákazníkem v dvoupísmenném kódu
     *
     * @var string
     * @length 2
     * @example CZ
     * @example EN
     * @example DE
     * @example
     */
    protected $country;

    /**
     * Telefonní číslo placené služby SMS nebo telefonní
     *
     * @var string
     * @length 32
     */
    protected $service_number;

    /**
     * Klíčové slovo
     *
     * @var string
     * @length 32
     */
    protected $keyword;

    /**
     * Telefonní číslo zákazníka ve formátu MSISDN včetně předvolby dle ITU E.164 a počátečního znaku „+“
     *
     * @var string
     * @length 32
     * @example +420123456789
     */
    protected $phone_number;

    /**
     * Identifikace telefonního operátora dle ITU E.212
     *
     * @var integer
     * @length 6
     * @example 23001
     * @example  26003
     * @example  23102
     * @example
     */
    protected $phone_operator;

    /**
     * Neupravený text zprávy při použití platebních metod s SMS
     *
     * @var string
     * @length 160
     */
    protected $raw;

    /**
     * Upravený text zprávy při použití platebních metod s SMS
     *
     * @var string
     * @length 160
     */
    protected $modified;

    /**
     * URL transakčního skriptu klienta
     *
     * @var string
     * @length 255
     */
    protected $confirm_url;

    /**
     * Verze přenosového protokolu. Aktuálně 1.4
     *
     * @var string
     * @length 8
     */
    protected $version;

    /**
     * Testovací režim platebního systému. Hodnota 1 značí testovací transakci
     *
     * @var integer
     * @length 1
     * @example 0
     * @example 1
     */
    protected $test;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return $this->session_id;
    }

    /**
     * @param string $session_id
     */
    public function setSessionId($session_id)
    {
        $this->session_id = $session_id;
    }

    /**
     * @return int
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * @param int $member_id
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
    }

    /**
     * @return string
     */
    public function getTempId()
    {
        return $this->temp_id;
    }

    /**
     * @param string $temp_id
     */
    public function setTempId($temp_id)
    {
        $this->temp_id = $temp_id;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transaction_id;
    }

    /**
     * @param string $transaction_id
     */
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * @return \DateTime
     */
    public function getTransferDate()
    {
        return $this->transfer_date;
    }

    /**
     * @param \DateTime $transfer_date
     */
    public function setTransferDate($transfer_date)
    {
        $this->transfer_date = $transfer_date;
    }

    /**
     * @return int
     */
    public function getTransferTimestamp()
    {
        return $this->transfer_timestamp;
    }

    /**
     * @param int $transfer_timestamp
     */
    public function setTransferTimestamp($transfer_timestamp)
    {
        $this->transfer_timestamp = $transfer_timestamp;
    }

    /**
     * @return string
     */
    public function getTransferType()
    {
        return $this->transfer_type;
    }

    /**
     * @param string $transfer_type
     */
    public function setTransferType($transfer_type)
    {
        $this->transfer_type = $transfer_type;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * @param int $project_id
     */
    public function setProjectId($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * @return int
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }

    /**
     * @param int $payment_method
     */
    public function setPaymentMethod($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    /**
     * @return int
     */
    public function getPaymentMethodId()
    {
        return $this->payment_method_id;
    }

    /**
     * @param int $payment_method_id
     */
    public function setPaymentMethodId($payment_method_id)
    {
        $this->payment_method_id = $payment_method_id;
    }

    /**
     * @return int
     */
    public function getPaymentAmountId()
    {
        return $this->payment_amount_id;
    }

    /**
     * @param int $payment_amount_id
     */
    public function setPaymentAmountId($payment_amount_id)
    {
        $this->payment_amount_id = $payment_amount_id;
    }

    /**
     * @return int
     */
    public function getSellType()
    {
        return $this->sell_type;
    }

    /**
     * @param int $sell_type
     */
    public function setSellType($sell_type)
    {
        $this->sell_type = $sell_type;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->total_amount;
    }

    /**
     * @param float $total_amount
     */
    public function setTotalAmount($total_amount)
    {
        $this->total_amount = $total_amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getTransactionDate()
    {
        return $this->transaction_date;
    }

    /**
     * @param \DateTime $transaction_date
     */
    public function setTransactionDate($transaction_date)
    {
        $this->transaction_date = $transaction_date;
    }

    /**
     * @return int
     */
    public function getTransactionTimestamp()
    {
        return $this->transaction_timestamp;
    }

    /**
     * @param int $transaction_timestamp
     */
    public function setTransactionTimestamp($transaction_timestamp)
    {
        $this->transaction_timestamp = $transaction_timestamp;
    }

    /**
     * @return \DateTime
     */
    public function getValidityDate()
    {
        return $this->validity_date;
    }

    /**
     * @param \DateTime $validity_date
     */
    public function setValidityDate($validity_date)
    {
        $this->validity_date = $validity_date;
    }

    /**
     * @return int
     */
    public function getValidityTimestamp()
    {
        return $this->validity_timestamp;
    }

    /**
     * @param int $validity_timestamp
     */
    public function setValidityTimestamp($validity_timestamp)
    {
        $this->validity_timestamp = $validity_timestamp;
    }

    /**
     * @return string
     */
    public function getP1()
    {
        return $this->P1;
    }

    /**
     * @param string $P1
     */
    public function setP1($P1)
    {
        $this->P1 = $P1;
    }

    /**
     * @return string
     */
    public function getP2()
    {
        return $this->P2;
    }

    /**
     * @param string $P2
     */
    public function setP2($P2)
    {
        $this->P2 = $P2;
    }

    /**
     * @return string
     */
    public function getP3()
    {
        return $this->P3;
    }

    /**
     * @param string $P3
     */
    public function setP3($P3)
    {
        $this->P3 = $P3;
    }

    /**
     * @return int
     */
    public function getTID()
    {
        return $this->TID;
    }

    /**
     * @param int $TID
     */
    public function setTID($TID)
    {
        $this->TID = $TID;
    }

    /**
     * @return int
     */
    public function getTID1()
    {
        return $this->TID1;
    }

    /**
     * @param int $TID1
     */
    public function setTID1($TID1)
    {
        $this->TID1 = $TID1;
    }

    /**
     * @return int
     */
    public function getTID2()
    {
        return $this->TID2;
    }

    /**
     * @param int $TID2
     */
    public function setTID2($TID2)
    {
        $this->TID2 = $TID2;
    }

    /**
     * @return string
     */
    public function getIP()
    {
        return $this->IP;
    }

    /**
     * @param string $IP
     */
    public function setIP($IP)
    {
        $this->IP = $IP;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getServiceNumber()
    {
        return $this->service_number;
    }

    /**
     * @param string $service_number
     */
    public function setServiceNumber($service_number)
    {
        $this->service_number = $service_number;
    }

    /**
     * @return string
     */
    public function getKeyword()
    {
        return $this->keyword;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return int
     */
    public function getPhoneOperator()
    {
        return $this->phone_operator;
    }

    /**
     * @param int $phone_operator
     */
    public function setPhoneOperator($phone_operator)
    {
        $this->phone_operator = $phone_operator;
    }

    /**
     * @return string
     */
    public function getRaw()
    {
        return $this->raw;
    }

    /**
     * @param string $raw
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;
    }

    /**
     * @return string
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param string $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @return string
     */
    public function getConfirmUrl()
    {
        return $this->confirm_url;
    }

    /**
     * @param string $confirm_url
     */
    public function setConfirmUrl($confirm_url)
    {
        $this->confirm_url = $confirm_url;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return int
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param int $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }
}