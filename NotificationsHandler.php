<?php

class NotificationsHandler
{
    static public function start()
    {
        if (!(isset($_SESSION['errors']))) {
            $_SESSION['errors'] = [];
            $_SESSION['info'] = [];
        }
    }

    static public function add_error($path, $error)
    {
        if (isset($_SESSION['errors'][$path])) {
            $_SESSION['errors'][$path][] = $error;
        } else {
            $_SESSION['errors'][$path] = [$error];
        }
    }

    static public function add_errors($path, $errors)
    {
        foreach ($errors as $error) {
            self::add_error($path, $error);
        }
    }

    static public function get_errors($path)
    {
        if (isset($_SESSION['errors'][$path])) {
            return $_SESSION['errors'][$path];
        } else {
            return [];
        }
    }

    static public function clear_errors($path)
    {
        if (isset($_SESSION['errors'][$path])) {
            unset($_SESSION['errors'][$path]);
        }
    }

    static public function add_info($path, $info)
    {
        if (isset($_SESSION['info'][$path])) {
            $_SESSION['info'][$path][] = $info;
        } else {
            $_SESSION['info'][$path] = [$info];
        }
    }

    static public function add_infos($path, $infos)
    {
        foreach ($infos as $info) {
            self::add_info($path, $info);
        }
    }

    static public function get_infos($path)
    {
        if (isset($_SESSION['info'][$path])) {
            return $_SESSION['info'][$path];
        } else {
            return [];
        }
    }

    static public function clear_infos($path)
    {
        if (isset($_SESSION['info'][$path])) {
            unset($_SESSION['info'][$path]);
        }
    }
}
