<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/UsersDao.php');

class UsersService extends BaseService {
    public function __construct() {
        parent::__construct(new UsersDao());
    }
    public function createUser($data) {
        return $this->dao->insert($data);
    }
    public function getAllUsers() {
        return $this->dao->getAll();
    }
    public function getUserById($id) {
        return $this->dao->getById($id);
    }
    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->dao->fetch();
    }

    public function updateUser($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->delete($id);
    }
}
?>