<?php

class Controller
{
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function checkAuthentication()
    {
        if (!$_SESSION['user']) {
            $_SESSION['user'] = [];
            header('Location: ' . APP_URL . '/auth');
            exit;
        }
    }
}
