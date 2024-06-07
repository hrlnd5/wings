<?php

class ProductModel
{
    protected $table = 'product';

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findAll()
    {
        $this->db->query("SELECT * FROM $this->table ORDER BY discount DESC");

        return $this->db->get();
    }

    public function findByProductCode($productCode)
    {
        $this->db->query("SELECT * FROM $this->table WHERE product_code = :productCode");
        $this->db->bind('productCode', $productCode);
        return $this->db->first();
    }

    public function findAllByProductCode($productCode)
    {
        $this->db->query("SELECT * FROM $this->table WHERE product_code IN ('$productCode')");
        return $this->db->get();
    }
}
