<?php
require_once __DIR__ . '/../repositories/tattooDesignsRepository.php';

class TattooDesignsService {
    private $repository;

    public function __construct() {
        $this->repository = new TattooDesignsRepository();
    }

    public function getAllDesigns() {
        return $this->repository->getAllDesigns();
    }

    public function getDesignById($id) {
        return $this->repository->getDesignById($id);
    }

    public function addDesign($data) {
        return $this->repository->addDesign($data);
    }

    public function updateDesign($id, $data) {
        return $this->repository->updateDesign($id, $data);
    }

    public function deleteDesign($id) {
        return $this->repository->deleteDesign($id);
    }
}
?>
