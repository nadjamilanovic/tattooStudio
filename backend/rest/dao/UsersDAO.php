<?php
require_once __DIR__ . '/BaseDao.php';

class UsersDao extends BaseDao {

    public function __construct() {
        parent::__construct("users");
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
        return $user;
    }
    public function createUser($data) {
        return $this->insert($data);
    }

    public function getAllUsers() {
        return $this->getAll();
    }

    public function getUserById($id) {
        return $this->getById($id);
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->delete($id);
    }
}
?>
