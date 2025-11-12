<?php
require_once __DIR__ . '/BaseDao.php';

class ArtistsDao extends BaseDao {

    public function __construct() {
        parent::__construct("artists");
    }

    public function create_artist($artist) {
        return $this->insert('artists', $artist);
    }

    public function get_all_artists() {
        return $this->query("SELECT * FROM artists");
    }

    public function get_artist_by_id($id) {
        return $this->query_unique("SELECT * FROM artists WHERE id = :id", ['id' => $id]);
    }

    public function update_artist($id, $artist) {
        $this->update('artists', $id, $artist);
        return $this->get_artist_by_id($id);
    }

    public function delete_artist($id) {
        return $this->execute("DELETE FROM artists WHERE id = :id", ['id' => $id]);
    }
}
?>
