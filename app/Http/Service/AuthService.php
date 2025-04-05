<?php

namespace App\Http\Service;

interface AuthService
{
    public function login();
    public function logout();
    public function register();
}
