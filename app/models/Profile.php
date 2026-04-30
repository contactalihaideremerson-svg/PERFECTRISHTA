<?php
class Profile
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get Profile by User ID
    public function getProfileByUserId($user_id)
    {
        $this->db->query('SELECT * FROM profiles WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        $row = $this->db->single();

        return $row;
    }

    // Update or Create Profile
    public function updateProfile($data)
    {
        // Check if profile exists
        $this->db->query('SELECT id FROM profiles WHERE user_id = :user_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Update
            $this->db->query('UPDATE profiles SET 
                bio = :bio, dob = :dob, gender = :gender, city = :city, country = :country, 
                religion = :religion, sect = :sect, caste = :caste, marital_status = :marital_status, 
                education = :education, degree = :degree, occupation = :occupation, job_title = :job_title, 
                age = :age, height = :height, weight = :weight, skin_color = :skin_color, 
                complexion = :complexion, blood_group = :blood_group, physique = :physique, 
                disability = :disability, father_name = :father_name, cnic = :cnic, 
                permanent_address = :permanent_address, temporary_address = :temporary_address, 
                whatsapp = :whatsapp, is_overseas = :is_overseas, has_bike = :has_bike, has_car = :has_car, 
                employment_type = :employment_type, company_name = :company_name, company_address = :company_address, 
                monthly_income = :monthly_income, father_income = :father_income, mother_income = :mother_income,
                father_status = :father_status, mother_status = :mother_status, father_occup = :father_occup, 
                mother_occup = :mother_occup, brothers_count = :brothers_count, married_brothers = :married_brothers, 
                sisters_count = :sisters_count, married_sisters = :married_sisters, has_children = :has_children, 
                children_count = :children_count, living_with = :living_with, pref_age = :pref_age, 
                pref_height = :pref_height, pref_education = :pref_education, pref_caste = :pref_caste, 
                pref_city = :pref_city, pref_income = :pref_income, pref_others = :pref_others, 
                form_no = :form_no, receipt_no = :receipt_no, fee = :fee, 
                admin_signature = :admin_signature, admin_notes = :admin_notes,
                house_status = :house_status, house_size = :house_size
                WHERE user_id = :user_id');
        } else {
            $this->db->query('INSERT INTO profiles (
                user_id, father_name, cnic, bio, dob, gender, city, country, religion, sect, caste, 
                marital_status, education, degree, occupation, job_title, age, height, weight, 
                skin_color, complexion, blood_group, physique, disability, permanent_address, 
                temporary_address, whatsapp, is_overseas, has_bike, has_car, employment_type, 
                company_name, company_address, monthly_income, father_income, mother_income,
                father_status, mother_status, father_occup, mother_occup, brothers_count, 
                married_brothers, sisters_count, married_sisters, has_children, children_count, 
                living_with, pref_age, pref_height, pref_education, pref_caste, pref_city, 
                pref_income, pref_others, form_no, receipt_no, fee, admin_signature, admin_notes,
                house_status, house_size
            ) VALUES (
                :user_id, :father_name, :cnic, :bio, :dob, :gender, :city, :country, :religion, :sect, :caste, 
                :marital_status, :education, :degree, :occupation, :job_title, :age, :height, :weight, 
                :skin_color, :complexion, :blood_group, :physique, :disability, :permanent_address, 
                :temporary_address, :whatsapp, :is_overseas, :has_bike, :has_car, :employment_type, 
                :company_name, :company_address, :monthly_income, :father_income, :mother_income,
                :father_status, :mother_status, :father_occup, :mother_occup, :brothers_count, 
                :married_brothers, :sisters_count, :married_sisters, :has_children, :children_count, 
                :living_with, :pref_age, :pref_height, :pref_education, :pref_caste, :pref_city, 
                :pref_income, :pref_others, :form_no, :receipt_no, :fee, :admin_signature, :admin_notes,
                :house_status, :house_size
            )');
        }

        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':father_name', $data['father_name']);
        $this->db->bind(':cnic', $data['cnic']);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':country', $data['country']);
        $this->db->bind(':religion', $data['religion']);
        $this->db->bind(':sect', $data['sect']);
        $this->db->bind(':caste', $data['caste']);
        $this->db->bind(':marital_status', $data['marital_status']);
        $this->db->bind(':education', $data['education']);
        $this->db->bind(':degree', $data['degree']);
        $this->db->bind(':occupation', $data['occupation']);
        $this->db->bind(':job_title', $data['job_title']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':height', $data['height']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':skin_color', $data['skin_color']);
        $this->db->bind(':complexion', $data['complexion']);
        $this->db->bind(':blood_group', $data['blood_group']);
        $this->db->bind(':physique', $data['physique']);
        $this->db->bind(':disability', $data['disability']);
        $this->db->bind(':permanent_address', $data['permanent_address']);
        $this->db->bind(':temporary_address', $data['temporary_address']);
        $this->db->bind(':whatsapp', $data['whatsapp']);
        $this->db->bind(':is_overseas', $data['is_overseas']);
        $this->db->bind(':has_bike', $data['has_bike']);
        $this->db->bind(':has_car', $data['has_car']);
        $this->db->bind(':employment_type', $data['employment_type']);
        $this->db->bind(':company_name', $data['company_name']);
        $this->db->bind(':company_address', $data['company_address']);
        $this->db->bind(':monthly_income', $data['monthly_income']);
        $this->db->bind(':father_income', $data['father_income']);
        $this->db->bind(':mother_income', $data['mother_income']);
        $this->db->bind(':father_status', $data['father_status']);
        $this->db->bind(':mother_status', $data['mother_status']);
        $this->db->bind(':father_occup', $data['father_occup']);
        $this->db->bind(':mother_occup', $data['mother_occup']);
        $this->db->bind(':brothers_count', $data['brothers_count']);
        $this->db->bind(':married_brothers', $data['married_brothers']);
        $this->db->bind(':sisters_count', $data['sisters_count']);
        $this->db->bind(':married_sisters', $data['married_sisters']);
        $this->db->bind(':has_children', $data['has_children']);
        $this->db->bind(':children_count', $data['children_count']);
        $this->db->bind(':living_with', $data['living_with']);
        $this->db->bind(':pref_age', $data['pref_age']);
        $this->db->bind(':pref_height', $data['pref_height']);
        $this->db->bind(':pref_education', $data['pref_education']);
        $this->db->bind(':pref_caste', $data['pref_caste']);
        $this->db->bind(':pref_city', $data['pref_city']);
        $this->db->bind(':pref_income', $data['pref_income']);
        $this->db->bind(':pref_others', $data['pref_others']);
        $this->db->bind(':form_no', $data['form_no']);
        $this->db->bind(':receipt_no', $data['receipt_no']);
        $this->db->bind(':fee', $data['fee']);
        $this->db->bind(':admin_signature', $data['admin_signature']);
        $this->db->bind(':admin_notes', $data['admin_notes']);
        $this->db->bind(':house_status', $data['house_status']);
        $this->db->bind(':house_size', $data['house_size']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update Profile Pic
    public function updateProfilePic($user_id, $filename)
    {
        $this->db->query('UPDATE profiles SET profile_pic = :profile_pic WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':profile_pic', $filename);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Search Profiles
    public function searchProfiles($filters)
    {
        $sql = 'SELECT u.id as user_id, u.name, u.created_at, p.*, 
                       s.status as subscription_status, pk.name as package_name
                FROM users u 
                LEFT JOIN profiles p ON u.id = p.user_id 
                LEFT JOIN subscriptions s ON u.id = s.user_id AND s.status = "active"
                LEFT JOIN packages pk ON s.package_id = pk.id
                WHERE u.role = "user" AND u.status = "active"';

        // Add filters...
        if (!empty($filters['gender'])) {
            $sql .= ' AND p.gender = :gender';
        }
        if (!empty($filters['city'])) {
            $sql .= ' AND p.city = :city';
        }
        if (!empty($filters['religion'])) {
            $sql .= ' AND p.religion = :religion';
        }
        if (!empty($filters['marital_status'])) {
            $sql .= ' AND p.marital_status = :marital_status';
        }
        if (!empty($filters['education'])) {
            $sql .= ' AND p.education = :education';
        }
        if (!empty($filters['min_age'])) {
            $sql .= ' AND p.age >= :min_age';
        }
        if (!empty($filters['max_age'])) {
            $sql .= ' AND p.age <= :max_age';
        }

        $sql .= ' ORDER BY u.created_at DESC';

        if (isset($filters['limit'])) {
            $sql .= ' LIMIT :limit';
        }

        if (isset($filters['offset'])) {
            $sql .= ' OFFSET :offset';
        }

        $this->db->query($sql);

        if (isset($filters['limit'])) {
            $this->db->bind(':limit', (int) $filters['limit']);
        }

        if (isset($filters['offset'])) {
            $this->db->bind(':offset', (int) $filters['offset']);
        }

        if (!empty($filters['gender']))
            $this->db->bind(':gender', $filters['gender']);
        if (!empty($filters['city']))
            $this->db->bind(':city', $filters['city']);
        if (!empty($filters['religion']))
            $this->db->bind(':religion', $filters['religion']);
        if (!empty($filters['marital_status']))
            $this->db->bind(':marital_status', $filters['marital_status']);
        if (!empty($filters['education']))
            $this->db->bind(':education', $filters['education']);
        if (!empty($filters['min_age']))
            $this->db->bind(':min_age', $filters['min_age']);
        if (!empty($filters['max_age']))
            $this->db->bind(':max_age', $filters['max_age']);

        return $this->db->resultSet();
    }

    // Get Total Profiles Count for Pagination
    public function getTotalProfiles($filters = [])
    {
        $sql = 'SELECT COUNT(u.id) as total 
                FROM users u 
                LEFT JOIN profiles p ON u.id = p.user_id 
                WHERE u.role = "user" AND u.status = "active"';

        if (!empty($filters['gender'])) {
            $sql .= ' AND p.gender = :gender';
        }
        if (!empty($filters['city'])) {
            $sql .= ' AND p.city = :city';
        }
        if (!empty($filters['religion'])) {
            $sql .= ' AND p.religion = :religion';
        }
        if (!empty($filters['marital_status'])) {
            $sql .= ' AND p.marital_status = :marital_status';
        }
        if (!empty($filters['education'])) {
            $sql .= ' AND p.education = :education';
        }
        if (!empty($filters['min_age'])) {
            $sql .= ' AND p.age >= :min_age';
        }
        if (!empty($filters['max_age'])) {
            $sql .= ' AND p.age <= :max_age';
        }

        $this->db->query($sql);

        if (!empty($filters['gender']))
            $this->db->bind(':gender', $filters['gender']);
        if (!empty($filters['city']))
            $this->db->bind(':city', $filters['city']);
        if (!empty($filters['religion']))
            $this->db->bind(':religion', $filters['religion']);
        if (!empty($filters['marital_status']))
            $this->db->bind(':marital_status', $filters['marital_status']);
        if (!empty($filters['education']))
            $this->db->bind(':education', $filters['education']);
        if (!empty($filters['min_age']))
            $this->db->bind(':min_age', $filters['min_age']);
        if (!empty($filters['max_age']))
            $this->db->bind(':max_age', $filters['max_age']);

        $row = $this->db->single();
        return $row->total;
    }
}
