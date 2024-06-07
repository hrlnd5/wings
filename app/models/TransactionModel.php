<?php

class TransactionModel
{
    protected $tableHeader = 'transaction_header';
    protected $tableDetail = 'transaction_detail';
    protected $tableProduct = 'product';

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getLastDocumentNumber()
    {
        $this->db->query("SELECT document_number FROM $this->tableHeader ORDER BY document_number DESC LIMIT 1");
        return $this->db->first()['document_number'] ?? '000';
    }

    public function findAllTransactionHeader()
    {
        $this->db->query("SELECT * FROM $this->tableHeader ORDER BY document_number");
        return $this->db->get();
    }

    public function findTransactionDetailByDocumentNumber($documentNumber)
    {
        $this->db->query(
            "SELECT p.product_name, td.quantity FROM $this->tableDetail AS td
             LEFT JOIN $this->tableProduct AS p
             ON td.product_code = p.product_code
             WHERE document_number = :documentNumber"
        );
        $this->db->bind('documentNumber', $documentNumber);
        return $this->db->get();
    }

    public function saveTransactionHeader($data)
    {
        $query = "INSERT INTO $this->tableHeader VALUES (:documentCode, :documentNumber, :user, :total, current_timestamp())";
        $this->db->query($query);
        $this->db->bind('documentCode', $data['document_code']);
        $this->db->bind('documentNumber', $data['document_number']);
        $this->db->bind('user', $data['user']);
        $this->db->bind('total', $data['total']);
        $this->db->execute();

        return $this->db->rowCountAffected();
    }

    public function saveTransactionDetail($data)
    {
        $query = "INSERT INTO $this->tableDetail VALUES (:documentCode, :documentNumber, :productCode, :price, :quantity, :unit, :subtotal, :currency)";
        $this->db->query($query);
        $this->db->bind('documentCode', $data['document_code']);
        $this->db->bind('documentNumber', $data['document_number']);
        $this->db->bind('productCode', $data['product_code']);
        $this->db->bind('price', $data['price']);
        $this->db->bind('quantity', $data['quantity']);
        $this->db->bind('unit', $data['unit']);
        $this->db->bind('subtotal', $data['subtotal']);
        $this->db->bind('currency', $data['currency']);
        $this->db->execute();

        return $this->db->rowCountAffected();
    }
}
