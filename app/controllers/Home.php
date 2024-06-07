<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }

    public function index()
    {
        $data['products'] = $this->model('ProductModel')->findAll();

        $this->view('templates/header');
        $this->view('product/index', $data);
        $this->view('templates/footer');
    }
}
