<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/TattooDesignsDao.php');

class TattooDesignsService extends BaseService {
    public function __construct() {
        parent::__construct(new TattooDesignsDao());
    }

    public function createDesign($data) {
        return $this->dao->insert($data);
    }

    public function getAllDesigns() {
        return $this->dao->getAll();
    }

    public function getDesignById($id) {
        return $this->dao->getById($id);
    }

    public function updateDesign($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteDesign($id) {
        return $this->dao->delete($id);
    }
}
?>