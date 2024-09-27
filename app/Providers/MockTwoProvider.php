<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class MockTwoProvider extends ServiceProvider
{
    protected $url = 'http://run.mocky.io/v3/798f4d2d-3e9d-4517-983f-fff15cc9a5bb';

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
