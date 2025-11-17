<?php
require_once __DIR__ . '/BaseDao.php';

class AppointmentsDao extends BaseDao {

    public function __construct() {
        parent::__construct("appointments");
    }

    public function createAppointment($appointment) {
        return $this->insert($appointment); 
    }

    public function getAllAppointments() {
        return $this->getAll(); 
    }

    public function getAppointmentById($id) {
        return $this->getById($id); 
    }

    public function updateAppointment($id, $appointment) {
        $this->update($id, $appointment); 
        return $this->getById($id);
    }

    public function deleteAppointment($id) {
        return $this->delete($id); 
    }
}
?>
