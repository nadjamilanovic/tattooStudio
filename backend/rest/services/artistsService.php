<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/ArtistsDao.php');

class ArtistsService extends BaseService {
    public function __construct() {
        parent::__construct(new ArtistsDao());
    }
    public function create_artist($artist) {
        return $this->dao->insert('artists', $artist);
    }

    public function get_all_artists() {
        return $this->dao->query("SELECT * FROM artists");
    }

    public function get_artist_by_id($id) {
        return $this->dao->query_unique("SELECT * FROM artists WHERE id = :id", ['id' => $id]);
    }

    public function update_artist($id, $artist) {
        $this->update('artists', $id, $artist);
        return $this->dao->get_artist_by_id($id);
    }

    public function delete_artist($id) {
        return $this->dao->execute("DELETE FROM artists WHERE id = :id", ['id' => $id]);
    }
}
?>