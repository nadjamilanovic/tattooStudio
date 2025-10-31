<?php
require_once __DIR__ . '/BaseDao.php';

class PaymentsDao extends BaseDao {
    public function __construct() {
        parent::__construct("payments");
    }
}
?>
