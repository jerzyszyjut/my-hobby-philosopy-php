<?php
require_once '../views/LayoutView.php';

class BasicWebsiteController {
    public function index(): LayoutView
    {
        return new LayoutView("index_page");
    }
    public function quotes(): LayoutView
    {
        return new LayoutView("quotes");
    }
    public function settings(): LayoutView
    {
        return new LayoutView("settings");
    }
    public function sources(): LayoutView
    {
        return new LayoutView("sources");
    }
    public function presocratics(): LayoutView
    {
        return new LayoutView("presocratics");
    }
    public function spa_philosophers(): LayoutView
    {
        return new LayoutView("spa_philosophers");
    }
    public function remaining_philosophers(): LayoutView
    {
        return new LayoutView("remaining_philosophers");
    }
}