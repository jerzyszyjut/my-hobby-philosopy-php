<?php
require_once 'User.php';
require_once 'Serializer.php';

class UserSerializer extends Serializer
{
    public $model = User::class;

    private function validate_login($login)
    {
        if ($login == '') {
            $this->add_error('Login is required');
        } else {
            if (strlen($login) < 3) {
                $this->add_error('Login is too short (<3)');
            } else if (strlen($login) > 20) {
                $this->add_error('Login is too long (>20)');
            } else if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
                $this->add_error('Login can only contain letters and numbers');
            } else if ($this->model::get_all(['login' => $login])) {
                $this->add_error('Login is already taken');
            }
        }
    }

    private function validate_email($email) {
        if ($email == '') {
            $this->add_error('Email is required');
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->add_error('Email is invalid');
            } else if ($this->model::get_all(['email' => $email])) {
                $this->add_error('Email is already taken');
            }
        }
    }

    private function validate_password($password) {
        if ($password == '') {
            $this->add_error('Password is required');
        } else {
            if (strlen($password) < 6) {
                $this->add_error('Password is too short (<6)');
            } else if (strlen($password) > 20) {
                $this->add_error('Password is too long (>20)');
            }
        }
    }

    public function validate()
    {
        $this->validate_login($this->data['login']);
        $this->validate_email($this->data['email']);
        $this->validate_password($this->data['password']);
        if($this->data['password'] != $this->data['repassword']) {
            $this->add_error('Passwords do not match');
        }
    }

    protected function save_to_db()
    {
        $this->instance = new $this->model($this->data['login'], $this->data['email']);
        $this->instance->set_password($this->data['password']);
        $this->instance->save();
    }
}