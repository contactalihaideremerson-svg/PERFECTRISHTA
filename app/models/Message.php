<?php
class Message
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get messages between two users
    public function getMessages($user_id, $other_id)
    {
        $this->db->query('SELECT * FROM messages WHERE (sender_id = :user_id AND receiver_id = :other_id) OR (sender_id = :other_id AND receiver_id = :user_id) ORDER BY created_at ASC');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':other_id', $other_id);

        return $this->db->resultSet();
    }

    // Add message
    public function addMessage($data)
    {
        $this->db->query('INSERT INTO messages (sender_id, receiver_id, message, type) VALUES (:sender_id, :receiver_id, :message, :type)');
        $this->db->bind(':sender_id', $data['sender_id']);
        $this->db->bind(':receiver_id', $data['receiver_id']);
        $this->db->bind(':message', $data['message']);
        $this->db->bind(':type', $data['type']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get recent chats
    public function getRecentChats($user_id)
    {
        $this->db->query('SELECT DISTINCT u.id, u.name, p.profile_pic, (SELECT m.message FROM messages m WHERE (m.sender_id = :user_id AND m.receiver_id = u.id) OR (m.sender_id = u.id AND m.receiver_id = :user_id) ORDER BY m.created_at DESC LIMIT 1) as last_message FROM users u JOIN profiles p ON u.id = p.user_id WHERE u.id IN (SELECT sender_id FROM messages WHERE receiver_id = :user_id UNION SELECT receiver_id FROM messages WHERE sender_id = :user_id)');
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }
}
