<?php
require_once __DIR__ . '/BaseDao.php';

class ArtistsDao extends BaseDao {
    public function __construct() {
        parent::__construct("artists");
    }
}
?>
