<?php
require_once __DIR__ . '/BaseDao.php';

class AppointmentsDao extends BaseDao {
    public function __construct() {
        parent::__construct("appointments");
    }
}
?>
