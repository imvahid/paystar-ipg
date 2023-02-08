# Laravel Package For [PayStar](https://paystar.ir/)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/paystar/laravel-ipg.svg?style=flat-square)](https://packagist.org/packages/paystar/laravel-ipg)
[![GitHub issues](https://img.shields.io/github/issues/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/issues)
[![GitHub stars](https://img.shields.io/github/stars/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/network)
[![Total Downloads](https://img.shields.io/packagist/dt/paystar/laravel-ipg.svg?style=flat-square)](https://packagist.org/packages/paystar/laravel-ipg)
[![GitHub license](https://img.shields.io/github/license/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/blob/master/LICENSE)

#### This is a Laravel Package for PayStar payment gateway.

## <g-emoji class="g-emoji" alias="arrow_down" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/2b07.png">⬇️</g-emoji> How to install and config [paystar/laravel-ipg](https://github.com/imvahid/paystar-ipg) package?

#### Install package
```bash
composer require paystar/laravel-ipg
```
#### Publish configs

```bash
php artisan vendor:publish --tag=paystar-ipg
```

## <g-emoji class="g-emoji" alias="gem" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f48e.png">💎</g-emoji> List of available methods
- <code>create()</code>: return a token
- <code>payment()</code>: auto redirect to gateway
- <code>verify()</code>: verify transaction

## <g-emoji class="g-emoji" alias="book" fallback-src="https://github.githubassets.com/images/icons/emoji/unicode/1f4d6.png">📖</g-emoji> How to use exists methods and options

- #### Use <code>create()</code> method
    ```php
    <?php
    use PayStar\Ipg\Facades\PayStarIpg;
    
    PayStarIpg::amount('AMOUNT') // *
        ->orderId('ORDER_ID') // *
        ->callbackUrl('CALLBACK_URL') // If You don't use this method, we set this from config
        ->sign('SIGN') // If You don't use this method, we generate auto a sign
        ->create();
    ```
    ###### List of extra option
    | Option  | description |
    |---| ------------- |
    | name  | customer name |
    | phone  | customer phone |
    | mail  | customer mail |
    | description  | description of order |
    | allotment  | Share per transaction |
    | callback_method  | - |
    | wallet_hashid  | - |
    | national_code  | national code of customer |
    
    ###### How to use this options
    ```php
    <?php
    use PayStar\Ipg\Facades\PayStarIpg;
    
  PayStarIpg::amount('AMOUNT') // *
        ->orderId('ORDER_ID') // *
        ->callbackUrl('CALLBACK_URL') // If You don't use this method, we set this from config
        ->sign('SIGN') // If You don't use this method, we generate auto a sign
        ->option([
            'name'            => 'Name',
            'phone'           => 'PHONE',
            'mail'            => 'MAIL',
            'description'     => 'DESCRIPTION',
            'allotment'       => 'ALLOTMENT',
            'callback_method' => 'CALLBACK_METHOD',
            'wallet_hashid'   => 'WALLET_HASHID',
            'national_code'   => 'NATIONAL_CODE',
        ])
        ->create();
    ```

- #### Use <code>verify()</code> method
    ```php
    <?php
    use PayStar\Ipg\Facades\PayStarIpg;
    
    PayStarIpg::amount('AMOUNT')
        ->refNum('REF_NUM')
        ->sign('SIGN')
        ->verify();
    ```

- #### Use <code>payment()</code> method
    ```php
    <?php
    use PayStar\Ipg\Facades\PayStarIpg;
    // Redirect to Gateway
    PayStarIpg::token('TOKEN')->payment();
    ```

-----------

#### How to generate <code>sign</code>
```php
<?php
use PayStar\Ipg\Facades\Encryption;

// The Encryption Facade has 3 methods

Encryption::sign($amount, $orderId, $callbackUrl); // Generate a sign with set algorithm in config file

Encryption::algos(); // Show list of hash Algorithms (hash_algos() method)
Encryption::hash($algo, $string, $key, $binary); // use hash_hmac() method
```
  
#### Built with :heart: for laravel developers.
