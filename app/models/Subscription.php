<?php
class Subscription
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Add subscription request
    public function addRequest($data)
    {
        $this->db->query("INSERT INTO subscriptions (user_id, package_id, status, payment_method, start_date, end_date) 
                         VALUES (:user_id, :package_id, 'pending', :payment_method, CURDATE(), DATE_ADD(CURDATE(), INTERVAL :days DAY))");

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':package_id', $data['package_id']);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':days', $data['duration_days']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get active subscription for user
    public function getUserSubscription($user_id)
    {
        $this->db->query("SELECT s.*, p.name as package_name, p.price, p.features 
                         FROM subscriptions s 
                         JOIN packages p ON s.package_id = p.id 
                         WHERE s.user_id = :user_id 
                         ORDER BY s.created_at DESC LIMIT 1");
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    // Admin: Get all pending subscriptions
    public function getPendingSubscriptions()
    {
        $this->db->query("SELECT s.*, u.name as user_name, u.email as user_email, p.name as package_name, p.price 
                         FROM subscriptions s 
                         JOIN users u ON s.user_id = u.id 
                         JOIN packages p ON s.package_id = p.id 
                         WHERE s.status = 'pending' 
                         ORDER BY s.created_at DESC");
        return $this->db->resultSet();
    }

    // Admin: Activate subscription
    public function activate($id)
    {
        $this->db->query("UPDATE subscriptions SET status = 'active', start_date = CURDATE(), 
                         end_date = DATE_ADD(CURDATE(), INTERVAL (SELECT duration_days FROM packages WHERE id = (SELECT package_id FROM subscriptions WHERE id = :id2)) DAY) 
                         WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':id2', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Admin: Reject/Delete subscription
    public function reject($id)
    {
        $this->db->query("UPDATE subscriptions SET status = 'rejected' WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Admin: Manually assign and activate a package
    public function assignPackage($user_id, $package_id)
    {
        // 1. Expire existing active subscriptions for this user
        $this->db->query("UPDATE subscriptions SET status = 'expired' WHERE user_id = :user_id AND status = 'active'");
        $this->db->bind(':user_id', $user_id);
        $this->db->execute();

        // 2. Get package duration
        $this->db->query("SELECT duration_days FROM packages WHERE id = :package_id");
        $this->db->bind(':package_id', $package_id);
        $package = $this->db->single();

        if (!$package)
            return false;

        // 3. Insert new active subscription
        $this->db->query("INSERT INTO subscriptions (user_id, package_id, status, payment_method, start_date, end_date) 
                         VALUES (:user_id, :package_id, 'active', 'Admin Assigned', CURDATE(), DATE_ADD(CURDATE(), INTERVAL :days DAY))");

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':package_id', $package_id);
        $this->db->bind(':days', $package->duration_days);

        return $this->db->execute();
    }
}
