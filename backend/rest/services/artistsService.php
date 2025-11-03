<?php
require_once __DIR__ . '/../dao/ArtistDao.php';

class ArtistService {
    private $artistDao;

    public function __construct() {
        $this->artistDao = new ArtistDao();
    }

    public function getAllArtists() {
        return $this->artistDao->getAll();
    }

    public function getArtistById($id) {
        return $this->artistDao->getById($id);
    }

    public function createArtist($data) {
        if (empty($data['user_id'])) {
            throw new Exception("user_id is required!");
        }
        return $this->artistDao->add($data);
    }

    public function updateArtist($id, $data) {
        return $this->artistDao->update($id, $data);
    }

    public function deleteArtist($id) {
        return $this->artistDao->delete($id);
    }
}
?>
