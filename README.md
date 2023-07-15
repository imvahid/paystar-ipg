<p align="center"><a href="https://paystar.ir" target="_blank"><img src="https://paystar.ir/homepage/image/logo.svg" width="170" alt="PayStar Logo"></a></p>

<p align="center">This is a Laravel package for PayStar payment gateway.</p>

<div align="center">
    
[![Latest Version on Packagist](https://img.shields.io/packagist/v/paystar/laravel-ipg.svg?style=flat-square)](https://packagist.org/packages/paystar/laravel-ipg)
[![GitHub issues](https://img.shields.io/github/issues/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/issues)
[![GitHub stars](https://img.shields.io/github/stars/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/network)
[![Total Downloads](https://img.shields.io/packagist/dt/paystar/laravel-ipg.svg?style=flat-square)](https://packagist.org/packages/paystar/laravel-ipg)
[![GitHub license](https://img.shields.io/github/license/imvahid/paystar-ipg?style=flat-square)](https://github.com/imvahid/paystar-ipg/blob/master/LICENSE)
    
</div>

--------------------------

### :arrow_down: Installation guide

#### Install package
```bash
composer require paystar/laravel-ipg
```
#### Publish configs

```bash
php artisan vendor:publish --tag=paystar-ipg
```

### :book: List of available methods
- <code>create()</code>: return a token
- <code>payment()</code>: auto redirect to gateway
- <code>verify()</code>: verify transaction

### :heavy_check_mark: How to use exists methods and options

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

### #️⃣ How to generate <code>sign</code>
```php
<?php
use PayStar\Ipg\Facades\Encryption;

// The Encryption Facade has 3 methods

Encryption::sign($amount, $orderId, $callbackUrl); // Generate a sign with set algorithm in config file

Encryption::algos(); // Show list of hash Algorithms (hash_algos() method)
Encryption::hash($algo, $string, $key, $binary); // use hash_hmac() method
```
  
--------------------

### :man_technologist: Author

- [Github](https://github.com/imvahid)
- [linkedin](https://www.linkedin.com/in/imvahid)
