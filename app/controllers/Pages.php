<?php
class Pages extends Controller
{
    private $profileModel;
    private $db;

    public function __construct()
    {
        $this->profileModel = $this->model('Profile');
        $this->db = new Database();
    }

    public function index()
    {
        $filters = [
            'gender' => $_GET['gender'] ?? '',
            'city' => $_GET['city'] ?? '',
            'religion' => $_GET['religion'] ?? '',
            'marital_status' => $_GET['marital_status'] ?? '',
            'education' => $_GET['education'] ?? '',
            'min_age' => $_GET['min_age'] ?? '',
            'max_age' => $_GET['max_age'] ?? '',
            'limit' => 12
        ];

        $profiles = $this->profileModel->searchProfiles($filters);

        $data = [
            'title' => 'Welcome to Perfect Rishta',
            'description' => 'Find your perfect life partner today.',
            'profiles' => $profiles,
            'filters' => $filters
        ];

        $this->view('pages/index', $data);
    }

    public function packages()
    {
        $this->db->query("SELECT * FROM packages ORDER BY price ASC");
        $packages = $this->db->resultSet();

        $subscription = null;
        if (isLoggedIn()) {
            $subscription = $this->model('Subscription')->getUserSubscription($_SESSION['user_id']);
        }

        $data = [
            'title' => 'Our Packages',
            'packages' => $packages,
            'subscription' => $subscription
        ];

        $this->view('pages/packages', $data);
    }

    public function how_it_works()
    {
        $data = [
            'title' => 'How It Works'
        ];

        $this->view('pages/how_it_works', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'About Us'
        ];

        $this->view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us'
        ];

        $this->view('pages/contact', $data);
    }

    public function privacy()
    {
        $this->view('pages/privacy', []);
    }

    public function terms()
    {
        $this->view('pages/terms', []);
    }

    public function data_deletion()
    {
        $this->view('pages/data_deletion', []);
    }
}

