<?php
require_once 'Serializer.php';
require_once 'Image.php';
require_once '../utils/ImageTransformer.php';

class ImageSerializer extends Serializer
{
    public $model = Image::class;

    private function validate_format($format): bool
    {
        $valid_formats = ['jpg', 'png', 'jpeg'];
        if(!(in_array($format, $valid_formats))) {
            $this->add_error( 'Invalid format, only jpg and png are allowed');
            return false;
        }
        return true;
    }

    private function validate_image($image): bool
    {
        $file_size = $image['size'];
        if ($file_size > 1024 * 1024) {
            $this->add_error('Image is too large, max size is 1MB');
            return false;
        }

        $file_path = $image['tmp_name'];
        $format = explode('/', mime_content_type($file_path))[1];
        if (!$this->validate_format($format)) {
            return false;
        }
        return true;
    }

    protected function validate_title($title): bool
    {
        if (strlen($title) < 3) {
            $this->add_error('Title must be at least 3 characters long');
            return false;
        } else if (strlen($title) > 20) {
            $this->add_error('Title must be at most 20 characters long');
            return false;
        }
        return true;
    }

    protected function validate_author($author): bool
    {
        if (strlen($author) < 3) {
            $this->add_error('Author must be at least 3 characters long');
            return false;
        } else if (strlen($author) > 20) {
            $this->add_error('Author must be at most 20 characters long');
            return false;
        }
        return true;
    }

    protected function validate_visibility($visibility): bool
    {
        if (!in_array($visibility, ['public', 'private'])) {
            $this->add_error('Visibility must be either public or private');
            return false;
        }
        return true;
    }

    protected function validate_watermark($watermark): bool
    {
        if (strlen($watermark) === 0) {
            $this->add_error('Watermark must be at least 1 character long');
            return false;
        }
        return true;
    }

    protected function validate()
    {
        $this->validate_image($this->data['image']);
        $this->validate_title($this->data['title']);
        $this->validate_author($this->data['author']);
        $this->validate_visibility($this->data['visibility']);
        $this->validate_watermark($this->data['watermark']);
    }

    protected function save_to_db()
    {
        $image_uploaddir = getcwd() . '/images/';
        $thumbnail_uploaddir = getcwd() . '/images/thumbnails/';
        $watermark_uploaddir = getcwd() . '/images/watermarks/';
        $this->data['path'] = $image_uploaddir . $this->data['image']['name'];
        $this->instance = new Image(
            $this->data['title'],
            $this->data['author'],
            $this->data['path'],
            $this->data['path'],
            $this->data['path'],
            $this->data['visibility']
        );
        $this->instance->save();

        $file_path = $this->data['image']['tmp_name'];
        $format = explode('/', mime_content_type($file_path))[1];
        $file_name = $this->instance->id . '.' . $format;
        $destination = $image_uploaddir . $file_name;
        ImageTransformer::generate_thumbnail($file_path, $thumbnail_uploaddir . $file_name, $format);
        ImageTransformer::generate_watermark($file_path, $watermark_uploaddir . $file_name, $this->data['watermark'], $format);
        move_uploaded_file($file_path, $destination);

        $this->instance->path = '/images/' . $file_name;
        $this->instance->thumbnail_path = '/images/thumbnails/' . $file_name;
        $this->instance->watermark_path = '/images/watermarks/' . $file_name;
        $this->instance->save();
    }
}