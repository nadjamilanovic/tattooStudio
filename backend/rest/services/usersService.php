<?php
require_once(__DIR__ . '/BaseService.php');
require_once(__DIR__ . '/../dao/UsersDao.php');

class UsersService extends BaseService {
    public function __construct() {
        parent::__construct(new UsersDao());
    }
    public function registerUser($data) {
        if (!isset($data['password']) || empty($data['password'])) {
            throw new Exception("Password is required");
        }
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        if (!isset($data['role'])) {
            $data['role'] = 'user';
        }
        return $this->dao->createUser($data);
    }
    public function loginUser($email, $password) {
        $user = $this->dao->getByEmail($email);
        if (!$user) {
            throw new Exception("User not found");
        }
        if (!password_verify($password, $user['password'])) {
            throw new Exception("Invalid password");
        }
        unset($user['password']);
        return $user;
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