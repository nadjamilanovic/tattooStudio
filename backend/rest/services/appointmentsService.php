<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/AppointmentsDao.php');

class AppointmentsService extends BaseService {
    public function __construct() {
        parent::__construct(new AppointmentsDao());
    }
    public function create_appointment($appointment) {
        return $this->dao->insert('appointments', $appointment);
    }

    public function get_all_appointments() {
        return $this->dao->query("SELECT * FROM appointments");
    }

    public function get_appointment_by_id($id) {
        return $this->dao->query_unique("SELECT * FROM appointments WHERE id = :id", ['id' => $id]);
    }

    public function update_appointment($id, $appointment) {
        $this->update('appointments', $id, $appointment);
        return $this->dao->get_appointment_by_id($id);
    }

    public function delete_appointment($id) {
        return $this->dao->execute("DELETE FROM appointments WHERE id = :id", ['id' => $id]);
    }
}
?>