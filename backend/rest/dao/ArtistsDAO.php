<?php
require_once __DIR__ . '/BaseDao.php';

class ArtistsDao extends BaseDao {

    public function __construct() {
        parent::__construct("artists");
    }

    public function createArtist($artist) {
        return $this->insert($artist);
    }

    public function getAllArtists() {
        return $this->getAll();
    }

    public function getArtistById($id) {
        return $this->getById($id);
    }

    public function updateArtist($id, $artist) {
        return $this->update($id, $artist);
    }

    public function deleteArtist($id) {
        return $this->delete($id);
    }
}
?>
