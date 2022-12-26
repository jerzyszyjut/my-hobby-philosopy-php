<?php
class RedirectView {
    private $path;

    public function __construct($path) {
        $this->path = $path;
    }

    public function render() {
        header("Location: {$this->path}");
    }
}
