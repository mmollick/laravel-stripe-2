<?php namespace Abodeo\LaravelStripe;

use Illuminate\Support\ServiceProvider;

use \Stripe;

class LaravelStripeServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('abodeo/laravel-stripe');

        /*
         * Load Stripe configuration
         *
         * API keys should be utilizing Laravel's "dot files" to keep them out of source
         * control and making them easily overridable on dev environments
         *
         * Read more: http://laravel.com/docs/configuration#environment-configuration
         */
        $api_key = isset($_ENV['stripe.api_key']) ? $_ENV['stripe.api_key'] : $this->app['config']->get('laravel-stripe::stripe.api_key');
        Stripe::setApiKey($api_key);

        $publishableKey = isset($_ENV['stripe.publishable_key']) ? $_ENV['stripe.publishable_key'] : $this->app['config']->get('laravel-stripe::stripe.publishable_key');

        /*
         * Register blade compiler for the Stripe publishable key.
         */
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();
        $blade->extend(function($value, $compiler) use($publishableKey)
            {
                $matcher = "/(?<!\w)(\s*)@stripeKey/";

                return preg_replace($matcher, $publishableKey, $value);
            });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
