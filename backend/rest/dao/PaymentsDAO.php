<?php
require_once __DIR__ . '/BaseDao.php';

class PaymentsDao extends BaseDao {

    public function __construct() {
        parent::__construct("payments");
    }

    public function createPayment($payment) {
        return $this->insert($payment); 
    }

    public function getAllPayments() {
        return $this->getAll(); 
    }

    public function getPaymentById($id) {
        return $this->getById($id); 
    }

    public function updatePayment($id, $payment) {
        $this->update($id, $payment); 
        return $this->getById($id);
    }

    public function deletePayment($id) {
        return $this->delete($id); 
    }
}
?>
