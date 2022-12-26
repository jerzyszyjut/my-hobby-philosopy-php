<?php

class LayoutView
{
    protected $template_name;
    protected $data;

    public function __construct($template_name, $data = null)
    {
        $this->template_name = $template_name;
        $this->data = $data;
    }

    public function render()
    {
        $content = "{$this->template_name}.php";
        $infos = NotificationsHandler::get_infos($_SERVER['REQUEST_URI']);
        NotificationsHandler::clear_infos($_SERVER['REQUEST_URI']);
        $errors = NotificationsHandler::get_errors($_SERVER['REQUEST_URI']);
        NotificationsHandler::clear_errors($_SERVER['REQUEST_URI']);
        if (isset($this->data)) {
            extract($this->data);
        }
        include '../layouts/layout.php';
    }
}