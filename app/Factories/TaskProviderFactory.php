<?php

namespace App\Factories;

use App\Providers\MockOneProvider;
use App\Providers\MockTwoProvider;

class TaskProviderFactory
{
    /**
     * @throws \Exception
     */
    protected static array $providers = [
        'mock-one' => MockOneProvider::class,
        'mock-two' => MockTwoProvider::class,
        // Yeni providerlar buraya eklenebilir
    ];

    public static function create($provider)
    {
        if (!array_key_exists($provider, self::$providers)) {
            throw new \Exception("Unknown provider: {$provider}");
        }

        // İlgili sağlayıcı sınıfını yarat ve döndür
        return app(self::$providers[$provider]);
    }
}
