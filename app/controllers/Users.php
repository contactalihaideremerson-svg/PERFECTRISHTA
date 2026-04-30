<?php
class Users extends Controller
{
    private $userModel;
    private $packageModel;
    private $subscriptionModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->packageModel = $this->model('Package');
        $this->subscriptionModel = $this->model('Subscription');
    }

    public function register()
    {
        // Clear any existing session to prevent leaks
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_role']);
        }

        // Fetch Packages
        $packages = $this->packageModel->getPackages();

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            // Init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'package_id' => trim($_POST['package_id'] ?? ''),
                'packages' => $packages,
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'package_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // Validate Package
            if (empty($data['package_id'])) {
                $data['package_err'] = 'Please select a package';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['package_err'])) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                $userId = $this->userModel->register($data);
                if ($userId) {
                    // Create Pending Subscription
                    $package = $this->packageModel->getPackageById($data['package_id']);
                    $subscriptionData = [
                        'user_id' => $userId,
                        'package_id' => $data['package_id'],
                        'duration_days' => $package->duration_days,
                        'payment_method' => 'Cash/Bank Transfer' // Default for signup
                    ];

                    if ($this->subscriptionModel->addRequest($subscriptionData)) {
                        // Success redirect to details page
                        $_SESSION['registered_user_id'] = $userId;
                        redirect('users/registered');
                    } else {
                        die('Something went wrong with subscription');
                    }
                } else {
                    die('Something went wrong');
                }

            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }

        } else {
            // Init data
            $data = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'password' => '',
                'confirm_password' => '',
                'package_id' => '',
                'packages' => $packages,
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'package_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function registered()
    {
        if (!isset($_SESSION['registered_user_id'])) {
            redirect('users/register');
        }

        $userId = $_SESSION['registered_user_id'];
        $user = $this->userModel->getUserById($userId);
        $subscription = $this->subscriptionModel->getUserSubscription($userId);

        $data = [
            'user' => $user,
            'subscription' => $subscription
        ];

        // Clear the session variable after loading
        unset($_SESSION['registered_user_id']);

        $this->view('users/registered', $data);
    }

    public function login()
    {
        // Clear any existing session to prevent leaks
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_role']);
        }

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Pleae enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $status = strtolower(trim($loggedInUser->status));
                    if ($status === 'active') {
                        // Create Session
                        $this->createUserSession($loggedInUser);
                    } elseif ($status === 'pending') {
                        $data['email_err'] = 'Your account is pending approval from Admin. Please contact Admin at WhatsApp <strong>0320-0005601</strong> for payment confirmation and account activation.';
                        $this->view('users/login', $data);
                    } elseif ($status === 'suspended') {
                        $data['email_err'] = 'Your account has been suspended.';
                        $this->view('users/login', $data);
                    } else {
                        // Fallback for any other status (e.g., empty or unexpected)
                        $data['email_err'] = 'Your account is not active. Status: [' . $status . ']. Please contact Admin.';
                        $this->view('users/login', $data);
                    }
                } else {
                    $data['password_err'] = 'Password incorrect';

                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }


        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_role'] = $user->role;

        if ($_SESSION['user_role'] == 'admin') {
            redirect('admin/index');
        } else {
            redirect('users/dashboard');
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('users/login');
    }

    public function dashboard()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        // Fetch User and Profile
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        $profile = $this->model('Profile')->getProfileByUserId($_SESSION['user_id']);
        $subscription = $this->model('Subscription')->getUserSubscription($_SESSION['user_id']);

        $data = [
            'title' => 'User Dashboard',
            'user' => $user,
            'profile' => $profile,
            'subscription' => $subscription
        ];
        $this->view('users/dashboard', $data);
    }
}

