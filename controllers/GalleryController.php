<?php
require_once '../views/LayoutView.php';
require_once '../views/RedirectView.php';
require_once '../serializers/ImageSerializer.php';
require_once '../models/Image.php';
require_once '../models/User.php';
require_once '../NotificationsHandler.php';
require_once '../utils/GalleryUtils.php';

class GalleryController
{
    public function index(): LayoutView
    {
        $page = 1;
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        $favourites = [];
        if (isset($_SESSION['favourites'])) {
            $favourites = $_SESSION['favourites'];
        }

        $user_id = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        }

        $data = GalleryUtils::get_images($page, $user_id);

        return new LayoutView("gallery", ['images' => $data['images'], 'page' => $page, 'favourites' => $favourites, 'next_page_exists' => $data['next_page_exists']]);
    }

    public function upload_form(): LayoutView
    {
        $username = '';
        if (isset($_SESSION['user_id'])) {
            $user = User::get(['_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);
            $username = $user->login;
        }
        return new LayoutView("gallery_upload_image", ['username' => $username]);
    }

    public function upload(): RedirectView
    {
        if (isset($_FILES['image'])) {
            $fields = ['title', 'author', 'watermark', 'visibility'];
            foreach ($fields as $field) {
                if (!isset($_POST[$field])) {
                    $_POST[$field] = '';
                }
            }

            if (!isset($_SESSION['user_id'])) {
                $_POST['visibility'] = 'public';
            }

            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'image' => $_FILES['image'],
                'watermark' => $_POST['watermark'],
                'visibility' => $_POST['visibility'],
            ];

            $serializer = new ImageSerializer($data);

            if ($serializer->is_valid()) {
                $serializer->save();
                return new RedirectView('/gallery');
            } else {
                $errors = $serializer->get_errors();
                NotificationsHandler::add_errors('/gallery/add', $errors);
                return new RedirectView('/gallery/add');
            }
        } else {
            NotificationsHandler::add_error('/gallery/add', 'No image was uploaded');
        }
        return new RedirectView('/gallery/add');
    }

    public function view_image(): LayoutView
    {
        $image = Image::get(['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]);
        if ($image) {
            return new LayoutView("single_image_view", ['image' => $image]);
        } else {
            NotificationsHandler::add_error('/gallery', 'Image not found');
            return new RedirectView('/gallery');
        }
    }

    public function add_to_favourite(): RedirectView
    {
        if (!isset($_POST['favourite'])) {
            $_POST['favourite'] = [];
        }

        if (!isset($_SESSION['favourites'])) {
            $_SESSION['favourites'] = [];
        }

        foreach ($_POST['favourite'] as $image_id) {
            $image = Image::get(['_id' => new MongoDB\BSON\ObjectId($image_id)]);
            if ($image) {
                $_SESSION['favourites'][] = $image_id;
            }
        }

        return new RedirectView('/gallery');
    }

    public function remove_from_favourite(): RedirectView
    {
        if (!isset($_POST['favourite'])) {
            $_POST['favourite'] = [];
        }

        if (!isset($_SESSION['favourites'])) {
            $_SESSION['favourites'] = [];
        }

        foreach ($_POST['favourite'] as $image_id) {
            unset($_SESSION['favourites'][array_search($image_id, $_SESSION['favourites'])]);
        }

        return new RedirectView('/gallery/favourites');
    }

    public function favourites(): LayoutView
    {
        $favourites = [];
        if (isset($_SESSION['favourites'])) {
            $favourites = $_SESSION['favourites'];
        }

        $images = [];
        foreach ($favourites as $image_id) {
            $image = Image::get(['_id' => new MongoDB\BSON\ObjectId($image_id)]);
            if ($image) {
                $images[] = $image;
            }
        }
        if (isset($_SESSION['favourites'])) {
            $favourites = $_SESSION['favourites'];
        }

        return new LayoutView("gallery_favourites", ['images' => $images, 'favourites' => $favourites]);
    }
}