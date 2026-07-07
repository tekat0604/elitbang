<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $setting = Setting::first();
        config()->set('id', $setting->id ?? null);
        config()->set('title_nav', $setting->title_nav ?? null);
        config()->set('unit', $setting->unit ?? null);
        config()->set('name_apps', $setting->name_apps ?? null);
        config()->set('deskripsi', $setting->deskripsi ?? null);
        config()->set('logo_page_login', $setting->logo_page_login ?? null);
        config()->set('logo_branding', $setting->logo_branding ?? null);
        config()->set('theme.primary_color', $setting->primary_color ?? '#0c5896');
        config()->set('theme.secondary_color', $setting->secondary_color ?? '#28c76f');
    }
}
