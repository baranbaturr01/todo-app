<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class MockTwoProvider extends ServiceProvider
{
    protected $url = 'http://run.mocky.io/v3/32d08d65-83b6-424f-9afb-519863b0ed09';

    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function register()
    {
        // Burada MockOneProvider sınıfını uygulama kapsayıcısına kaydedebiliriz
        $this->app->singleton(MockTwoProvider::class, function ($app) {
            return new self($app);
        });
    }

    public function boot()
    {
    }

    public function getTasks()
    {
        // mock-two API'sine istek yaparak görevleri getiriyoruz.
        $response = Http::get($this->url);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch tasks from ' . $this->url);
        }

        // Veriyi dönüyoruz.
        return $response->json();
    }
}
