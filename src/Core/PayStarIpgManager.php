<?php

namespace PayStar\Ipg\Core;

use PayStar\Ipg\Driver\PayStar;

class PayStarIpgManager
{
    // Config and driver
    protected $config;
    protected $driver;

    // Necessary options
    protected $amount;
    protected $orderId;
    protected $sign;
    protected $callbackUrl;

    /* Optional options [
        'name',
        'phone',
        'mail',
        'description',
        'allotment',
        'callback_method',
        'wallet_hashid',
        'national_code',
    ] */
    protected $option;

    // For verify
    protected $refNum;

    public function __construct(PayStar $payStar)
    {
        $this->config = config('paystar-ipg');
        $this->driver = $payStar;
    }

    // Driver's methods
    public function create()
    {
        return $this->driver->create($this->amount, $this->orderId, $this->callbackUrl, $this->sign, $this->option);
    }

    public function payment()
    {
        return $this->driver->payment($this->token);
    }

    public function verify()
    {
        return $this->driver->verify($this->refNum, $this->amount, $this->sign);
    }

    // Parameters
    public function amount($amount = null)
    {
        $this->amount = $amount;
        return $this;
    }

    public function orderId($orderId = null)
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function sign($sign = null)
    {
        $this->sign = $sign;
        return $this;
    }

    public function callbackUrl($callbackUrl = null)
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }

    public function option($option = [])
    {
        $this->option = $option;
        return $this;
    }

    // For payment
    public function token($token = null)
    {
        $this->token = $token;
        return $this;
    }

    // For verify
    public function refNum($refNum = null)
    {
        $this->refNum = refNum;
        return $this;
    }
}
