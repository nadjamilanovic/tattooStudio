<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/PaymentsDao.php');

class PaymentsService extends BaseService {
    public function __construct() {
        parent::__construct(new PaymentsDao());
    }

    public function create_payment($payment) {
        return $this->dao->insert('payments', $payment);
    }

    public function get_all_payments() {
        return $this->dao->query("SELECT * FROM payments");
    }

    public function get_payment_by_id($id) {
        return $this->dao->query_unique("SELECT * FROM payments WHERE id = :id", ['id' => $id]);
    }

    public function update_payment($id, $payment) {
        $this->update('payments', $id, $payment);
        return $this->dao->get_payment_by_id($id);
    }

    public function delete_payment($id) {
        return $this->dao->execute("DELETE FROM payments WHERE id = :id", ['id' => $id]);
    }
}
?>