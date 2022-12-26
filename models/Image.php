<?php
require_once 'Model.php';

class Image extends Model {
    public $title;
    public $author;
    public $path;
    public $thumbnail_path;
    public $watermark_path;
    public $visibility;

    public function __construct($title, $author, $path, $thumbnail_path, $watermark_path, $visibility) {
        $this->title = $title;
        $this->author = $author;
        $this->path = $path;
        $this->thumbnail_path = $thumbnail_path;
        $this->watermark_path = $watermark_path;
        $this->visibility = $visibility;
    }

    protected function serialize(): array
    {
        $object = [
            'title' => $this->title,
            'author' => $this->author,
            'path' => $this->path,
            'thumbnail_path' => $this->thumbnail_path,
            'watermark_path' => $this->watermark_path,
            'visibility' => $this->visibility
        ];
        return array_merge(parent::serialize(), $object);
    }

    static protected function deserialize($object): Image
    {
        $instance = new static(
            $object['title'],
            $object['author'],
            $object['path'],
            $object['thumbnail_path'],
            $object['watermark_path'],
            $object['visibility']
        );
        $instance->id = (string)$object['_id'];
        return $instance;
    }
}
