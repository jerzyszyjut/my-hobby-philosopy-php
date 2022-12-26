<?php
require_once 'Database.php';

abstract class Model
{
    public $id;

    protected function serialize()
    {
        $object = [
            '_id' => new MongoDB\BSON\ObjectId($this->id)
        ];
        return $object;
    }

    abstract static protected function deserialize($object);

    public function save()
    {
        if (isset($this->id)) {
            static::get_collection()->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($this->id)],
                ['$set' => $this->serialize()]
            );
        } else {
            $result = static::get_collection()->insertOne($this->serialize());
            $this->id = $result->getInsertedId();
        }
    }

    static public function get($query = [])
    {
        $object = static::get_collection()->findOne($query);
        if ($object) {
            return static::deserialize($object);
        } else {
            return null;
        }
    }

    static public function get_all($query = [])
    {
        $cursor = static::get_collection()->find($query);

        $objects = [];
        foreach ($cursor as $object) {
            array_push($objects, static::deserialize($object));
        }

        return $objects;
    }

    static public function get_page($page, $query = [])
    {
        $CONFIG = include('../config.php');
        $pagination_limit = $CONFIG['PAGINATION_LIMIT'];
        $cursor = static::get_collection()->find($query, [
            'limit' => $pagination_limit,
            'skip' => ($page - 1) * $pagination_limit
        ]);

        $objects = [];
        foreach ($cursor as $object) {
            array_push($objects, static::deserialize($object));
        }

        return $objects;
    }

    static private function get_collection()
    {
        $collection_name = strtolower(get_called_class()) . 's';
        return Database::connect()->$collection_name;
    }

    static public function delete_all($query = [])
    {
        static::get_collection()->deleteMany($query);
    }
}
