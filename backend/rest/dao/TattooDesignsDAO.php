<?php
require_once __DIR__ . '/BaseDao.php';

class TattooDesignsDao extends BaseDao {

    public function __construct() {
        parent::__construct("tattoo_designs");
    }

    public function createDesign($data) {
        return $this->insert($data);
    }

    public function getAllDesigns() {
        return $this->getAll();
    }

    public function getDesignById($id) {
        return $this->getById($id);
    }

    public function updateDesign($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteDesign($id) {
        return $this->delete($id);
    }
}
?>
