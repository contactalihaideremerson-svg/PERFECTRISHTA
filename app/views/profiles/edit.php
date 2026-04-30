<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-5xl mx-auto px-4 py-10">
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-pink-50">
            <h2 class="text-2xl font-bold text-gray-900">Personalize Your Profile</h2>
            <p class="text-gray-600">Complete your details to find the best life partner matches based on your
                preferences.</p>
        </div>

        <div class="p-8">
            <form action="<?php echo URLROOT; ?>/profiles/edit" method="POST" enctype="multipart/form-data"
                class="space-y-12">

                <!-- Profile Pic Section -->
                <div class="flex flex-col items-center mb-10">
                    <div class="relative group">
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo ($data['profile']) ? $data['profile']->profile_pic : 'default.png'; ?>"
                            class="w-40 h-40 rounded-3xl object-cover border-4 border-white shadow-xl mb-2"
                            id="preview">
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                            <label for="profile_pic"
                                class="bg-black/50 text-white rounded-3xl w-40 h-40 flex items-center justify-center cursor-pointer">
                                <i class="fas fa-camera text-3xl"></i>
                            </label>
                            <input type="file" name="profile_pic" id="profile_pic" class="hidden">
                        </div>
                    </div>
                    <p class="text-xs font-bold text-pink-600 uppercase tracking-wider mt-2">Change Profile Photo</p>
                </div>

                <!-- SECTION 1 — Basic Info -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center border-b pb-2">
                        <span
                            class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                        Basic Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="<?php echo $data['user']->name; ?>" required
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Father Name</label>
                            <input type="text" name="father_name"
                                value="<?php echo $data['profile']->father_name ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">CNIC Number</label>
                            <input type="text" name="cnic" value="<?php echo $data['profile']->cnic ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                            <select name="gender"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="male" <?php echo ($data['profile'] && $data['profile']->gender == 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo ($data['profile'] && $data['profile']->gender == 'female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" name="dob"
                                value="<?php echo ($data['profile']) ? $data['profile']->dob : ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Marital Status</label>
                            <select name="marital_status"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="Single" <?php echo ($data['profile'] && $data['profile']->marital_status == 'Single') ? 'selected' : ''; ?>>Single</option>
                                <option value="Divorced" <?php echo ($data['profile'] && $data['profile']->marital_status == 'Divorced') ? 'selected' : ''; ?>>Divorced
                                </option>
                                <option value="Widow" <?php echo ($data['profile'] && $data['profile']->marital_status == 'Widow') ? 'selected' : ''; ?>>Widow</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Religion</label>
                            <select name="religion"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <?php foreach (getPakistaniReligions() as $r): ?>
                                    <option value="<?php echo $r; ?>" <?php echo ($data['profile'] && $data['profile']->religion == $r) ? 'selected' : ''; ?>><?php echo $r; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Sect</label>
                            <select name="sect"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <?php foreach (getPakistaniSects() as $s): ?>
                                    <option value="<?php echo $s; ?>" <?php echo ($data['profile'] && $data['profile']->sect == $s) ? 'selected' : ''; ?>><?php echo $s; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Caste / Family</label>
                            <select name="caste"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="">Select Caste</option>
                                <?php foreach (getPakistaniCastes() as $c): ?>
                                    <option value="<?php echo $c; ?>" <?php echo ($data['profile'] && $data['profile']->caste == $c) ? 'selected' : ''; ?>><?php echo $c; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Height</label>
                            <input type="text" name="height" value="<?php echo $data['profile']->height ?? ''; ?>"
                                placeholder="e.g. 5'8\"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Weight (kg)</label>
                            <input type="text" name="weight" value="<?php echo $data['profile']->weight ?? ''; ?>"
                                placeholder="e.g. 70kg"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Skin Color (Tag)</label>
                            <select name="skin_color"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="white" <?php echo ($data['profile'] && $data['profile']->skin_color == 'white') ? 'selected' : ''; ?>>White</option>
                                <option value="brown" <?php echo ($data['profile'] && $data['profile']->skin_color == 'brown') ? 'selected' : ''; ?>>Brown</option>
                                <option value="black" <?php echo ($data['profile'] && $data['profile']->skin_color == 'black') ? 'selected' : ''; ?>>Black</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Complexion (Desc)</label>
                            <select name="complexion"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="Fair" <?php echo ($data['profile'] && $data['profile']->complexion == 'Fair') ? 'selected' : ''; ?>>Fair</option>
                                <option value="Wheatish" <?php echo ($data['profile'] && $data['profile']->complexion == 'Wheatish') ? 'selected' : ''; ?>>Wheatish</option>
                                <option value="Dark" <?php echo ($data['profile'] && $data['profile']->complexion == 'Dark') ? 'selected' : ''; ?>>Dark</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Physique</label>
                            <select name="physique"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="smart" <?php echo ($data['profile'] && $data['profile']->physique == 'smart') ? 'selected' : ''; ?>>Smart</option>
                                <option value="normal" <?php echo ($data['profile'] && $data['profile']->physique == 'normal') ? 'selected' : ''; ?>>Normal</option>
                                <option value="chubby" <?php echo ($data['profile'] && $data['profile']->physique == 'chubby') ? 'selected' : ''; ?>>Chubby</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Blood Group</label>
                            <select name="blood_group"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="">Unknown</option>
                                <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg): ?>
                                    <option value="<?php echo $bg; ?>" <?php echo ($data['profile'] && $data['profile']->blood_group == $bg) ? 'selected' : ''; ?>><?php echo $bg; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Disability</label>
                            <input type="text" name="disability"
                                value="<?php echo $data['profile']->disability ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Bio / Additional Info</label>
                        <textarea name="bio" rows="3"
                            class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"
                            placeholder="Tell us a bit about yourself..."><?php echo $data['profile']->bio ?? ''; ?></textarea>
                    </div>
                </div>

                <!-- SECTION 2 — Education & Career -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center border-b pb-2">
                        <span
                            class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                        Education & Career
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Latest Education</label>
                            <input type="text" name="education" value="<?php echo $data['profile']->education ?? ''; ?>"
                                placeholder="e.g. Master's"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Major Degree</label>
                            <input type="text" name="degree" value="<?php echo $data['profile']->degree ?? ''; ?>"
                                placeholder="e.g. Computer Science"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Profession</label>
                            <input type="text" name="occupation"
                                value="<?php echo $data['profile']->occupation ?? ''; ?>"
                                placeholder="e.g. Software Engineer"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                            <input type="text" name="job_title" value="<?php echo $data['profile']->job_title ?? ''; ?>"
                                placeholder="e.g. Senior Developer"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Company Name</label>
                            <input type="text" name="company_name"
                                value="<?php echo $data['profile']->company_name ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Monthly Income</label>
                            <input type="number" name="monthly_income"
                                value="<?php echo (int) ($data['profile']->monthly_income ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Employment Type</label>
                            <select name="employment_type"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="Job" <?php echo ($data['profile'] && $data['profile']->employment_type == 'Job') ? 'selected' : ''; ?>>Job</option>
                                <option value="Business" <?php echo ($data['profile'] && $data['profile']->employment_type == 'Business') ? 'selected' : ''; ?>>Business
                                </option>
                                <option value="Abroad" <?php echo ($data['profile'] && $data['profile']->employment_type == 'Abroad') ? 'selected' : ''; ?>>Abroad</option>
                                <option value="None" <?php echo ($data['profile'] && $data['profile']->employment_type == 'None') ? 'selected' : ''; ?>>None</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">House Status</label>
                            <select name="house_status"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="Personal" <?php echo ($data['profile'] && $data['profile']->house_status == 'Personal') ? 'selected' : ''; ?>>Personal</option>
                                <option value="Rent" <?php echo ($data['profile'] && $data['profile']->house_status == 'Rent') ? 'selected' : ''; ?>>Rent</option>
                                <option value="None" <?php echo ($data['profile'] && $data['profile']->house_status == 'None') ? 'selected' : ''; ?>>None</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">House Size</label>
                            <input type="text" name="house_size"
                                value="<?php echo $data['profile']->house_size ?? ''; ?>"
                                placeholder="e.g. 5 Marla, 10 Marla"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Office Address</label>
                            <input type="text" name="company_address"
                                value="<?php echo $data['profile']->company_address ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                </div>

                <!-- SECTION 3 — Contact & Possessions -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center border-b pb-2">
                        <span
                            class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
                        Contact & Possessions
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mobile Number</label>
                            <input type="text" name="phone" value="<?php echo $data['user']->phone; ?>" required
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp Number</label>
                            <input type="text" name="whatsapp" value="<?php echo $data['profile']->whatsapp ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">City</label>
                            <input type="text" name="city" value="<?php echo $data['profile']->city ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Country</label>
                            <input type="text" name="country"
                                value="<?php echo $data['profile']->country ?? 'Pakistan'; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div class="flex gap-4 items-center mt-8">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="is_overseas" class="rounded text-pink-500" <?php echo ($data['profile'] && $data['profile']->is_overseas) ? 'checked' : ''; ?>>
                                <span class="text-sm font-bold text-gray-700">Overseas?</span>
                            </label>
                        </div>
                        <div class="md:col-span-1 border-l pl-6 flex gap-6 mt-8">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="has_bike" class="rounded text-pink-500" <?php echo ($data['profile'] && $data['profile']->has_bike) ? 'checked' : ''; ?>>
                                <span class="text-sm font-bold text-gray-700">Has Bike?</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="has_car" class="rounded text-pink-500" <?php echo ($data['profile'] && $data['profile']->has_car) ? 'checked' : ''; ?>>
                                <span class="text-sm font-bold text-gray-700">Has Car?</span>
                            </label>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Permanent Home Address</label>
                            <textarea name="permanent_address" rows="2"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"><?php echo $data['profile']->permanent_address ?? ''; ?></textarea>
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Temporary Address (If Any)</label>
                            <textarea name="temporary_address" rows="2"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"><?php echo $data['profile']->temporary_address ?? ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4 — Family Details -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center border-b pb-2">
                        <span
                            class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">4</span>
                        Family Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Father Status</label>
                            <select name="father_status"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="Yes" <?php echo ($data['profile'] && $data['profile']->father_status == 'Yes') ? 'selected' : ''; ?>>Alive</option>
                                <option value="No" <?php echo ($data['profile'] && $data['profile']->father_status == 'No') ? 'selected' : ''; ?>>Deceased</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mother Status</label>
                            <select name="mother_status"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="Yes" <?php echo ($data['profile'] && $data['profile']->mother_status == 'Yes') ? 'selected' : ''; ?>>Alive</option>
                                <option value="No" <?php echo ($data['profile'] && $data['profile']->mother_status == 'No') ? 'selected' : ''; ?>>Deceased</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Father Occupation</label>
                            <input type="text" name="father_occup"
                                value="<?php echo $data['profile']->father_occup ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mother Occupation</label>
                            <input type="text" name="mother_occup"
                                value="<?php echo $data['profile']->mother_occup ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Father Income</label>
                            <input type="number" name="father_income"
                                value="<?php echo (int) ($data['profile']->father_income ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mother Income</label>
                            <input type="number" name="mother_income"
                                value="<?php echo (int) ($data['profile']->mother_income ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div class="md:col-span-2"></div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Brothers</label>
                            <input type="number" name="brothers_count"
                                value="<?php echo (int) ($data['profile']->brothers_count ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Married Bros</label>
                            <input type="number" name="married_brothers"
                                value="<?php echo (int) ($data['profile']->married_brothers ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Sisters</label>
                            <input type="number" name="sisters_count"
                                value="<?php echo (int) ($data['profile']->sisters_count ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Married Siss</label>
                            <input type="number" name="married_sisters"
                                value="<?php echo (int) ($data['profile']->married_sisters ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                </div>

                <!-- SECTION 5 — First Marriage Info -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center border-b pb-2">
                        <span
                            class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">5</span>
                        First Marriage Info (optional)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Children?</label>
                            <select name="has_children"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                                <option value="No" <?php echo ($data['profile'] && $data['profile']->has_children == 'No') ? 'selected' : ''; ?>>No</option>
                                <option value="Yes" <?php echo ($data['profile'] && $data['profile']->has_children == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Number of Children</label>
                            <input type="number" name="children_count"
                                value="<?php echo (int) ($data['profile']->children_count ?? 0); ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Children Living With</label>
                            <input type="text" name="living_with"
                                value="<?php echo $data['profile']->living_with ?? ''; ?>"
                                placeholder="e.g. Mother / Father"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                    </div>
                </div>

                <!-- SECTION 6 — Partner Requirements -->
                <div class="space-y-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center border-b pb-2">
                        <span
                            class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">6</span>
                        Partner Requirements
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Age</label>
                            <input type="text" name="pref_age" value="<?php echo $data['profile']->pref_age ?? ''; ?>"
                                placeholder="e.g. 20-25"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Height</label>
                            <input type="text" name="pref_height"
                                value="<?php echo $data['profile']->pref_height ?? ''; ?>" placeholder="e.g. 5'5\"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Education</label>
                            <input type="text" name="pref_education"
                                value="<?php echo $data['profile']->pref_education ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Caste</label>
                            <input type="text" name="pref_caste"
                                value="<?php echo $data['profile']->pref_caste ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Preferred City</label>
                            <input type="text" name="pref_city" value="<?php echo $data['profile']->pref_city ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Income Range</label>
                            <input type="text" name="pref_income"
                                value="<?php echo $data['profile']->pref_income ?? ''; ?>"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
                        </div>
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Other Requirements</label>
                            <textarea name="pref_others" rows="3"
                                class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500"
                                placeholder="Specify any other demands..."><?php echo $data['profile']->pref_others ?? ''; ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 7 — Bureau Office Info (Admin Only) -->
                <?php if ($_SESSION['user_role'] == 'admin'): ?>
                    <div class="space-y-6 bg-gray-900 p-8 rounded-3xl text-white">
                        <h3 class="text-lg font-bold flex items-center border-b border-white/10 pb-4">
                            <i class="fas fa-user-shield mr-3 text-red-500"></i> Bureau Office Info (OFFICIAL USE ONLY)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Form No.</label>
                                <input type="text" name="form_no" value="<?php echo $data['profile']->form_no ?? ''; ?>"
                                    class="w-full rounded-xl bg-white/5 border-white/10 text-white focus:border-red-500 focus:ring-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Receipt No.</label>
                                <input type="text" name="receipt_no"
                                    value="<?php echo $data['profile']->receipt_no ?? ''; ?>"
                                    class="w-full rounded-xl bg-white/5 border-white/10 text-white focus:border-red-500 focus:ring-red-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 mb-2">Paid Fee (PKR)</label>
                                <input type="number" name="fee" value="<?php echo (float) ($data['profile']->fee ?? 0); ?>"
                                    class="w-full rounded-xl bg-white/5 border-white/10 text-white focus:border-red-500 focus:ring-red-500">
                            </div>
                            <div class="md:col-span-1">
                                <label class="block text-sm font-bold text-gray-400 mb-2">Admin Signature</label>
                                <?php if (!empty($data['profile']->admin_signature)): ?>
                                    <div class="bg-white p-2 rounded inline-block mb-2">
                                        <img src="<?php echo URLROOT; ?>/uploads/signatures/<?php echo $data['profile']->admin_signature; ?>"
                                            class="h-10">
                                    </div>
                                <?php endif; ?>
                                <input type="file" name="admin_signature" class="w-full text-xs text-gray-400">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-400 mb-2">Admin Notes</label>
                                <textarea name="admin_notes" rows="2"
                                    class="w-full rounded-xl bg-white/5 border-white/10 text-white focus:border-red-500 focus:ring-red-500"><?php echo $data['profile']->admin_notes ?? ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-pink-600 text-white py-5 rounded-3xl font-bold text-xl hover:bg-pink-700 transition shadow-xl shadow-pink-200 uppercase tracking-widest">
                        Save Detailed Profile
                    </button>
                    <p class="text-center text-gray-400 text-xs mt-4 italic">By clicking save, you verify that all
                        information provided is accurate and truthful.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('profile_pic').onchange = function (evt) {
        var [file] = this.files;
        if (file) {
            document.getElementById('preview').src = URL.createObjectURL(file);
        }
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>