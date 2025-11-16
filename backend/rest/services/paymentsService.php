<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/PaymentsDao.php');

class PaymentsService extends BaseService {
    public function __construct() {
        parent::__construct(new PaymentsDao());
    }

    public function createPayment($payment) {
        return $this->dao->createPayment($payment);
    }

    public function getAllPayments() {
        return $this->dao->getAllPayments();
    }

    public function getPaymentById($id) {
        return $this->dao->getPaymentById($id);
    }

    public function updatePayment($id, $payment) {
        return $this->dao->updatePayment($id, $payment);
    }

    public function deletePayment($id) {
        return $this->dao->deletePayment($id);
    }
}
?>