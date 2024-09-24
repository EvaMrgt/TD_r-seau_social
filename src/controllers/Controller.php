<?php
abstract class Controller
{
    abstract public function index();
    protected function render($view, $data = [])
    {
        extract($data);
    }
}
