<?php
require_once __DIR__ . '/../dao/UserDao.php';

class UserService {
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }

    public function getAllUsers() {
        return $this->userDao->getAll();
    }

    public function getUserById($id) {
        return $this->userDao->getById($id);
    }

    public function createUser($data) {
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            throw new Exception("All fields are required!");
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        return $this->userDao->add($data);
    }

    public function updateUser($id, $data) {
        return $this->userDao->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->userDao->delete($id);
    }
}
?>
