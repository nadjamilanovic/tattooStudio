<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/TattooDesignsDao.php');

class TattooDesignsService extends BaseService {
    public function __construct() {
        parent::__construct(new TattooDesignsDao());
    }

    public function createDesign($data) {
        return $this->dao->createDesign($data);
    }

    public function getAllDesigns() {
        return $this->dao->getAllDesigns();
    }

    public function getDesignById($id) {
        return $this->dao->getDesignById($id);
    }

    public function updateDesign($id, $data) {
        return $this->dao->updateDesign($id, $data);
    }

    public function deleteDesign($id) {
        return $this->dao->deleteDesign($id);
    }
}
?>