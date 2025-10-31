<?php
require_once __DIR__ . '/../repositories/appointmentsRepository.php';

class AppointmentsService {
    private $repository;

    public function __construct() {
        $this->repository = new AppointmentsRepository();
    }

    public function getAllAppointments() {
        return $this->repository->getAllAppointments();
    }

    public function getAppointmentById($id) {
        return $this->repository->getAppointmentById($id);
    }

    public function addAppointment($data) {
        return $this->repository->addAppointment($data);
    }

    public function updateAppointment($id, $data) {
        return $this->repository->updateAppointment($id, $data);
    }

    public function deleteAppointment($id) {
        return $this->repository->deleteAppointment($id);
    }
}
?>
