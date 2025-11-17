<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/AppointmentsDao.php');

class AppointmentsService extends BaseService {
    public function __construct() {
        parent::__construct(new AppointmentsDao());
    }
    public function createAppointment($appointment) {
        return $this->dao->createAppointment($appointment);
    }

    public function getAllAppointments() {
        return $this->dao->getAllAppointments();
    }

    public function getAppointmentById($id) {
        return $this->dao->getAppointmentById($id);
    }

    public function updateAppointment($id, $appointment) {
        return $this->dao->updateAppointment($id, $appointment);
    }

    public function deleteAppointment($id) {
        return $this->dao->deleteAppointment($id);
    }
}
?>