<?php

abstract class Serializer
{
    private $is_valid = false;
    private $errors = [];
    public $instance;
    protected $data;
    protected $model;

    public function __construct($data)
    {
        $this->data = $data;
    }

    abstract protected function validate();

    public function is_valid(): bool
    {
        $this->validate();

        if($this->get_errors() == []) {
            $this->set_valid(true);
        }
        return $this->is_valid;
    }

    public function get_errors(): array
    {
        return $this->errors;
    }

    protected function add_error($message)
    {
        $this->errors[] = $message;
    }

    protected function clear_errors()
    {
        $this->errors = [];
    }

    protected function set_valid($is_valid)
    {
        $this->is_valid = $is_valid;
    }

    abstract protected function save_to_db();

    public function save()
    {
        if ($this->is_valid()) {
            $this->save_to_db();
        }
    }

    public function serialize()
    {
        return $this->instance->serialize();
    }

    public function deserialize($object)
    {
        return $this->instance->deserialize($object);
    }
}