<?php

namespace PayStar\Ipg\Core;

class HMAC
{
    public function algos()
    {
        return hash_hmac_algos();
    }

    public function hash($algo, $string, $key, $binary = false)
    {
        return hash_hmac($algo, $string, $key, $binary);
    }

    public function sign($amount, $orderId, $callbackUrl)
    {
        return $this->hash(config('paystar-ipg.encryption_algorithm'),
            $amount . '#' . $orderId . '#' . $callbackUrl,
            config('paystar-ipg.encryption_key'));
    }
}
