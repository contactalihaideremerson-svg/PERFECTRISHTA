<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Add New User'); ?>

<div class="mb-8">
    <a href="<?php echo URLROOT; ?>/admin/users" class="text-pink-600 text-sm font-bold"><i
            class="fas fa-arrow-left mr-2"></i> Back to User Management</a>
    <h1 class="text-2xl font-bold text-gray-900 mt-2">Create New User Profile</h1>
</div>

<form action="<?php echo URLROOT; ?>/admin/add_user" method="POST" enctype="multipart/form-data"
    class="space-y-8 pb-20">

    <!-- SECTION 1 — Account & Basic Info -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
            Account & Basic Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="md:col-span-1">
                <label class="block text-sm font-bold text-gray-700 mb-2">Profile Picture</label>
                <input type="file" name="profile_pic" class="w-full text-xs">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" required class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" required class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mobile Number</label>
                <input type="text" name="phone" required class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full rounded-xl border-gray-200">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Name</label>
                <input type="text" name="father_name" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">CNIC Number</label>
                <input type="text" name="cnic" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                <select name="gender" class="w-full rounded-xl border-gray-200">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="dob" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Age</label>
                <input type="number" name="age" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Marital Status</label>
                <select name="marital_status" class="w-full rounded-xl border-gray-200">
                    <option value="Single">Single</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widow">Widow</option>
                    <option value="2nd Marriage">2nd Marriage</option>
                    <option value="3rd Marriage">3rd Marriage</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Religion</label>
                <select name="religion" class="w-full rounded-xl border-gray-200">
                    <?php foreach (getPakistaniReligions() as $r): ?>
                        <option value="<?php echo $r; ?>"><?php echo $r; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Sect</label>
                <select name="sect" class="w-full rounded-xl border-gray-200">
                    <?php foreach (getPakistaniSects() as $s): ?>
                        <option value="<?php echo $s; ?>"><?php echo $s; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Caste</label>
                <select name="caste" id="caste-select" class="w-full rounded-xl border-gray-200"
                    onchange="toggleCustomCaste()">
                    <option value="">Select Caste</option>
                    <?php foreach (getPakistaniCastes() as $c): ?>
                        <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="custom-caste-container" class="mt-2 hidden">
                    <input type="text" name="caste_custom" id="caste-custom" placeholder="Enter custom caste"
                        class="w-full rounded-xl border-gray-200">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Height</label>
                <input type="text" name="height" placeholder="e.g. 5'8\" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Weight</label>
                <input type="text" name="weight" placeholder="e.g. 70kg" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Skin Color (Tag)</label>
                <select name="skin_color" class="w-full rounded-xl border-gray-200">
                    <option value="white">White</option>
                    <option value="brown">Brown</option>
                    <option value="black">Black</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Complexion (Desc)</label>
                <select name="complexion" class="w-full rounded-xl border-gray-200">
                    <option value="Fair">Fair</option>
                    <option value="Wheatish">Wheatish</option>
                    <option value="Dark">Dark</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Physique</label>
                <select name="physique" class="w-full rounded-xl border-gray-200">
                    <option value="smart">Smart</option>
                    <option value="normal">Normal</option>
                    <option value="chubby">Chubby</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Blood Group</label>
                <select name="blood_group" class="w-full rounded-xl border-gray-200">
                    <option value="">Unknown</option>
                    <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg): ?>
                        <option value="<?php echo $bg; ?>"><?php echo $bg; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Disability</label>
                <input type="text" name="disability" value="None" class="w-full rounded-xl border-gray-200">
            </div>
        </div>
        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Bio / Additional Info</label>
            <textarea name="bio" rows="3" class="w-full rounded-xl border-gray-200"></textarea>
        </div>
    </div>

    <!-- SECTION 2 — Education & Career -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
            Education & Career
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Education</label>
                <input type="text" name="education" placeholder="e.g. Master's"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Degree</label>
                <input type="text" name="degree" placeholder="e.g. Computer Science"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Occupation</label>
                <input type="text" name="occupation" placeholder="e.g. Software Engineer"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                <input type="text" name="job_title" placeholder="e.g. Senior Developer"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Company Name</label>
                <input type="text" name="company_name" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Monthly Income</label>
                <input type="number" name="monthly_income" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Employment Type</label>
                <select name="employment_type" class="w-full rounded-xl border-gray-200">
                    <option value="Job">Job</option>
                    <option value="Business">Business</option>
                    <option value="Abroad">Abroad</option>
                    <option value="None">None</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">House Status</label>
                <select name="house_status" class="w-full rounded-xl border-gray-200">
                    <option value="Personal">Personal</option>
                    <option value="Rent">Rent</option>
                    <option value="None">None</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">House Size</label>
                <input type="text" name="house_size" placeholder="e.g. 5 Marla, 10 Marla"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Office Address</label>
                <input type="text" name="company_address" class="w-full rounded-xl border-gray-200">
            </div>
        </div>
    </div>

    <!-- SECTION 3 — Contact & Possessions -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
            Contact & Possessions
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp Number</label>
                <input type="text" name="whatsapp" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">City</label>
                <input type="text" name="city" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Country</label>
                <input type="text" name="country" value="Pakistan" class="w-full rounded-xl border-gray-200">
            </div>
            <div class="flex gap-4 items-center mt-8">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="is_overseas" class="rounded text-pink-500">
                    <span class="text-sm font-bold text-gray-700">Overseas?</span>
                </label>
            </div>
            <div class="md:col-span-2 flex gap-4 mt-8">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="has_bike" class="rounded text-pink-500">
                    <span class="text-sm font-bold text-gray-700">Has Bike?</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="has_car" class="rounded text-pink-500">
                    <span class="text-sm font-bold text-gray-700">Has Car?</span>
                </label>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">Permanent Address</label>
                <textarea name="permanent_address" rows="2" class="w-full rounded-xl border-gray-200"></textarea>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">Temporary Address</label>
                <textarea name="temporary_address" rows="2" class="w-full rounded-xl border-gray-200"></textarea>
            </div>
        </div>
    </div>

    <!-- SECTION 4 — Family Details -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">4</span>
            Family Details
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Status</label>
                <select name="father_status" class="w-full rounded-xl border-gray-200">
                    <option value="Yes">Alive</option>
                    <option value="No">Deceased</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mother Status</label>
                <select name="mother_status" class="w-full rounded-xl border-gray-200">
                    <option value="Yes">Alive</option>
                    <option value="No">Deceased</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Occupation</label>
                <input type="text" name="father_occup" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mother Occupation</label>
                <input type="text" name="mother_occup" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Income</label>
                <input type="number" name="father_income" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mother Income</label>
                <input type="number" name="mother_income" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-2"></div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Brothers</label>
                <input type="number" name="brothers_count" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Married Bros</label>
                <input type="number" name="married_brothers" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Sisters</label>
                <input type="number" name="sisters_count" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Married Siss</label>
                <input type="number" name="married_sisters" value="0" class="w-full rounded-xl border-gray-200">
            </div>
        </div>
    </div>

    <!-- SECTION 5 — First Marriage Info -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">5</span>
            First Marriage Info (optional)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Children?</label>
                <select name="has_children" class="w-full rounded-xl border-gray-200">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Number of Children</label>
                <input type="number" name="children_count" value="0" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Children Living With</label>
                <input type="text" name="living_with" placeholder="e.g. Mother / Father"
                    class="w-full rounded-xl border-gray-200">
            </div>
        </div>
    </div>

    <!-- SECTION 6 — Partner Requirement -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">6</span>
            Partner Requirements
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Age</label>
                <input type="text" name="pref_age" placeholder="e.g. 20-25" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Height</label>
                <input type="text" name="pref_height" placeholder="e.g. 5'5\" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Education</label>
                <input type="text" name="pref_education" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Caste</label>
                <input type="text" name="pref_caste" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred City</label>
                <input type="text" name="pref_city" class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Income Range</label>
                <input type="text" name="pref_income" class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">Other Requirements</label>
                <textarea name="pref_others" rows="3" class="w-full rounded-xl border-gray-200"></textarea>
            </div>
        </div>
    </div>

    <!-- SECTION 7 — Bureau Office Info -->
    <div class="bg-gray-900 rounded-3xl shadow-sm p-8 text-white">
        <h3 class="text-lg font-bold mb-6 flex items-center border-b border-white/10 pb-4">
            <span
                class="bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">7</span>
            Bureau Office Info (OFFICIAL)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Form Number</label>
                <input type="text" name="form_no" class="w-full rounded-xl bg-white/5 border-white/10">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Receipt Number</label>
                <input type="text" name="receipt_no" class="w-full rounded-xl bg-white/5 border-white/10">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Application Fee (PKR)</label>
                <input type="number" name="fee" value="0" class="w-full rounded-xl bg-white/5 border-white/10">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Assign Package</label>
                <select name="package_id" class="w-full rounded-xl bg-white/5 border-white/10 text-white">
                    <option value="" class="text-gray-900">-- Select Package --</option>
                    <?php foreach ($data['packages'] as $package): ?>
                        <option value="<?php echo $package->id; ?>" class="text-gray-900">
                            <?php echo $package->name; ?> (PKR <?php echo $package->price; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-400 mb-2">Admin Notes</label>
                <textarea name="admin_notes" rows="2" class="w-full rounded-xl bg-white/5 border-white/10"></textarea>
            </div>
        </div>
    </div>

    <div class="pt-8">
        <button type="submit"
            class="w-full bg-pink-600 text-white py-5 rounded-3xl font-bold text-xl hover:bg-pink-700 transition shadow-xl shadow-pink-200 uppercase tracking-widest">
            Create Full Member Profile
        </button>
    </div>
</form>

<script>
    function toggleCustomCaste() {
        const select = document.getElementById('caste-select');
        const container = document.getElementById('custom-caste-container');
        const customInput = document.getElementById('caste-custom');

        if (select.value === 'Others') {
            container.classList.remove('hidden');
            customInput.setAttribute('required', 'required');
        } else {
            container.classList.add('hidden');
            customInput.removeAttribute('required');
        }
    }
</script>

<?php admin_footer(); ?>