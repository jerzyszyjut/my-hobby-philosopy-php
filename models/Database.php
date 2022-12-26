<?php
class Database {
    private static $db = null;

    public static function connect() {
        $CONFIG = include('../config.php');
        if (!isset(static::$db)) {
            static::$db = new MongoDB\Client(
                $CONFIG['MONGODB_URI'],
                [
                    'username' => $CONFIG['MONGODB_USERNAME'],
                    'password' => $CONFIG['MONGODB_PASSWORD']
                ]
            );
        }

        return static::$db->wai;
    }
}
