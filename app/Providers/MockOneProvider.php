<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class MockOneProvider extends ServiceProvider
{
    protected string $url = 'http://run.mocky.io/v3/37a45282-2c37-4114-9669-4e65e600f739';

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
