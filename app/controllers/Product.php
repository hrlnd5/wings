<?php

class Product extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }

    public function detail($productCode)
    {
        $data['product'] = $this->model('ProductModel')->findByProductCode($productCode);
        $this->view('templates/header');
        $this->view('product/detail', $data);
        $this->view('templates/footer');
    }

    public function checkout()
    {
        $tempOrder = $_SESSION['tempOrder' . $_SESSION['user']['user']];
        if (!isset($tempOrder) || empty($tempOrder)) {
            Flasher::setFlash('error', 'Checkout Failed', 'You have to choose product first');
            header('Location: ' . APP_URL);
            exit;
        }
        $stringTempOrder = implode("','", $tempOrder);
        $data['products'] = $this->model('ProductModel')->findAllByProductCode($stringTempOrder);
        $this->view('templates/header');
        $this->view('product/checkout', $data);
        $this->view('templates/footer');
    }

    public function addProductToTemporaryOrder($code)
    {
        $user = $_SESSION['user']['user'];

        if (!isset($_SESSION['tempOrder' . $user])) {
            $_SESSION['tempOrder' . $user] = [];
        }

        if (!in_array($code, $_SESSION['tempOrder' . $user])) {
            $_SESSION['tempOrder' . $user][] = $code;
        }

        echo json_encode($_SESSION['tempOrder' . $user]);
    }

    public function removeProductFromTemporaryOrder($code)
    {
        $user = $_SESSION['user']['user'];

        $key = array_search($code, $_SESSION['tempOrder' . $user]);

        if ($key !== false) {
            unset($_SESSION['tempOrder' . $user][$key]);
        }

        echo json_encode($_SESSION['tempOrder' . $user]);
    }
}
