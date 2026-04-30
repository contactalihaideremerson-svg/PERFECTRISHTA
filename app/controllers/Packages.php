<?php
class Packages extends Controller
{
    private $packageModel;
    private $subscriptionModel;

    public function __construct()
    {
        $this->packageModel = $this->model('Package');
        $this->subscriptionModel = $this->model('Subscription');
    }

    public function index()
    {
        $packages = $this->packageModel->getPackages();
        $subscription = null;

        if (isLoggedIn()) {
            $subscription = $this->subscriptionModel->getUserSubscription($_SESSION['user_id']);
        }

        $data = [
            'packages' => $packages,
            'subscription' => $subscription
        ];

        $this->view('pages/packages', $data);
    }

    public function buy($id)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $package = $this->packageModel->getPackageById($id);

        $data = [
            'package' => $package
        ];

        $this->view('pages/buy_package', $data);
    }

    public function request($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $package = $this->packageModel->getPackageById($id);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'package_id' => $id,
                'duration_days' => $package->duration_days,
                'payment_method' => trim($_POST['payment_method'])
            ];

            if ($this->subscriptionModel->addRequest($data)) {
                flash('package_message', 'Subscription request submitted! Please wait for Admin approval.');
                redirect('users/dashboard');
            } else {
                die('Something went wrong');
            }
        }
    }
}

