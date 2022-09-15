<?php

namespace App\Services;

use App\Traits\RequestService;

use function config;

class AuthService
{
    use RequestService;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var string
     */
    protected $secret;

    public function __construct()
    {
        $this->baseUri = config('services.auth.base_uri');
        $this->secret = config('services.auth.secret');
    }

    /**
     * @return string
     */
    public function login($login) : string
    {
        return $this->request('post', "/api/login/{$login}");
    }

    /**
     * @param $register
     *
     * @return string
     */
    public function register($register) : string
    {
        return $this->request('post', "/api/register/{$register}");
    }
}
