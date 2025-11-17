<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/UsersDao.php');

class UsersService extends BaseService {
    public function __construct() {
        parent::__construct(new UsersDao());
    }
    public function createUser($data) {
        return $this->dao->createUser($data);
    }
    public function getAllUsers() {
        return $this->dao->getAllUsers();
    }
    public function getUserById($id) {
        return $this->dao->getUserById($id);
    }
    public function getByEmail($email) {
    return $this->dao->getByEmail($email);
    }
    public function updateUser($id, $data) {
        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->deleteUser($id);
    }
}
?>