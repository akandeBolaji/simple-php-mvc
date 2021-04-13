<?php

namespace app\models;


use akandebolaji\phpmvc\DbModel;
use akandebolaji\phpmvc\UserModel;
use Carbon\Carbon;

class User extends UserModel
{ 
    public int $id = 0;
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $passwordConfirm = '';
    public string $api_token = '';
    public string $api_token_expire_at = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'api_token', 'api_token_expire_at'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'passwordConfirm' => 'Password Confirm'
        ];
    }

    public function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [
                self::RULE_UNIQUE, 'class' => self::class
            ]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'passwordConfirm' => [[self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return parent::save();
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public static function rollApiKey()
    {
        do {
            $token = bin2hex(random_bytes(32));
            $this->api_token = $token;
            $date = Carbon::now()->addDays(5);
            $this->api_token_expire_at = $date;
        } while( self::findOne(['api_token' => $token]) );
        $this->saveApiToken($this->api_token, $this->api_token_expire_at, )

        return $token;
    }
}