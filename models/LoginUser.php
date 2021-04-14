<?php

namespace app\models;


use akandebolaji\phpmvc\Application;
use akandebolaji\phpmvc\Model;
use Carbon\Carbon;

class LoginUser extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function labels()
    {
        return [
            'email' => 'Your Email address',
            'password' => 'Password'
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user || !password_verify($this->password, $user->password)) {
            $this->addError('password', 'Incorrect email or password');
            return false;
        }

        $user->rollApiKey();

        return $user;
    }
} 