Stripe for Laravel 4
==============

Integrates the Stripe PHP library with Laravel 4 via a ServiceProvider, config, and Blade extensions.


### Installation

Include laravel-stripe as a dependency in composer.json:

~~~
"abodeo/laravel-stripe": "dev-master"
~~~

Run `composer install` to download the dependency.

Add the ServiceProvider to your provider array within `app/config/app.php`:

~~~
'providers' => array(

    'Abodeo\LaravelStripe\LaravelStripeServiceProvider'

)
~~~

Finally, publish the configuration files via `php artisan config:publish abodeo/laravel-stripe`.


### Configuration

It is advisable to keep all of your sensitive configuration out of your configuration files. Instead, utilize Laravel's "dot files" to keep them out of source control and making them easily overridable on dev environments.

If you have not setup a "dot file", read Laravel's "[Protecting Sensitive Configuration](http://laravel.com/docs/configuration#protecting-sensitive-configuration) for detailed setup instructions. To quickly get up an running, simply create a `.env.php` file in the same directory as you apps `composer.json` file. Then add your Stripe API credentials to it.

~~~
<?php
return array(
  'stripe' => array(
    'api_key' => 'my-api-key',
    'publishable_key' => 'my-pub-key'
  )
);
~~~

If you insist on keeping your API credentials in your config, you can set your API Key and Publishable Key in `app/config/packages/abodeo/laravel-stripe/stripe.php`:

~~~
<?php
return array(
  'api_key' => 'my-api-key',
  'publishable_key' => 'my-pub-key'
);
~~~

### Usage

You may use the [Stripe PHP Library](https://stripe.com/docs/checkout/guides/php) as normal within your application. The Stripe API will automatically be configured with your API Key, so you do not need to set it yourself.

In your Blade views, you may output your Stripe Publishable Key using the `@stripeKey` Blade extension:

~~~
<script src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
          data-key="@stripeKey"
          data-amount="5000" data-description="One year's subscription"></script>
~~~

