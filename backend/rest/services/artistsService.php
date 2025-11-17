<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/ArtistsDao.php');

class ArtistsService extends BaseService {
    public function __construct() {
        parent::__construct(new ArtistsDao());
    }
    public function createArtist($artist) {
        return $this->dao->createArtist($artist);
    }

    public function getAllArtists() {
        return $this->dao->getAllArtists();
    }

    public function getArtistById($id) {
        return $this->dao->getArtistById($id);
    }

    public function updateArtist($id, $artist) {
        return $this->dao->updateArtist($id, $artist);
    }

    public function deleteArtist($id) {
        return $this->dao->deleteArtist($id);
    }
}
?>