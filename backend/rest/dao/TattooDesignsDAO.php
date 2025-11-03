<?php
require_once __DIR__ . '/BaseDao.php';

class TattooDesignsDao extends BaseDao {
    public function __construct() {
        parent::__construct("tattoo_designs");
    }
}
?>
