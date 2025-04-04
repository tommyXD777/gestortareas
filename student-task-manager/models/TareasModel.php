<?php
require_once 'config/Database.php';

class TaskModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }

    public function getTasksByUserId($userId) {
        $this->db->query('SELECT * FROM tasks WHERE user_id = :user_id ORDER BY due_date ASC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getTaskById($id) {
        $this->db->query('SELECT * FROM tasks WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data) {
        $this->db->query('INSERT INTO tasks (user_id, title, description, category, priority, due_date, status) 
                        VALUES (:user_id, :title, :description, :category, :priority, :due_date, :status)');
        

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':priority', $data['priority']);
        $this->db->bind(':due_date', $data['due_date']);
        $this->db->bind(':status', $data['status']);
        

        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    public function update($data) {
        $this->db->query('UPDATE tasks 
                        SET title = :title, description = :description, category = :category, 
                            priority = :priority, due_date = :due_date, status = :status 
                        WHERE id = :id AND user_id = :user_id');
        
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':priority', $data['priority']);
        $this->db->bind(':due_date', $data['due_date']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }
    
    public function delete($id, $userId) {
        $this->db->query('DELETE FROM tasks WHERE id = :id AND user_id = :user_id');

        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        

        return $this->db->execute();
    }
    
    public function updateStatus($id, $userId, $status) {
        $this->db->query('UPDATE tasks SET status = :status WHERE id = :id AND user_id = :user_id');

        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':status', $status);
        

        return $this->db->execute();
    }
    
    public function getTasksByCategory($userId, $category) {
        $this->db->query('SELECT * FROM tasks WHERE user_id = :user_id AND category = :category ORDER BY due_date ASC');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getTasksByStatus($userId, $status) {
        $this->db->query('SELECT * FROM tasks WHERE user_id = :user_id AND status = :status ORDER BY due_date ASC');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }

    public function getUpcomingTasks($userId) {
        $this->db->query('SELECT * FROM tasks 
                       WHERE user_id = :user_id 
                       AND due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) 
                       AND status != "completed"
                       ORDER BY due_date ASC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    public function getOverdueTasks($userId) {
        $this->db->query('SELECT * FROM tasks 
                       WHERE user_id = :user_id 
                       AND due_date < CURDATE() 
                       AND status != "completed"
                       ORDER BY due_date ASC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
}

