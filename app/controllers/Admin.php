<?php
class Admin extends Controller
{
    private $userModel;
    private $subscriptionModel;
    private $packageModel;
    private $db;

    public function __construct()
    {
        if (!isLoggedIn() || !isAdmin()) {
            redirect('users/login');
        }
        $this->userModel = $this->model('User');
        $this->subscriptionModel = $this->model('Subscription');
        $this->packageModel = $this->model('Package');
        $this->db = new Database(); // For quick stats
    }

    public function index()
    {
        // Get Stats
        $this->db->query("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
        $total_users = $this->db->single()->total;

        $this->db->query("SELECT COUNT(*) as total FROM users WHERE status = 'active' AND role = 'user'");
        $active_users = $this->db->single()->total;

        $this->db->query("SELECT COUNT(*) as total FROM users WHERE status = 'pending'");
        $pending_users = $this->db->single()->total;

        $this->db->query("SELECT COUNT(*) as total FROM subscriptions WHERE status = 'active'");
        $paid_users = $this->db->single()->total;

        $this->db->query("SELECT SUM(p.price) as total FROM subscriptions s JOIN packages p ON s.package_id = p.id WHERE s.status = 'active'");
        $revenue = $this->db->single()->total ?: 0;

        $this->db->query("SELECT u.id, u.name, u.email, u.created_at FROM users u WHERE u.status = 'pending' ORDER BY u.created_at DESC LIMIT 5");
        $recent_requests = $this->db->resultSet();

        $data = [
            'stats' => [
                'total_users' => $total_users,
                'active_users' => $active_users,
                'pending_users' => $pending_users,
                'paid_users' => $paid_users,
                'revenue' => $revenue
            ],
            'recent_requests' => $recent_requests
        ];

        $this->view('admin/index', $data);
    }

    public function users()
    {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        $gender = $_GET['gender'] ?? '';
        $religion = $_GET['religion'] ?? '';
        $city = $_GET['city'] ?? '';
        $marital_status = $_GET['marital_status'] ?? '';
        $education = $_GET['education'] ?? '';

        $query = "SELECT u.id, u.name, u.email, u.status, u.role, u.is_verified, u.created_at, p.city, p.gender, 
                         pk.name as package_name
                  FROM users u 
                  LEFT JOIN profiles p ON u.id = p.user_id 
                  LEFT JOIN subscriptions s ON u.id = s.user_id AND s.status = 'active'
                  LEFT JOIN packages pk ON s.package_id = pk.id
                  WHERE u.role = 'user' AND u.status != 'pending'";

        if (!empty($search)) {
            $query .= " AND (u.name LIKE :search 
                         OR u.email LIKE :search 
                         OR u.phone LIKE :search 
                         OR u.id LIKE :search)";
        }
        if (!empty($gender)) {
            $query .= " AND p.gender = :gender";
        }
        if (!empty($religion)) {
            $query .= " AND p.religion = :religion";
        }
        if (!empty($city)) {
            $query .= " AND p.city LIKE :city";
        }
        if (!empty($marital_status)) {
            $query .= " AND p.marital_status = :marital_status";
        }
        if (!empty($education)) {
            $query .= " AND p.education LIKE :education";
        }

        $query .= " ORDER BY u.created_at DESC";

        $this->db->query($query);

        if (!empty($search)) {
            $this->db->bind(':search', '%' . $search . '%');
        }
        if (!empty($gender)) {
            $this->db->bind(':gender', $gender);
        }
        if (!empty($religion)) {
            $this->db->bind(':religion', $religion);
        }
        if (!empty($city)) {
            $this->db->bind(':city', '%' . $city . '%');
        }
        if (!empty($marital_status)) {
            $this->db->bind(':marital_status', $marital_status);
        }
        if (!empty($education)) {
            $this->db->bind(':education', '%' . $education . '%');
        }

        $users = $this->db->resultSet();

        $data = [
            'users' => $users,
            'filters' => [
                'search' => $search,
                'gender' => $gender,
                'religion' => $religion,
                'city' => $city,
                'marital_status' => $marital_status,
                'education' => $education
            ]
        ];

        $this->view('admin/users', $data);
    }

    // User Registration Requests
    public function requests()
    {
        $this->db->query("SELECT u.id, u.name, u.email, u.status, u.role, u.is_verified, u.created_at, p.city, p.gender, 
                                 pk.name as package_name
                          FROM users u 
                          LEFT JOIN profiles p ON u.id = p.user_id 
                          LEFT JOIN subscriptions s ON u.id = s.user_id AND s.status = 'pending'
                          LEFT JOIN packages pk ON s.package_id = pk.id
                          WHERE u.status = 'pending' 
                          ORDER BY u.created_at DESC");
        $requests = $this->db->resultSet();

        $data = [
            'requests' => $requests
        ];

        $this->view('admin/requests', $data);
    }

    public function approve_user($id)
    {
        $this->db->query("UPDATE users SET status = 'active' WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            flash('admin_message', 'User account approved');
            redirect('admin/requests');
        }
    }

    // Package Management
    public function packages()
    {
        $this->db->query("SELECT * FROM packages ORDER BY price ASC");
        $packages = $this->db->resultSet();

        $data = [
            'packages' => $packages
        ];

        $this->view('admin/packages', $data);
    }

    public function add_package()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $features = $_POST['features'] ?? [];
            // Remove empty features
            $features = array_filter($features, function ($value) {
                return !empty(trim($value));
            });

            $this->db->query("INSERT INTO packages (name, price, duration_days, features) VALUES (:name, :price, :duration, :features)");
            $this->db->bind(':name', trim($_POST['name']));
            $this->db->bind(':price', $_POST['price']);
            $this->db->bind(':duration', $_POST['duration']);
            $this->db->bind(':features', json_encode($features));

            if ($this->db->execute()) {
                flash('admin_message', 'Package added successfully');
                redirect('admin/packages');
            }
        } else {
            $this->view('admin/add_package', []);
        }
    }

    public function edit_package($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $features = $_POST['features'] ?? [];
            $features = array_filter($features, function ($value) {
                return !empty(trim($value));
            });

            $this->db->query("UPDATE packages SET name = :name, price = :price, duration_days = :duration, features = :features WHERE id = :id");
            $this->db->bind(':name', trim($_POST['name']));
            $this->db->bind(':price', $_POST['price']);
            $this->db->bind(':duration', $_POST['duration']);
            $this->db->bind(':features', json_encode($features));
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                flash('admin_message', 'Package updated successfully');
                redirect('admin/packages');
            }
        } else {
            $this->db->query("SELECT * FROM packages WHERE id = :id");
            $this->db->bind(':id', $id);
            $package = $this->db->single();

            $data = [
                'package' => $package
            ];

            $this->view('admin/edit_package', $data);
        }
    }

    public function delete_package($id)
    {
        $this->db->query("DELETE FROM packages WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            flash('admin_message', 'Package deleted');
            redirect('admin/packages');
        }
    }

    public function toggle_status($id)
    {
        $this->db->query("SELECT status FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $user = $this->db->single();

        $new_status = ($user->status == 'active') ? 'suspended' : 'active';

        $this->db->query("UPDATE users SET status = :status WHERE id = :id");
        $this->db->bind(':status', $new_status);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            flash('admin_message', 'User status updated');
            redirect('admin/users');
        }
    }

    public function add_user()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $email = trim($_POST['email']);

            // Check if email already exists
            $this->db->query("SELECT id FROM users WHERE email = :email");
            $this->db->bind(':email', $email);
            $this->db->execute();

            if ($this->db->rowCount() > 0) {
                flash('admin_message', 'Error: The email "' . $email . '" is already registered to another user.', 'bg-red-100 text-red-700 p-4 rounded-xl mb-6');
                $this->view('admin/add_user', []);
                return;
            }

            // Check if phone already exists
            $phone = trim($_POST['phone']);
            $this->db->query("SELECT id FROM users WHERE phone = :phone");
            $this->db->bind(':phone', $phone);
            $this->db->execute();

            if ($this->db->rowCount() > 0) {
                flash('admin_message', 'Error: The phone number "' . $phone . '" is already registered to another user.', 'bg-red-100 text-red-700 p-4 rounded-xl mb-6');
                $this->view('admin/add_user', []);
                return;
            }

            $data = [
                'name' => trim($_POST['name']),
                'email' => $email,
                'phone' => trim($_POST['phone']),
                'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
                'role' => 'user',
                'status' => 'active'
            ];

            // Add User
            $this->db->query("INSERT INTO users (name, email, password, phone, role, status) VALUES (:name, :email, :password, :phone, :role, :status)");
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':status', $data['status']);

            if ($this->db->execute()) {
                // Get the last inserted ID
                $this->db->query("SELECT LAST_INSERT_ID() as id");
                $user_id = $this->db->single()->id;

                // Handle Profile Picture
                $profile_pic = 'default.png';
                if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
                    $file = $_FILES['profile_pic'];
                    $filename = time() . '_' . $file['name'];
                    $target = APPROOT . '/../public/uploads/' . $filename;

                    if (move_uploaded_file($file['tmp_name'], $target)) {
                        $profile_pic = $filename;
                    }
                }

                // Create Full Profile
                $this->db->query("INSERT INTO profiles (user_id, profile_pic, age, gender, city, religion, marital_status, bio, education, occupation, dob, height, skin_color, caste, sect, permanent_address, temporary_address, physique, disability, is_overseas, has_bike, has_car, whatsapp, employment_type, company_name, company_address, monthly_income, house_status, house_size, father_income, mother_income, father_name, cnic, weight, complexion, blood_group, degree, job_title, country, father_status, mother_status, father_occup, mother_occup, brothers_count, married_brothers, sisters_count, married_sisters, has_children, children_count, living_with, pref_age, pref_height, pref_education, pref_caste, pref_city, pref_income, pref_others, form_no, receipt_no, fee, admin_signature, admin_notes) 
                                 VALUES (:user_id, :profile_pic, :age, :gender, :city, :religion, :marital_status, :bio, :education, :occupation, :dob, :height, :skin_color, :caste, :sect, :permanent_address, :temporary_address, :physique, :disability, :is_overseas, :has_bike, :has_car, :whatsapp, :employment_type, :company_name, :company_address, :monthly_income, :house_status, :house_size, :father_income, :mother_income, :father_name, :cnic, :weight, :complexion, :blood_group, :degree, :job_title, :country, :father_status, :mother_status, :father_occup, :mother_occup, :brothers_count, :married_brothers, :sisters_count, :married_sisters, :has_children, :children_count, :living_with, :pref_age, :pref_height, :pref_education, :pref_caste, :pref_city, :pref_income, :pref_others, :form_no, :receipt_no, :fee, :admin_signature, :admin_notes)");

                $this->db->bind(':user_id', $user_id);
                $this->db->bind(':profile_pic', $profile_pic);
                $this->db->bind(':age', $_POST['age']);
                $this->db->bind(':gender', $_POST['gender']);
                $this->db->bind(':city', trim($_POST['city']));
                $this->db->bind(':religion', trim($_POST['religion']));
                $this->db->bind(':marital_status', $_POST['marital_status']);
                $this->db->bind(':bio', trim($_POST['bio']));
                $this->db->bind(':education', trim($_POST['education']));
                $this->db->bind(':occupation', trim($_POST['occupation']));
                $this->db->bind(':dob', $_POST['dob']);
                $this->db->bind(':height', trim($_POST['height']));
                $this->db->bind(':skin_color', $_POST['skin_color']);

                // Custom Caste Logic
                $caste = trim($_POST['caste']);
                if ($caste === 'Others' && !empty($_POST['caste_custom'])) {
                    $caste = trim($_POST['caste_custom']);
                }
                $this->db->bind(':caste', $caste);

                $this->db->bind(':sect', $_POST['sect']);
                $this->db->bind(':permanent_address', trim($_POST['permanent_address']));
                $this->db->bind(':temporary_address', trim($_POST['temporary_address']));
                $this->db->bind(':physique', $_POST['physique']);
                $this->db->bind(':disability', trim($_POST['disability']));
                $this->db->bind(':is_overseas', isset($_POST['is_overseas']) ? 1 : 0);
                $this->db->bind(':has_bike', isset($_POST['has_bike']) ? 1 : 0);
                $this->db->bind(':has_car', isset($_POST['has_car']) ? 1 : 0);
                $this->db->bind(':whatsapp', trim($_POST['whatsapp']));
                $this->db->bind(':employment_type', $_POST['employment_type']);
                $this->db->bind(':company_name', trim($_POST['company_name']));
                $this->db->bind(':company_address', trim($_POST['company_address']));
                $this->db->bind(':monthly_income', $_POST['monthly_income'] ?: 0);
                $this->db->bind(':house_status', $_POST['house_status'] ?? 'None');
                $this->db->bind(':house_size', trim($_POST['house_size'] ?? ''));
                $this->db->bind(':father_income', $_POST['father_income'] ?: 0);
                $this->db->bind(':mother_income', $_POST['mother_income'] ?: 0);

                // New Fields
                $this->db->bind(':father_name', trim($_POST['father_name'] ?? ''));
                $this->db->bind(':cnic', trim($_POST['cnic'] ?? ''));
                $this->db->bind(':weight', trim($_POST['weight'] ?? ''));
                $this->db->bind(':complexion', $_POST['complexion'] ?? '');
                $this->db->bind(':blood_group', $_POST['blood_group'] ?? '');
                $this->db->bind(':degree', trim($_POST['degree'] ?? ''));
                $this->db->bind(':job_title', trim($_POST['job_title'] ?? ''));
                $this->db->bind(':country', trim($_POST['country'] ?? ''));
                $this->db->bind(':father_status', $_POST['father_status'] ?? '');
                $this->db->bind(':mother_status', $_POST['mother_status'] ?? '');
                $this->db->bind(':father_occup', trim($_POST['father_occup'] ?? ''));
                $this->db->bind(':mother_occup', trim($_POST['mother_occup'] ?? ''));
                $this->db->bind(':brothers_count', (int) ($_POST['brothers_count'] ?? 0));
                $this->db->bind(':married_brothers', (int) ($_POST['married_brothers'] ?? 0));
                $this->db->bind(':sisters_count', (int) ($_POST['sisters_count'] ?? 0));
                $this->db->bind(':married_sisters', (int) ($_POST['married_sisters'] ?? 0));
                $this->db->bind(':has_children', $_POST['has_children'] ?? '');
                $this->db->bind(':children_count', (int) ($_POST['children_count'] ?? 0));
                $this->db->bind(':living_with', trim($_POST['living_with'] ?? ''));
                $this->db->bind(':pref_age', trim($_POST['pref_age'] ?? ''));
                $this->db->bind(':pref_height', trim($_POST['pref_height'] ?? ''));
                $this->db->bind(':pref_education', trim($_POST['pref_education'] ?? ''));
                $this->db->bind(':pref_caste', trim($_POST['pref_caste'] ?? ''));
                $this->db->bind(':pref_city', trim($_POST['pref_city'] ?? ''));
                $this->db->bind(':pref_income', trim($_POST['pref_income'] ?? ''));
                $this->db->bind(':pref_others', trim($_POST['pref_others'] ?? ''));
                $this->db->bind(':form_no', trim($_POST['form_no'] ?? ''));
                $this->db->bind(':receipt_no', trim($_POST['receipt_no'] ?? ''));
                $this->db->bind(':fee', (float) ($_POST['fee'] ?? 0));
                $this->db->bind(':admin_signature', ''); // Placeholder for creation
                $this->db->bind(':admin_notes', trim($_POST['admin_notes'] ?? ''));

                $this->db->execute();

                // Assign Package if selected
                if (!empty($_POST['package_id'])) {
                    $this->subscriptionModel->assignPackage($user_id, $_POST['package_id']);
                }

                flash('admin_message', 'User account and complete profile created successfully');
                redirect('admin/users');
            }
        } else {
            $packages = $this->packageModel->getPackages();
            $data = [
                'packages' => $packages
            ];
            $this->view('admin/add_user', $data);
        }
    }

    public function edit_user($id = null)
    {
        if ($id === null) {
            redirect('admin/users');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $email = trim($_POST['email']);

            // Check if email exists for ANOTHER user
            $this->db->query("SELECT id FROM users WHERE email = :email AND id != :id");
            $this->db->bind(':email', $email);
            $this->db->bind(':id', $id);
            $this->db->execute();

            if ($this->db->rowCount() > 0) {
                $conflict_user = $this->db->single();
                flash('admin_message', 'Error: The email "' . $email . '" is already registered to another user ID: ' . $conflict_user->id, 'bg-red-100 text-red-700 p-4 rounded-xl mb-6');
                redirect('admin/edit_user/' . $id);
            }

            // Check if phone exists for ANOTHER user
            $phone = trim($_POST['phone']);
            $this->db->query("SELECT id FROM users WHERE phone = :phone AND id != :id");
            $this->db->bind(':phone', $phone);
            $this->db->bind(':id', $id);
            $this->db->execute();

            if ($this->db->rowCount() > 0) {
                $conflict_user = $this->db->single();
                flash('admin_message', 'Error: The phone number "' . $phone . '" is already registered to another user ID: ' . $conflict_user->id, 'bg-red-100 text-red-700 p-4 rounded-xl mb-6');
                redirect('admin/edit_user/' . $id);
            }

            // Ensure profile record exists before update
            $this->db->query("SELECT id FROM profiles WHERE user_id = :user_id");
            $this->db->bind(':user_id', $id);
            $this->db->execute();

            if ($this->db->rowCount() === 0) {
                // Create profile if it doesn't exist
                $this->db->query("INSERT INTO profiles (user_id) VALUES (:user_id)");
                $this->db->bind(':user_id', $id);
                $this->db->execute();
            }

            // Update User Table
            $this->db->query("UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id");
            $this->db->bind(':name', trim($_POST['name']));
            $this->db->bind(':email', $email);
            $this->db->bind(':phone', trim($_POST['phone']));
            $this->db->bind(':id', $id);
            $this->db->execute();

            // Update Profile Table
            $this->db->query("UPDATE profiles SET age = :age, gender = :gender, city = :city, religion = :religion, marital_status = :marital_status, bio = :bio, education = :education, occupation = :occupation, dob = :dob, height = :height, skin_color = :skin_color, caste = :caste, sect = :sect, permanent_address = :permanent_address, temporary_address = :temporary_address, physique = :physique, disability = :disability, is_overseas = :is_overseas, has_bike = :has_bike, has_car = :has_car, whatsapp = :whatsapp, employment_type = :employment_type, company_name = :company_name, company_address = :company_address, monthly_income = :monthly_income, house_status = :house_status, house_size = :house_size, father_income = :father_income, mother_income = :mother_income, father_name = :father_name, cnic = :cnic, weight = :weight, complexion = :complexion, blood_group = :blood_group, degree = :degree, job_title = :job_title, country = :country, father_status = :father_status, mother_status = :mother_status, father_occup = :father_occup, mother_occup = :mother_occup, brothers_count = :brothers_count, married_brothers = :married_brothers, sisters_count = :sisters_count, married_sisters = :married_sisters, has_children = :has_children, children_count = :children_count, living_with = :living_with, pref_age = :pref_age, pref_height = :pref_height, pref_education = :pref_education, pref_caste = :pref_caste, pref_city = :pref_city, pref_income = :pref_income, pref_others = :pref_others, form_no = :form_no, receipt_no = :receipt_no, fee = :fee, admin_notes = :admin_notes WHERE user_id = :user_id");

            $this->db->bind(':age', $_POST['age']);
            $this->db->bind(':gender', $_POST['gender']);
            $this->db->bind(':city', trim($_POST['city']));
            $this->db->bind(':religion', trim($_POST['religion']));
            $this->db->bind(':marital_status', $_POST['marital_status']);
            $this->db->bind(':bio', trim($_POST['bio']));
            $this->db->bind(':education', trim($_POST['education']));
            $this->db->bind(':occupation', trim($_POST['occupation']));
            $this->db->bind(':dob', $_POST['dob']);
            $this->db->bind(':height', trim($_POST['height']));
            $this->db->bind(':skin_color', $_POST['skin_color']);

            // Custom Caste Logic
            $caste = trim($_POST['caste']);
            if ($caste === 'Others' && !empty($_POST['caste_custom'])) {
                $caste = trim($_POST['caste_custom']);
            }
            $this->db->bind(':caste', $caste);

            $this->db->bind(':sect', $_POST['sect']);
            $this->db->bind(':permanent_address', trim($_POST['permanent_address']));
            $this->db->bind(':temporary_address', trim($_POST['temporary_address']));
            $this->db->bind(':physique', $_POST['physique']);
            $this->db->bind(':disability', trim($_POST['disability']));
            $this->db->bind(':is_overseas', isset($_POST['is_overseas']) ? 1 : 0);
            $this->db->bind(':has_bike', isset($_POST['has_bike']) ? 1 : 0);
            $this->db->bind(':has_car', isset($_POST['has_car']) ? 1 : 0);
            $this->db->bind(':whatsapp', trim($_POST['whatsapp']));
            $this->db->bind(':employment_type', $_POST['employment_type']);
            $this->db->bind(':company_name', trim($_POST['company_name']));
            $this->db->bind(':company_address', trim($_POST['company_address']));
            $this->db->bind(':monthly_income', $_POST['monthly_income'] ?: 0);
            $this->db->bind(':house_status', $_POST['house_status'] ?? 'None');
            $this->db->bind(':house_size', trim($_POST['house_size'] ?? ''));
            $this->db->bind(':father_income', $_POST['father_income'] ?: 0);
            $this->db->bind(':mother_income', $_POST['mother_income'] ?: 0);
            $this->db->bind(':user_id', $id);

            // New Fields
            $this->db->bind(':father_name', trim($_POST['father_name'] ?? ''));
            $this->db->bind(':cnic', trim($_POST['cnic'] ?? ''));
            $this->db->bind(':weight', trim($_POST['weight'] ?? ''));
            $this->db->bind(':complexion', $_POST['complexion'] ?? '');
            $this->db->bind(':blood_group', $_POST['blood_group'] ?? '');
            $this->db->bind(':degree', trim($_POST['degree'] ?? ''));
            $this->db->bind(':job_title', trim($_POST['job_title'] ?? ''));
            $this->db->bind(':country', trim($_POST['country'] ?? ''));
            $this->db->bind(':father_status', $_POST['father_status'] ?? '');
            $this->db->bind(':mother_status', $_POST['mother_status'] ?? '');
            $this->db->bind(':father_occup', trim($_POST['father_occup'] ?? ''));
            $this->db->bind(':mother_occup', trim($_POST['mother_occup'] ?? ''));
            $this->db->bind(':brothers_count', (int) ($_POST['brothers_count'] ?? 0));
            $this->db->bind(':married_brothers', (int) ($_POST['married_brothers'] ?? 0));
            $this->db->bind(':sisters_count', (int) ($_POST['sisters_count'] ?? 0));
            $this->db->bind(':married_sisters', (int) ($_POST['married_sisters'] ?? 0));
            $this->db->bind(':has_children', $_POST['has_children'] ?? '');
            $this->db->bind(':children_count', (int) ($_POST['children_count'] ?? 0));
            $this->db->bind(':living_with', trim($_POST['living_with'] ?? ''));
            $this->db->bind(':pref_age', trim($_POST['pref_age'] ?? ''));
            $this->db->bind(':pref_height', trim($_POST['pref_height'] ?? ''));
            $this->db->bind(':pref_education', trim($_POST['pref_education'] ?? ''));
            $this->db->bind(':pref_caste', trim($_POST['pref_caste'] ?? ''));
            $this->db->bind(':pref_city', trim($_POST['pref_city'] ?? ''));
            $this->db->bind(':pref_income', trim($_POST['pref_income'] ?? ''));
            $this->db->bind(':pref_others', trim($_POST['pref_others'] ?? ''));
            $this->db->bind(':form_no', trim($_POST['form_no'] ?? ''));
            $this->db->bind(':receipt_no', trim($_POST['receipt_no'] ?? ''));
            $this->db->bind(':fee', !empty($_POST['fee']) ? (float) $_POST['fee'] : 0.0);
            $this->db->bind(':admin_notes', trim($_POST['admin_notes'] ?? ''));

            // Execute the main profile update first
            if (!$this->db->execute()) {
                die('Something went wrong updating the profile');
            }

            // After main update, handle Profile Picture Upload
            if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
                $file = $_FILES['profile_pic'];
                $filename = time() . '_' . $file['name'];
                $target = APPROOT . '/../public/uploads/' . $filename;

                if (move_uploaded_file($file['tmp_name'], $target)) {
                    // Update profile pic in database
                    $this->db->query("UPDATE profiles SET profile_pic = :profile_pic WHERE user_id = :user_id");
                    $this->db->bind(':profile_pic', $filename);
                    $this->db->bind(':user_id', $id);
                    $this->db->execute();
                }
            }

            // Handle Admin Signature Upload
            if (isset($_FILES['admin_signature']) && $_FILES['admin_signature']['error'] === 0) {
                $file = $_FILES['admin_signature'];
                $filename = 'sig_' . time() . '_' . $file['name'];
                $target = APPROOT . '/../public/uploads/signatures/' . $filename;

                // Create directory if not exists
                if (!is_dir(APPROOT . '/../public/uploads/signatures/')) {
                    mkdir(APPROOT . '/../public/uploads/signatures/', 0777, true);
                }

                if (move_uploaded_file($file['tmp_name'], $target)) {
                    $this->db->query("UPDATE profiles SET admin_signature = :sig WHERE user_id = :user_id");
                    $this->db->bind(':sig', $filename);
                    $this->db->bind(':user_id', $id);
                    $this->db->execute();
                }
            }

            // Update/Assign Package if changed
            if (!empty($_POST['package_id'])) {
                $current_sub = $this->subscriptionModel->getUserSubscription($id);
                if (!$current_sub || $current_sub->package_id != $_POST['package_id'] || $current_sub->status != 'active') {
                    $this->subscriptionModel->assignPackage($id, $_POST['package_id']);
                }
            }

            flash('admin_message', 'User profile updated successfully');
            redirect('admin/users');
        } else {
            // Get user data - Use specific user_id alias to avoid conflict with profiles.id
            $this->db->query("SELECT u.*, p.*, u.id as user_id FROM users u LEFT JOIN profiles p ON u.id = p.user_id WHERE u.id = :id");
            $this->db->bind(':id', $id);
            $user = $this->db->single();

            $packages = $this->packageModel->getPackages();
            $subscription = $this->subscriptionModel->getUserSubscription($id);

            $data = [
                'user' => $user,
                'packages' => $packages,
                'subscription' => $subscription
            ];

            $this->view('admin/edit_user', $data);
        }
    }

    public function delete_user($id)
    {
        $this->db->query("DELETE FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            flash('admin_message', 'User deleted');
            redirect('admin/users');
        }
    }

    public function verified($id)
    {
        $this->db->query("UPDATE users SET is_verified = !is_verified WHERE id = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            flash('admin_message', 'User verification status toggled');
            redirect('admin/users');
        }
    }

    public function subscriptions()
    {
        $subscriptions = $this->subscriptionModel->getPendingSubscriptions();

        $data = [
            'subscriptions' => $subscriptions
        ];

        $this->view('admin/subscriptions', $data);
    }

    public function confirm_subscription($id)
    {
        if ($this->subscriptionModel->activate($id)) {
            flash('admin_message', 'Subscription activated successfully');
            redirect('admin/subscriptions');
        } else {
            die('Something went wrong');
        }
    }

    public function reject_subscription($id)
    {
        if ($this->subscriptionModel->reject($id)) {
            flash('admin_message', 'Subscription request rejected');
            redirect('admin/subscriptions');
        } else {
            die('Something went wrong');
        }
    }
}

