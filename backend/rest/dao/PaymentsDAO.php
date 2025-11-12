<?php
require_once __DIR__ . '/BaseDao.php';

class PaymentsDao extends BaseDao {

    public function __construct() {
        parent::__construct("payments");
    }

    public function create_payment($payment) {
        return $this->insert('payments', $payment);
    }

    public function get_all_payments() {
        return $this->query("SELECT * FROM payments");
    }

    public function get_payment_by_id($id) {
        return $this->query_unique("SELECT * FROM payments WHERE id = :id", ['id' => $id]);
    }

    public function update_payment($id, $payment) {
        $this->update('payments', $id, $payment);
        return $this->get_payment_by_id($id);
    }

    public function delete_payment($id) {
        return $this->execute("DELETE FROM payments WHERE id = :id", ['id' => $id]);
    }
}
?>
