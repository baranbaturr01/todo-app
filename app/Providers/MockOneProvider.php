<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class MockOneProvider extends ServiceProvider
{
    protected string $url = 'http://run.mocky.io/v3/3d2e8a4d-1a99-456a-b16e-5c288e8d2b83';

    public function __construct($app)
    {
        parent::__construct($app);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Burada MockOneProvider sınıfını uygulama kapsayıcısına kaydedebiliriz
        $this->app->singleton(MockOneProvider::class, function ($app) {
            return new self($app);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Fetch tasks from the mock-one API.
     *
     * @throws \Exception
     */
    public function getTasks(): array
    {
        // mock-one API'sine istek yaparak görevleri getiriyoruz.
        $response = Http::get($this->url);

        if ($response->failed()) {
            throw new \Exception('Failed to fetch tasks from ' . $this->url);
        }

        // Veriyi dönüyoruz.
        return $response->json();
    }
}
