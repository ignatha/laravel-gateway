<?php
namespace App\Guard;

use App\Models\User;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWT;

class JWTGuard implements Guard
{
    use GuardHelpers;
    /**
     * @var JWT $jwt
     */
    protected JWT $jwt;
    /**
     * @var Request $request
     */
    protected Request $request;
    /**
     * JWTGuard constructor.
     * @param JWT $jwt
     * @param Request $request
     */
    public function __construct(JWT $jwt, Request $request) {
        $this->jwt = $jwt;
        $this->request = $request;
    }
    public function user() {
        if (! is_null($this->user)) {
            return $this->user;
        }
        if ($this->jwt->setRequest($this->request)->getToken() && $this->jwt->check()) {
            $id = $this->jwt->payload()->get('sub');
            $this->user = new User();
            $this->user->id = $id;
            $this->user->name = $this->jwt->payload()->get('name');
            $this->user->email = $this->jwt->payload()->get('email');
            return $this->user;
        }
        return null;
    }
    public function validate(array $credentials = []) {
    }
}
