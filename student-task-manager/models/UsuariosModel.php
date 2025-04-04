<?php
require_once 'config/Database.php';

class UserModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        if ($row) {
            $hashedPassword = $row->password;
            
            if (password_verify($password, $hashedPassword)) {
                return $row;
            }
        }
        
        return false;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id) {
        $this->db->query('SELECT id, name, email, created_at FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateProfile($data) {
        $this->db->query('UPDATE users SET name = :name WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);

        return $this->db->execute();
    }

    public function updatePassword($userId, $newPassword) {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        

        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        

        $this->db->bind(':id', $userId);
        $this->db->bind(':password', $newPassword);
        
        return $this->db->execute();
    }
}

