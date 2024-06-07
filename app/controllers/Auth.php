<?php

class Auth extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            header('Location: ' . APP_URL);
            exit;
        }
        $this->view('auth/login');
    }

    public function login()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']) {
            header('Location: ' . APP_URL);
            exit;
        }
        if (empty(trim($_POST['user']))) {
            Flasher::setFlash('error', 'Login Failed', 'Username is required');
            header('Location: ' . APP_URL . '/auth');
            exit;
        }
        if (empty(trim($_POST['password']))) {
            Flasher::setFlash('error', 'Login Failed', 'Password is required');
            header('Location: ' . APP_URL . '/auth');
            exit;
        }

        $user = $this->model('UserModel')->login($_POST);

        if ($user) {
            $_SESSION['user'] = $user;
            Flasher::setFlash('success', 'Login Succed', '');
            header('Location: ' . APP_URL);
            exit;
        } else {
            Flasher::setFlash('error', 'Login Failed', 'Username or password is wrong');
            header('Location: ' . APP_URL . '/auth');
            exit;
        }
    }

    public function logout()
    {
        $_SESSION['user'] = [];
        header('Location: ' . APP_URL . '/auth');
    }
}
