<?php
require_once __DIR__ . '/BaseDao.php';

class AppointmentsDao extends BaseDao {

    public function __construct() {
        parent::__construct("appointments");
    }

    public function create_appointment($appointment) {
        return $this->insert('appointments', $appointment);
    }

    public function get_all_appointments() {
        return $this->query("SELECT * FROM appointments");
    }

    public function get_appointment_by_id($id) {
        return $this->query_unique("SELECT * FROM appointments WHERE id = :id", ['id' => $id]);
    }

    public function update_appointment($id, $appointment) {
        $this->update('appointments', $id, $appointment);
        return $this->get_appointment_by_id($id);
    }

    public function delete_appointment($id) {
        return $this->execute("DELETE FROM appointments WHERE id = :id", ['id' => $id]);
    }
}
?>
