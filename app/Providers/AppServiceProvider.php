<?php

namespace App\Providers;

use App\Model\Comment;
use App\Model\Post;
use App\Model\Setting;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Create config vars from settings table
        $this->createConfigVars();
        // Update the config vars
        $this->setConfigVars();
        Schema::defaultStringLength(191);
        Post::observe(PostObserver::class);
        //User::observe(UserObserver::class);
        Comment::observe(CommentObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    // Create config vars from settings table
    private function createConfigVars()
    {
        // Check DB connection and catch it
        try {
            // Get all settings from the database
            $settings = Cache::rememberForever('settings.active', function () {
                $settings = Setting::where('active', 1)->get();
                return $settings;
            });

            // Bind all settings to the Laravel config, so you can call them like
            if ($settings->count() > 0) {
                foreach ($settings as $key => $setting) {
                    if (!empty($setting->value)) {
                        Config::set('settings.' . $setting->key, $setting->value);
                    }
                }
            }
        } catch (\Exception $e) {
            Config::set('settings.error', true);
            Config::set('settings.app_logo', asset('blog/logo/logo.png'));
        }
    }

    // Update the config vars
    private function setConfigVars()
    {
        // App name
        Config::set('app.name', config('settings.app_name','Merlplus'));
        // reCAPTCHA
        Config::set('recaptcha.public_key', env('RECAPTCHA_PUBLIC_KEY', config('settings.recaptcha_public_key')));
        Config::set('recaptcha.private_key', env('RECAPTCHA_PRIVATE_KEY', config('settings.recaptcha_private_key')));
        // Mail
        Config::set('mail.driver', env('MAIL_DRIVER', config('settings.mail_driver')));
        Config::set('mail.host', env('MAIL_HOST', config('settings.mail_host')));
        Config::set('mail.port', env('MAIL_PORT', config('settings.mail_port')));
        Config::set('mail.encryption', env('MAIL_ENCRYPTION', config('settings.mail_encryption')));
        Config::set('mail.username', env('MAIL_USERNAME', config('settings.mail_username')));
        Config::set('mail.password', env('MAIL_PASSWORD', config('settings.mail_password')));
        Config::set('mail.from.address', env('MAIL_FROM_ADDRESS', config('settings.app_email_sender')));
        Config::set('mail.from.name', env('MAIL_FROM_NAME', config('settings.app_name')));
        // Mailgun
        Config::set('services.mailgun.domain', env('MAILGUN_DOMAIN', config('settings.mailgun_domain')));
        Config::set('services.mailgun.secret', env('MAILGUN_SECRET', config('settings.mailgun_secret')));
        // Mandrill
        Config::set('services.mandrill.secret', env('MANDRILL_SECRET', config('settings.mandrill_secret')));
        // Amazon SES
        Config::set('services.ses.key', env('SES_KEY', config('settings.ses_key')));
        Config::set('services.ses.secret', env('SES_SECRET', config('settings.ses_secret')));
        Config::set('services.ses.region', env('SES_REGION', config('settings.ses_region')));
        // Sparkpost
        //Config::set('services.sparkpost.secret', env('SPARKPOST_SECRET', config('settings.sparkpost_secret')));
        // Facebook
        Config::set('services.facebook.client_id', env('FACEBOOK_CLIENT_ID', config('settings.facebook_client_id')));
        Config::set('services.facebook.client_secret', env('FACEBOOK_CLIENT_SECRET', config('settings.facebook_client_secret')));
        // Google
        Config::set('services.google.client_id', env('GOOGLE_CLIENT_ID', config('settings.google_client_id')));
        Config::set('services.google.client_secret', env('GOOGLE_CLIENT_SECRET', config('settings.google_client_secret')));
        Config::set('services.googlemaps.key', env('GOOGLE_MAPS_API_KEY', config('settings.googlemaps_key')));
        Config::set('analytics.view_id', env('ANALYTICS_VIEW_ID', config('settings.google_page_view_id')));
        // Meta-tags
        Config::set('meta-tags.title', config('settings.app_slogan'));
        Config::set('meta-tags.open_graph.site_name', config('settings.app_name'));
        Config::set('meta-tags.twitter.creator', config('settings.twitter_username'));
        Config::set('meta-tags.twitter.site', config('settings.twitter_username'));

    }
}
