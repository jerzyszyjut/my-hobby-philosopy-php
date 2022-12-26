<?php
require_once 'Model.php';

class User extends Model
{
    public $login;
    public $email;
    public $password_hash;

    public function __construct($login, $email)
    {
        $this->login = $login;
        $this->email = $email;
    }

    protected function serialize(): array
    {
        $object = [
            'login' => $this->login,
            'email' => $this->email,
            'password_hash' => $this->password_hash
        ];
        return array_merge(parent::serialize(), $object);
    }

    static protected function deserialize($object): User
    {
        $instance = new static(
            $object['login'],
            $object['email']
        );
        $instance->password_hash = $object['password_hash'];
        $instance->id = (string)$object['_id'];
        return $instance;
    }

    public function check_password($password): bool
    {
        return password_verify($password, $this->password_hash);
    }

    public function set_password($password)
    {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }
}