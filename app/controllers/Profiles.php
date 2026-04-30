<?php
class Profiles extends Controller
{
    private $profileModel;
    private $userModel;

    public function __construct()
    {
        $this->profileModel = $this->model('Profile');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        // Pagination
        $limit = 12;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $filters = [
            'gender' => $_GET['gender'] ?? '',
            'city' => $_GET['city'] ?? '',
            'religion' => $_GET['religion'] ?? '',
            'min_age' => $_GET['min_age'] ?? '',
            'max_age' => $_GET['max_age'] ?? '',
            'limit' => $limit,
            'offset' => $offset
        ];

        $profiles = $this->profileModel->searchProfiles($filters);
        $totalProfiles = $this->profileModel->getTotalProfiles($filters);
        $totalPages = ceil($totalProfiles / $limit);

        $data = [
            'profiles' => $profiles,
            'filters' => $filters,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'total_profiles' => $totalProfiles,
                'limit' => $limit
            ]
        ];

        $this->view('profiles/index', $data);
    }

    public function edit()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            // 1. Update User Table
            $userData = [
                'id' => $_SESSION['user_id'],
                'name' => trim($_POST['name'] ?? ''),
                'phone' => trim($_POST['phone'] ?? '')
            ];

            if (!empty($userData['name'])) {
                $this->userModel->updateUser($userData);
                $_SESSION['user_name'] = $userData['name'];
            }

            // 2. Update Profile Table
            $data = [
                'user_id' => $_SESSION['user_id'],
                'bio' => trim($_POST['bio'] ?? ''),
                'dob' => trim($_POST['dob'] ?? ''),
                'gender' => trim($_POST['gender'] ?? ''),
                'city' => trim($_POST['city'] ?? ''),
                'country' => trim($_POST['country'] ?? ''),
                'religion' => trim($_POST['religion'] ?? ''),
                'sect' => trim($_POST['sect'] ?? ''),
                'marital_status' => trim($_POST['marital_status'] ?? ''),
                'education' => trim($_POST['education'] ?? ''),
                'degree' => trim($_POST['degree'] ?? ''),
                'occupation' => trim($_POST['occupation'] ?? ''),
                'job_title' => trim($_POST['job_title'] ?? ''),
                'age' => !empty($_POST['dob']) ? $this->calculateAge($_POST['dob']) : 0,
                'height' => trim($_POST['height'] ?? ''),
                'weight' => trim($_POST['weight'] ?? ''),
                'skin_color' => $_POST['skin_color'] ?? '',
                'complexion' => trim($_POST['complexion'] ?? ''),
                'blood_group' => trim($_POST['blood_group'] ?? ''),
                'caste' => $_POST['caste'] ?? '',
                'permanent_address' => trim($_POST['permanent_address'] ?? ''),
                'temporary_address' => trim($_POST['temporary_address'] ?? ''),
                'physique' => $_POST['physique'] ?? '',
                'disability' => trim($_POST['disability'] ?? ''),
                'is_overseas' => isset($_POST['is_overseas']) ? 1 : 0,
                'has_bike' => isset($_POST['has_bike']) ? 1 : 0,
                'has_car' => isset($_POST['has_car']) ? 1 : 0,
                'whatsapp' => trim($_POST['whatsapp'] ?? ''),
                'employment_type' => $_POST['employment_type'] ?? 'none',
                'company_name' => trim($_POST['company_name'] ?? ''),
                'company_address' => trim($_POST['company_address'] ?? ''),
                'monthly_income' => !empty($_POST['monthly_income']) ? $_POST['monthly_income'] : 0,
                'house_status' => $_POST['house_status'] ?? 'None',
                'house_size' => trim($_POST['house_size'] ?? ''),
                'father_income' => !empty($_POST['father_income']) ? $_POST['father_income'] : 0,
                'mother_income' => !empty($_POST['mother_income']) ? $_POST['mother_income'] : 0,
                'father_name' => trim($_POST['father_name'] ?? ''),
                'cnic' => trim($_POST['cnic'] ?? ''),
                'father_status' => $_POST['father_status'] ?? 'Alive',
                'mother_status' => $_POST['mother_status'] ?? 'Alive',
                'father_occup' => trim($_POST['father_occup'] ?? ''),
                'mother_occup' => trim($_POST['mother_occup'] ?? ''),
                'brothers_count' => (int) ($_POST['brothers_count'] ?? 0),
                'married_brothers' => (int) ($_POST['married_brothers'] ?? 0),
                'sisters_count' => (int) ($_POST['sisters_count'] ?? 0),
                'married_sisters' => (int) ($_POST['married_sisters'] ?? 0),
                'has_children' => $_POST['has_children'] ?? 'No',
                'children_count' => (int) ($_POST['children_count'] ?? 0),
                'living_with' => trim($_POST['living_with'] ?? ''),
                'pref_age' => trim($_POST['pref_age'] ?? ''),
                'pref_height' => trim($_POST['pref_height'] ?? ''),
                'pref_education' => trim($_POST['pref_education'] ?? ''),
                'pref_caste' => trim($_POST['pref_caste'] ?? ''),
                'pref_city' => trim($_POST['pref_city'] ?? ''),
                'pref_income' => trim($_POST['pref_income'] ?? ''),
                'pref_others' => trim($_POST['pref_others'] ?? ''),
            ];

            // 2.1 Section 7 - Bureau Office Info (Admin Only Protection)
            $existing_profile = $this->profileModel->getProfileByUserId($_SESSION['user_id']);

            if ($_SESSION['user_role'] == 'admin') {
                $data['form_no'] = trim($_POST['form_no'] ?? '');
                $data['receipt_no'] = trim($_POST['receipt_no'] ?? '');
                $data['fee'] = !empty($_POST['fee']) ? $_POST['fee'] : 0.00;
                $data['admin_notes'] = trim($_POST['admin_notes'] ?? '');

                // Signature upload
                if (isset($_FILES['admin_signature']) && $_FILES['admin_signature']['error'] === 0) {
                    $file = $_FILES['admin_signature'];
                    $filename = 'sig_' . time() . '_' . $file['name'];
                    $target = APPROOT . '/../public/uploads/signatures/' . $filename;
                    if (move_uploaded_file($file['tmp_name'], $target)) {
                        $data['admin_signature'] = $filename;
                    } else {
                        $data['admin_signature'] = $existing_profile->admin_signature ?? '';
                    }
                } else {
                    $data['admin_signature'] = $existing_profile->admin_signature ?? '';
                }
            } else {
                // Regular users cannot modify these
                $data['form_no'] = $existing_profile->form_no ?? '';
                $data['receipt_no'] = $existing_profile->receipt_no ?? '';
                $data['fee'] = $existing_profile->fee ?? 0.00;
                $data['admin_notes'] = $existing_profile->admin_notes ?? '';
                $data['admin_signature'] = $existing_profile->admin_signature ?? '';
            }

            // 3. Update Profile Pic (if uploaded)
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
                $file = $_FILES['profile_pic'];
                $filename = time() . '_' . $file['name'];
                $target = APPROOT . '/../public/uploads/' . $filename;

                if (move_uploaded_file($file['tmp_name'], $target)) {
                    $this->profileModel->updateProfilePic($_SESSION['user_id'], $filename);
                }
            }

            if ($this->profileModel->updateProfile($data)) {
                flash('profile_message', 'Profile updated successfully');
                redirect('users/dashboard');
            } else {
                die('Something went wrong');
            }
        } else {
            $profile = $this->profileModel->getProfileByUserId($_SESSION['user_id']);
            $user = $this->userModel->getUserById($_SESSION['user_id']);

            $data = [
                'profile' => $profile,
                'user' => $user
            ];

            $this->view('profiles/edit', $data);
        }
    }

    public function upload_pic()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
            $file = $_FILES['profile_pic'];
            $filename = time() . '_' . $file['name'];
            $target = APPROOT . '/../public/uploads/' . $filename;

            if (move_uploaded_file($file['tmp_name'], $target)) {
                if ($this->profileModel->updateProfilePic($_SESSION['user_id'], $filename)) {
                    flash('profile_message', 'Profile picture updated');
                    redirect('users/dashboard');
                }
            }
        }
    }

    public function show($id = null)
    {
        if ($id === null) {
            redirect('profiles');
        }

        $profile = $this->profileModel->getProfileByUserId($id);
        $user = $this->model('User')->getUserById($id);

        if (!$profile || !$user) {
            redirect('profiles');
        }

        $data = [
            'profile' => $profile,
            'user' => $user
        ];

        $this->view('profiles/show', $data);
    }

    private function calculateAge($dob)
    {
        $birthDate = new DateTime($dob);
        $today = new DateTime('today');
        $age = $birthDate->diff($today)->y;
        return $age;
    }
}

