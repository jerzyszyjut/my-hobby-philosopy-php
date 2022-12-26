<?php
require_once '../views/LayoutView.php';
require_once '../views/RedirectView.php';
require_once '../NotificationsHandler.php';
require_once '../serializers/RegisterUserSerializer.php';
require_once '../serializers/LoginUserSerializer.php';
require_once '../models/User.php';

class UserController
{
    public function register_form(): LayoutView
    {
        return new LayoutView('register_user');
    }

    public function register_user(): RedirectView
    {
        $fields = ['login', 'email', 'password', 'repassword'];
        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                $_POST[$field] = '';
            }
        }

        $data = [
            'login' => $_POST['login'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'repassword' => $_POST['repassword']
        ];

        $serializer = new RegisterUserSerializer($data);

        if ($serializer->is_valid()) {
            $serializer->save();
            $_SESSION['user_id'] = $serializer->instance->id;
            return new RedirectView('/login');
        } else {
            $errors = $serializer->get_errors();
            NotificationsHandler::add_errors('/register', $errors);
            return new RedirectView('/register');
        }
    }

    public function login_form(): LayoutView
    {
        return new LayoutView('login_user');
    }

    public function login_user(): RedirectView
    {
        $fields = ['login', 'password'];
        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                $_POST[$field] = '';
            }
        }

        $data = [
            'login' => $_POST['login'],
            'password' => $_POST['password']
        ];

        $serializer = new LoginUserSerializer($data);

        if ($serializer->is_valid()) {
            $serializer->save();
            $_SESSION['user_id'] = $serializer->instance->id;
            NotificationsHandler::add_info('/', 'Logged in successfully');
            return new RedirectView('/');
        } else {
            $errors = $serializer->get_errors();
            NotificationsHandler::add_errors('/login', $errors);
            return new RedirectView('/login');
        }
    }

    public function logout(): RedirectView
    {
        unset($_SESSION['user_id']);
        NotificationsHandler::add_info('/', 'Logged out');
        return new RedirectView('/');
    }
}