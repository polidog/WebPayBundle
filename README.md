# WebPayBundle

A Symfony Bundle for including [webpay-php](https://github.com/webpay/webpay-php)

## Requirements
PHP 5.4+

## Installation

```
$ composer require polidog/web-pay-bundl
```

and adding an instance of `Polidog\WepPayBundle\PolidogWebPayBundle` to your application's kernel.

```
$ vim app/AppKernel.php

...

    public function registerBundles()
    {
        $bundles = [
            // ...
            new Polidog\WebPayBundle\PolidogWebPayBundle(),
        ];
        // ...


    }
```

and parameter settings.

```
polidog_web_pay:
    public_api_key: "your pubic api key"
    secret_api_key: "your secret api key"
```


## Usage

basic api call for controller.

```
<?php

class DefaultController extends Controller
{
    /**
     * @Route("/api/test", name="homepage")
     */
    public function indexAction()
    {
        // ...
        $charges = $this->get('polidog_web_pay.web_pay_api')->charge->all(['count' => 1]);
        // ...
    }
}

```

api document [WebPay docuemnt](https://webpay.jp/docs/introduction)


## License

MIT