<?php
require_once 'Serializer.php';

class LoginUserSerializer extends Serializer
{
    public $model = User::class;

    private function validate_login($login) {
        if ($login == '') {
            $this->add_error('Login is required');
        } else {
            $user = $this->model::get(['login' => $login]);
            if (!$user) {
                $this->add_error('User with this login does not exist');
            }
        }
    }

    private function validate_password($password, $login) {
        if ($password == '') {
            $this->add_error('Password is required');
        } else {
            $user = $this->model::get(['login' => $login]);
            if ($user) {
                if (!$user->check_password($password)) {
                    $this->add_error('Password is incorrect');
                }
            }
        }
    }

    public function validate()
    {
        $this->validate_login($this->data['login']);
        $this->validate_password($this->data['password'], $this->data['login']);
    }

    protected function save_to_db() {
        $this->instance = $this->model::get(['login' => $this->data['login']]);
    }
}