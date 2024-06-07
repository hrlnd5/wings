<?php

class UserModel
{
    protected $table = 'login';

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($data)
    {
        $this->db->query("SELECT * FROM $this->table WHERE user = :user AND password = :password");
        $this->db->bind('user', $data['user']);
        $this->db->bind('password', $data['password']);

        return $this->db->first();
    }
}
