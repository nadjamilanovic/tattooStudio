<?php
require_once __DIR__ . '/../repositories/paymentsRepository.php';

class PaymentsService {
    private $repository;

    public function __construct() {
        $this->repository = new PaymentsRepository();
    }

    public function getAllPayments() {
        return $this->repository->getAllPayments();
    }

    public function getPaymentById($id) {
        return $this->repository->getPaymentById($id);
    }

    public function addPayment($data) {
        return $this->repository->addPayment($data);
    }

    public function updatePayment($id, $data) {
        return $this->repository->updatePayment($id, $data);
    }

    public function deletePayment($id) {
        return $this->repository->deletePayment($id);
    }
}
?>
