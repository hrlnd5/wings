<?php

class Transaction extends Controller
{
    public function __construct()
    {
        $this->checkAuthentication();
    }

    public function index()
    {
        $transactions = $this->model('TransactionModel')->findAllTransactionHeader();

        for ($i = 0; $i < count($transactions); $i++) {
            $date = new DateTime($transactions[$i]['date']);
            $day = $date->format('j');
            $month = Helpers::getIndonesianMonth($date->format('F'));
            $year = $date->format('Y');

            $formattedDate = "$day $month $year";
            $transactions[$i]['date'] = $formattedDate;
            $transactions[$i]['total'] = 'Rp ' . number_format((float)$transactions[$i]['total'], 2, ',', '.');;
            $transactions[$i]['detail'] = $this->model('TransactionModel')->findTransactionDetailByDocumentNumber($transactions[$i]['document_number']);
        }

        $data['transactions'] = $transactions;

        $this->view('templates/header');
        $this->view('product/report', $data);
        $this->view('templates/footer');
    }

    public function checkoutConfirmation()
    {
        if (empty($_POST['product_codes'])) {
            Flasher::setFlash('error', 'Transaction failed', 'You have to choose 1 product minimum');
            header('Location: ' . APP_URL . '/product/checkout');
            exit;
        }

        $_POST['document_code'] = 'TRX';

        $lastDocumentNumber = $this->model('TransactionModel')->getLastDocumentNumber();

        $_POST['document_number'] = str_pad($lastDocumentNumber + 1, 3, "0", STR_PAD_LEFT);

        $_POST['user'] = $_SESSION['user']['user'];

        if ($this->model('TransactionModel')->saveTransactionHeader($_POST) > 0) {
            for ($i = 0; $i < count($_POST['product_codes']); $i++) {
                $_POST['product_code'] = $_POST['product_codes'][$i];
                $_POST['price'] = $_POST['prices'][$i];
                $_POST['quantity'] = $_POST['quantities'][$i];
                $_POST['unit'] = $_POST['units'][$i];
                $_POST['subtotal'] = $_POST['subtotals'][$i];
                $_POST['currency'] = $_POST['currencies'][$i];
                if ($this->model('TransactionModel')->saveTransactionDetail($_POST) == 0) {
                    Flasher::setFlash('error', 'Transaction failed', 'Something is wrong when save transaction');
                    header('Location: ' . APP_URL . '/product/checkout');
                    exit;
                }
            }

            $_SESSION['tempOrder' . $_SESSION['user']['user']] = [];
            Flasher::setFlash('success', 'Transaction success', 'Data successfully saved');
            header('Location: ' . APP_URL);
            exit;
        } else {
            Flasher::setFlash('error', 'Transaction failed', 'Something is wrong when save transaction');
            header('Location: ' . APP_URL . '/product/checkout');
            exit;
        }
    }
}
