<?php
class Request
{
    // public $post;
    // public $session;
    // public $cookie;
    public $files;

    public function __construct()
    {
        // $this->get = $get;
        // $this->post = $post;
        // $this->session = $session;
        // $this->cookie = $cookie;
        $this->files = $_FILES;
    }
}
