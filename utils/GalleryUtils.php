<?php

class GalleryUtils
{
    static public function get_images($page, $user_id = null)
    {
        $query = [];

        if (isset($_SESSION['user_id'])) {
            $user = User::get(['_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);
            if($user) {
                $query['$or'] = [
                    ['visibility' => 'public'],
                    ['author' => $user->login]
                ];
            } else {
                $query['visibility'] = 'public';
            }
        } else {
            $query['visibility'] = 'public';
        }

        $images = Image::get_page($page, $query);
        $next_page_exists = Image::get_page($page + 1) != null;

        return ['images' => $images, 'next_page_exists' => $next_page_exists];
    }
}