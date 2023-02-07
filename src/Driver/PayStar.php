<?php

namespace PayStar\Ipg\Driver;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use PayStar\Ipg\Facades\Encryption;

class PayStar
{
    private $createUrl = 'https://core.paystar.ir/api/pardakht/create';

    private $paymentUrl = 'https://core.paystar.ir/api/pardakht/payment';

    private $verifyUrl = 'https://core.paystar.ir/api/pardakht/verify';

    public function create($amount, $orderId, $callbackUrl, $sign, $option = [])
    {
        try {
            // amount#order_id#callback
            $parameters = [
                'amount'   => $amount,
                'order_id' => $orderId,
                'callback' => $callbackUrl ?? config('paystar-ipg.callback_url'),
                'sign'     => $sign ?? Encryption::sign($amount, $orderId, $callbackUrl),
            ];

            if (isset($option['name']))
                $parameters = array_merge($parameters, ['name' => $option['name']]);
            if (isset($option['phone']))
                $parameters = array_merge($parameters, ['phone' => $option['phone']]);
            if (isset($option['mail']))
                $parameters = array_merge($parameters, ['mail' => $option['mail']]);
            if (isset($option['description']))
                $parameters = array_merge($parameters, ['description' => $option['description']]);
            if (isset($option['allotment']))
                $parameters = array_merge($parameters, ['allotment' => $option['allotment']]);
            if (isset($option['callback_method']))
                $parameters = array_merge($parameters, ['callback_method' => $option['callback_method']]);
            if (isset($option['wallet_hashid']))
                $parameters = array_merge($parameters, ['wallet_hashid' => $option['wallet_hashid']]);
            if (isset($option['national_code']))
                $parameters = array_merge($parameters, ['national_code' => $option['national_code']]);

            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . config('paystar-ipg.gateway_id')
            ])->post($this->createUrl, $parameters);

            return $response;
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function payment($token)
    {
        try {
            header('Location: ' . $this->paymentUrl . '?token=' . $token);
            die();
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function verify($refNum, $amount, $sign)
    {
        try {
            $parameters = [
                'ref_num' => $refNum,
                'amount'  => $amount,
                'sign'    => $sign,
            ];

            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . config('paystar-ipg.gateway_id')
            ])->post($this->verifyUrl, $parameters);

            return $response;
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
