<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Edit User Profile'); ?>

<style>
    /* Default: Hide printable section */
    #printable-profile {
        display: none;
    }

    @media print {

        /* Reset layout restrictions for printing */
        html,
        body,
        .flex.h-screen {
            height: auto !important;
            overflow: visible !important;
            display: block !important;
        }

        main.flex-1 {
            overflow: visible !important;
            display: block !important;
            position: relative !important;
            width: 100% !important;
            height: auto !important;
        }

        aside,
        header,
        .no-print,
        form,
        .mb-8 {
            display: none !important;
        }

        #printable-profile {
            display: block !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #111;
            padding: 0;
            width: 100%;
        }

        body {
            background: white !important;
            margin: 0 !important;
        }

        .p-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #db2777;
            /* pink-600 */
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .p-photo {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 4px solid #fdf2f8;
            border-radius: 15px;
        }

        .p-title h1 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            color: #9d174d;
        }

        .p-title p {
            font-size: 14px;
            margin: 5px 0;
            color: #444;
        }

        .p-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 20px;
        }

        .p-section:last-child {
            border-bottom: none;
        }

        .p-section-title {
            font-size: 16px;
            font-weight: 800;
            text-transform: uppercase;
            background: #fdf2f8;
            color: #db2777;
            padding: 8px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: block;
            border-left: 5px solid #db2777;
        }

        .p-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 40px;
        }

        .p-item {
            display: flex;
            border-bottom: 1px dotted #e5e7eb;
            padding-bottom: 6px;
        }

        .p-label {
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            width: 140px;
            text-transform: uppercase;
        }

        .p-value {
            font-size: 13px;
            font-weight: 600;
            color: #1f2937;
        }

        .p-footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #db2777;
            font-size: 11px;
            text-align: center;
            color: #6b7280;
        }

        .p-signature-box {
            margin-top: 40px;
            text-align: right;
            page-break-inside: avoid;
        }

        .p-sig-img {
            height: 80px;
            display: inline-block;
        }
    }
</style>

<!-- Printable Document -->
<div id="printable-profile">
    <div class="p-header">
        <div class="flex gap-6">
            <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['user']->profile_pic ?: 'default.png'; ?>"
                class="p-photo">
            <div class="p-title">
                <h1><?php echo $data['user']->name ?? ''; ?></h1>
                <p>Profile ID: <strong>PM-<?php echo str_pad($data['user']->user_id ?? '', 5, '0', STR_PAD_LEFT); ?></strong>
                </p>
                <p>Phone: <?php echo $data['user']->phone ?? ''; ?> | WhatsApp:
                    <?php echo $data['user']->whatsapp ?? ''; ?></p>
                <p>Location: <?php echo $data['user']->city ?? ''; ?>,
                    <?php echo $data['user']->country ?? 'Pakistan'; ?></p>
            </div>
        </div>
        <div class="text-right">
            <div class="text-xs font-bold text-gray-400 uppercase">Document Generated</div>
            <div class="text-sm font-bold"><?php echo date('d M, Y'); ?></div>
        </div>
    </div>

    <div class="p-grid-large">
        <!-- Section 1: Basic Info -->
        <div class="p-section">
            <div class="p-section-title">1. Basic Information</div>
            <div class="p-grid">
                <div class="p-item"><span class="p-label">Father Name:</span> <span
                        class="p-value"><?php echo $data['user']->father_name ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">CNIC:</span> <span
                        class="p-value"><?php echo $data['user']->cnic ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Gender / Status:</span> <span
                        class="p-value"><?php echo ucfirst($data['user']->gender ?? ''); ?> /
                        <?php echo $data['user']->marital_status ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">DOB / Age:</span> <span
                        class="p-value"><?php echo $data['user']->dob ?? ''; ?> (<?php echo $data['user']->age ?? ''; ?>
                        Yrs)</span></div>
                <div class="p-item"><span class="p-label">Religion / Sect:</span> <span
                        class="p-value"><?php echo $data['user']->religion ?? ''; ?>
                        (<?php echo $data['user']->sect ?? ''; ?>)</span></div>
                <div class="p-item"><span class="p-label">Caste / Family:</span> <span
                        class="p-value"><?php echo $data['user']->caste ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Height / Weight:</span> <span
                        class="p-value"><?php echo $data['user']->height ?? ''; ?> /
                        <?php echo $data['user']->weight ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Complexion:</span> <span
                        class="p-value"><?php echo $data['user']->complexion ?? ''; ?>
                        (<?php echo $data['user']->skin_color ?? ''; ?>)</span></div>
                <div class="p-item"><span class="p-label">Physique:</span> <span
                        class="p-value"><?php echo ucfirst($data['user']->physique ?? 'Normal'); ?></span></div>
                <div class="p-item"><span class="p-label">Blood / Disability:</span> <span
                        class="p-value"><?php echo $data['user']->blood_group ?? ''; ?> /
                        <?php echo $data['user']->disability ?? ''; ?></span></div>
            </div>
            <?php if (!empty($data['user']->bio)): ?>
                <div class="mt-4 p-3 bg-gray-50 rounded italic text-sm text-gray-700"><strong>About:</strong>
                    <?php echo $data['user']->bio; ?></div>
            <?php endif; ?>
        </div>

        <!-- Section 2: Education & Career -->
        <div class="p-section">
            <div class="p-section-title">2. Education & Career</div>
            <div class="p-grid">
                <div class="p-item"><span class="p-label">Latest Degree:</span> <span
                        class="p-value"><?php echo $data['user']->education ?? ''; ?>
                        (<?php echo $data['user']->degree ?? ''; ?>)</span></div>
                <div class="p-item"><span class="p-label">Profession:</span> <span
                        class="p-value"><?php echo $data['user']->occupation ?? ''; ?>
                        (<?php echo $data['user']->job_title ?? ''; ?>)</span></div>
                <div class="p-item"><span class="p-label">Company:</span> <span
                        class="p-value"><?php echo $data['user']->company_name ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Office Address:</span> <span
                        class="p-value"><?php echo $data['user']->company_address ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Monthly Income:</span> <span class="p-value">PKR
                        <?php echo number_format($data['user']->monthly_income ?? 0); ?></span></div>
                <div class="p-item"><span class="p-label">Emp. Type:</span> <span
                        class="p-value"><?php echo ucfirst($data['user']->employment_type ?? ''); ?></span></div>
                <div class="p-item"><span class="p-label">House:</span> <span
                        class="p-value"><?php echo $data['user']->house_status ?? ''; ?> (<?php echo $data['user']->house_size ?? ''; ?>)</span></div>
            </div>
        </div>

        <!-- Section 3 & 4: Location & Family -->
        <div class="p-section">
            <div class="p-section-title">3. Contact & Family Details</div>
            <div class="p-grid">
                <div class="p-item"><span class="p-label">Permanent Addr:</span> <span
                        class="p-value"><?php echo $data['user']->permanent_address; ?></span></div>
                <div class="p-item"><span class="p-label">Temporary Addr:</span> <span
                        class="p-value"><?php echo $data['user']->temporary_address; ?></span></div>
                <div class="p-item"><span class="p-label">Overseas / Possess:</span> <span
                        class="p-value"><?php echo $data['user']->is_overseas ? 'Yes' : 'No'; ?> (Bike:
                        <?php echo $data['user']->has_bike ? 'Yes' : 'No'; ?>, Car:
                        <?php echo $data['user']->has_car ? 'Yes' : 'No'; ?>)</span></div>
                <div class="p-item"><span class="p-label">Status (F/M):</span> <span class="p-value">F:
                        <?php echo $data['user']->father_status ?? ''; ?> / M:
                        <?php echo $data['user']->mother_status ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Father Occup / Inc:</span> <span
                        class="p-value"><?php echo $data['user']->father_occup ?? ''; ?> (Inv:
                        <?php echo number_format($data['user']->father_income ?? 0); ?>)</span></div>
                <div class="p-item"><span class="p-label">Mother Occup / Inc:</span> <span
                        class="p-value"><?php echo $data['user']->mother_occup ?? ''; ?> (Inv:
                        <?php echo number_format($data['user']->mother_income ?? 0); ?>)</span></div>
                <div class="p-item"><span class="p-label">Brothers:</span> <span
                        class="p-value"><?php echo $data['user']->brothers_count ?? 0; ?> (Married:
                        <?php echo $data['user']->married_brothers ?? 0; ?>)</span></div>
                <div class="p-item"><span class="p-label">Sisters:</span> <span
                        class="p-value"><?php echo $data['user']->sisters_count ?? 0; ?> (Married:
                        <?php echo $data['user']->married_sisters ?? 0; ?>)</span></div>
            </div>
        </div>

        <!-- Section 5: Marriage Info -->
        <?php if ($data['user']->marital_status != 'Single'): ?>
            <div class="p-section">
                <div class="p-section-title">4. Past Marriage / Children</div>
                <div class="p-grid">
                    <div class="p-item"><span class="p-label">Has Children:</span> <span
                            class="p-value"><?php echo $data['user']->has_children; ?></span></div>
                    <div class="p-item"><span class="p-label">Children Count:</span> <span
                            class="p-value"><?php echo $data['user']->children_count; ?></span></div>
                    <div class="p-item"><span class="p-label">Living With:</span> <span
                            class="p-value"><?php echo $data['user']->living_with; ?></span></div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Section 6: Partner Requirements -->
        <div class="p-section">
            <div class="p-section-title">5. Partner Preferences</div>
            <div class="p-grid">
                <div class="p-item"><span class="p-label">Age Pref:</span> <span
                        class="p-value"><?php echo $data['user']->pref_age; ?></span></div>
                <div class="p-item"><span class="p-label">Height Pref:</span> <span
                        class="p-value"><?php echo $data['user']->pref_height; ?></span></div>
                <div class="p-item"><span class="p-label">Education Pref:</span> <span
                        class="p-value"><?php echo $data['user']->pref_education; ?></span></div>
                <div class="p-item"><span class="p-label">Caste Pref:</span> <span
                        class="p-value"><?php echo $data['user']->pref_caste; ?></span></div>
                <div class="p-item"><span class="p-label">City Pref:</span> <span
                        class="p-value"><?php echo $data['user']->pref_city; ?></span></div>
                <div class="p-item"><span class="p-label">Income Pref:</span> <span
                        class="p-value"><?php echo $data['user']->pref_income; ?></span></div>
            </div>
            <div class="mt-4 text-sm text-gray-600 italic">"<?php echo $data['user']->pref_others; ?>"</div>
        </div>

        <!-- Section 7: Office Info (Official) -->
        <div class="p-section" style="border: 2px solid #eee; padding: 15px; border-radius: 10px;">
            <div class="p-section-title" style="background: #111; color: white;">6. Official Registration Details</div>
            <div class="p-grid">
                <div class="p-item"><span class="p-label">Form Number:</span> <span
                        class="p-value"><?php echo $data['user']->form_no ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Receipt No:</span> <span
                        class="p-value"><?php echo $data['user']->receipt_no ?? ''; ?></span></div>
                <div class="p-item"><span class="p-label">Paid Fee:</span> <span class="p-value">PKR
                        <?php echo number_format($data['user']->fee ?? 0); ?></span></div>
                <div class="p-item"><span class="p-label">Officer Notes:</span> <span
                        class="p-value"><?php echo $data['user']->admin_notes ?? ''; ?></span></div>
            </div>
            <div class="p-signature-box">
                <div class="text-xs font-bold text-gray-400 mb-2">AUTHORIZED SIGNATURE</div>
                <?php if (!empty($data['user']->admin_signature)): ?>
                    <img src="<?php echo URLROOT; ?>/uploads/signatures/<?php echo $data['user']->admin_signature; ?>"
                        class="p-sig-img">
                <?php else: ?>
                    <div class="h-10 border-b border-gray-400 inline-block w-40"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="p-footer">
        This document is an official record of Perfect Rishta Matrimonial Bureau. Any tampering is illegal.
        <br>Perfect Match (Pvt) Ltd. — © <?php echo date('Y'); ?>
    </div>
</div>

<!-- Screen Content -->
<div class="mb-8 flex justify-between items-start no-print">
    <div>
        <a href="<?php echo URLROOT; ?>/admin/users" class="text-pink-600 text-sm font-bold"><i
                class="fas fa-arrow-left mr-2"></i> Back to User Management</a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Manage Profile: <?php echo $data['user']->name; ?></h1>
    </div>
    <div class="flex gap-4">
        <button onclick="window.print()"
            class="bg-gray-800 text-white px-6 py-3 rounded-xl font-bold hover:bg-black transition shadow-lg">
            <i class="fas fa-print mr-2"></i> PRINT PROFILE
        </button>
    </div>
</div>

<form action="<?php echo URLROOT; ?>/admin/edit_user/<?php echo $data['user']->user_id; ?>" method="POST"
    enctype="multipart/form-data" class="space-y-8 pb-20 no-print">

    <!-- SECTION 1 — Basic Info -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
            Basic Information
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="flex items-center gap-4 md:col-span-1">
                <img src="<?php echo URLROOT; ?>/uploads/<?php echo $data['user']->profile_pic ?: 'default.png'; ?>"
                    class="w-16 h-16 rounded-xl object-cover border-2 border-pink-100">
                <div class="flex-1">
                    <label class="block text-xs font-bold text-gray-500 mb-1">Update Photo</label>
                    <input type="file" name="profile_pic" class="w-full text-xs">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                <input type="text" name="name" value="<?php echo $data['user']->name; ?>" required
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="<?php echo $data['user']->email; ?>" required
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mobile Number</label>
                <input type="text" name="phone" value="<?php echo $data['user']->phone; ?>" required
                    class="w-full rounded-xl border-gray-200">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Name</label>
                <input type="text" name="father_name" value="<?php echo $data['user']->father_name; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">CNIC</label>
                <input type="text" name="cnic" value="<?php echo $data['user']->cnic; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Gender</label>
                <select name="gender" class="w-full rounded-xl border-gray-200">
                    <option value="male" <?php echo ($data['user']->gender == 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($data['user']->gender == 'female') ? 'selected' : ''; ?>>Female
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Date of Birth</label>
                <input type="date" name="dob" value="<?php echo $data['user']->dob; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Age</label>
                <input type="number" name="age" value="<?php echo $data['user']->age; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Marital Status</label>
                <select name="marital_status" class="w-full rounded-xl border-gray-200">
                    <option value="Single" <?php echo ($data['user']->marital_status == 'Single') ? 'selected' : ''; ?>>Single</option>
                    <option value="Divorced" <?php echo ($data['user']->marital_status == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                    <option value="Widow" <?php echo ($data['user']->marital_status == 'Widow') ? 'selected' : ''; ?>>Widow</option>
                    <option value="2nd Marriage" <?php echo ($data['user']->marital_status == '2nd Marriage') ? 'selected' : ''; ?>>2nd Marriage</option>
                    <option value="3rd Marriage" <?php echo ($data['user']->marital_status == '3rd Marriage') ? 'selected' : ''; ?>>3rd Marriage</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Religion</label>
                <select name="religion" class="w-full rounded-xl border-gray-200">
                    <?php foreach (getPakistaniReligions() as $r): ?>
                        <option value="<?php echo $r; ?>" <?php echo ($data['user']->religion == $r) ? 'selected' : ''; ?>>
                            <?php echo $r; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Sect</label>
                <select name="sect" class="w-full rounded-xl border-gray-200">
                    <?php foreach (getPakistaniSects() as $s): ?>
                        <option value="<?php echo $s; ?>" <?php echo ($data['user']->sect == $s) ? 'selected' : ''; ?>>
                            <?php echo $s; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Caste</label>
                <?php 
                    $castes = getPakistaniCastes();
                    $current_caste = $data['user']->caste ?? '';
                    $is_custom = !empty($current_caste) && !in_array($current_caste, $castes);
                ?>
                <select name="caste" id="caste-select" class="w-full rounded-xl border-gray-200" onchange="toggleCustomCaste()">
                    <?php foreach ($castes as $c): ?>
                        <option value="<?php echo $c; ?>" <?php echo ($current_caste == $c || ($c == 'Others' && $is_custom)) ? 'selected' : ''; ?>>
                            <?php echo $c; ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="custom-caste-container" class="mt-2 <?php echo $is_custom ? '' : 'hidden'; ?>">
                    <input type="text" name="caste_custom" id="caste-custom" value="<?php echo $is_custom ? $current_caste : ''; ?>" placeholder="Enter custom caste" class="w-full rounded-xl border-gray-200">
                </div>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Height</label>
                <input type="text" name="height" value="<?php echo $data['user']->height; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Weight</label>
                <input type="text" name="weight" value="<?php echo $data['user']->weight; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Skin Color (Tag)</label>
                <select name="skin_color" class="w-full rounded-xl border-gray-200">
                    <option value="white" <?php echo ($data['user']->skin_color == 'white') ? 'selected' : ''; ?>>White
                    </option>
                    <option value="brown" <?php echo ($data['user']->skin_color == 'brown') ? 'selected' : ''; ?>>Brown
                    </option>
                    <option value="black" <?php echo ($data['user']->skin_color == 'black') ? 'selected' : ''; ?>>Black
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Complexion (Desc)</label>
                <select name="complexion" class="w-full rounded-xl border-gray-200">
                    <option value="Fair" <?php echo ($data['user']->complexion == 'Fair') ? 'selected' : ''; ?>>Fair
                    </option>
                    <option value="Wheatish" <?php echo ($data['user']->complexion == 'Wheatish') ? 'selected' : ''; ?>>
                        Wheatish</option>
                    <option value="Dark" <?php echo ($data['user']->complexion == 'Dark') ? 'selected' : ''; ?>>Dark
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Physique</label>
                <select name="physique" class="w-full rounded-xl border-gray-200">
                    <option value="smart" <?php echo ($data['user']->physique == 'smart') ? 'selected' : ''; ?>>Smart
                    </option>
                    <option value="normal" <?php echo ($data['user']->physique == 'normal') ? 'selected' : ''; ?>>Normal
                    </option>
                    <option value="chubby" <?php echo ($data['user']->physique == 'chubby') ? 'selected' : ''; ?>>Chubby
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Blood Group</label>
                <select name="blood_group" class="w-full rounded-xl border-gray-200">
                    <option value="">Unknown</option>
                    <?php foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg): ?>
                        <option value="<?php echo $bg; ?>" <?php echo ($data['user']->blood_group == $bg) ? 'selected' : ''; ?>><?php echo $bg; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Disability</label>
                <input type="text" name="disability" value="<?php echo $data['user']->disability; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
        </div>
        <div class="mt-6">
            <label class="block text-sm font-bold text-gray-700 mb-2">Bio / Additional Info</label>
            <textarea name="bio" rows="3"
                class="w-full rounded-xl border-gray-200"><?php echo $data['user']->bio; ?></textarea>
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
                <input type="text" name="education" value="<?php echo $data['user']->education; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Degree</label>
                <input type="text" name="degree" value="<?php echo $data['user']->degree; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Occupation</label>
                <input type="text" name="occupation" value="<?php echo $data['user']->occupation; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Job Title</label>
                <input type="text" name="job_title" value="<?php echo $data['user']->job_title; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Company</label>
                <input type="text" name="company_name" value="<?php echo $data['user']->company_name; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Monthly Income</label>
                <input type="number" name="monthly_income" value="<?php echo (int) $data['user']->monthly_income; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Emp. Type</label>
                <select name="employment_type" class="w-full rounded-xl border-gray-200">
                    <option value="Job" <?php echo ($data['user']->employment_type == 'Job') ? 'selected' : ''; ?>>Job
                    </option>
                    <option value="Business" <?php echo ($data['user']->employment_type == 'Business') ? 'selected' : ''; ?>>Business</option>
                    <option value="Abroad" <?php echo ($data['user']->employment_type == 'Abroad') ? 'selected' : ''; ?>>
                        Abroad</option>
                    <option value="None" <?php echo ($data['user']->employment_type == 'None') ? 'selected' : ''; ?>>
                        None</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">House Status</label>
                <select name="house_status" class="w-full rounded-xl border-gray-200">
                    <option value="Personal" <?php echo ($data['user']->house_status == 'Personal') ? 'selected' : ''; ?>>Personal</option>
                    <option value="Rent" <?php echo ($data['user']->house_status == 'Rent') ? 'selected' : ''; ?>>Rent</option>
                    <option value="None" <?php echo ($data['user']->house_status == 'None') ? 'selected' : ''; ?>>None</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">House Size</label>
                <input type="text" name="house_size" value="<?php echo $data['user']->house_size ?? ''; ?>" placeholder="e.g. 5 Marla, 10 Marla"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-700 mb-2">Office Address</label>
                <input type="text" name="company_address" value="<?php echo $data['user']->company_address; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
        </div>
    </div>

    <!-- SECTION 3 — Contact Details & Possessions -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">3</span>
            Contact & Possessions
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">WhatsApp</label>
                <input type="text" name="whatsapp" value="<?php echo $data['user']->whatsapp; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">City</label>
                <input type="text" name="city" value="<?php echo $data['user']->city; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Country</label>
                <input type="text" name="country" value="<?php echo $data['user']->country; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-1 flex gap-4 mt-8">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="is_overseas" class="rounded text-pink-500" <?php echo $data['user']->is_overseas ? 'checked' : ''; ?>>
                    <span class="text-sm font-bold text-gray-700">Overseas?</span>
                </label>
            </div>
            <div class="md:col-span-2 flex gap-4 mt-8">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="has_bike" class="rounded text-pink-500" <?php echo $data['user']->has_bike ? 'checked' : ''; ?>>
                    <span class="text-sm font-bold text-gray-700">Has Bike?</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="has_car" class="rounded text-pink-500" <?php echo $data['user']->has_car ? 'checked' : ''; ?>>
                    <span class="text-sm font-bold text-gray-700">Has Car?</span>
                </label>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">Permanent Address</label>
                <textarea name="permanent_address" rows="2"
                    class="w-full rounded-xl border-gray-200"><?php echo $data['user']->permanent_address; ?></textarea>
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">Temporary Address</label>
                <textarea name="temporary_address" rows="2"
                    class="w-full rounded-xl border-gray-200"><?php echo $data['user']->temporary_address; ?></textarea>
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
                    <option value="Yes" <?php echo ($data['user']->father_status == 'Yes') ? 'selected' : ''; ?>>Alive
                    </option>
                    <option value="No" <?php echo ($data['user']->father_status == 'No') ? 'selected' : ''; ?>>Deceased
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mother Status</label>
                <select name="mother_status" class="w-full rounded-xl border-gray-200">
                    <option value="Yes" <?php echo ($data['user']->mother_status == 'Yes') ? 'selected' : ''; ?>>Alive
                    </option>
                    <option value="No" <?php echo ($data['user']->mother_status == 'No') ? 'selected' : ''; ?>>Deceased
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Occupation</label>
                <input type="text" name="father_occup" value="<?php echo $data['user']->father_occup; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mother Occupation</label>
                <input type="text" name="mother_occup" value="<?php echo $data['user']->mother_occup; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Father Income</label>
                <input type="number" name="father_income" value="<?php echo (int) $data['user']->father_income; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Mother Income</label>
                <input type="number" name="mother_income" value="<?php echo (int) $data['user']->mother_income; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-2"></div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Brothers</label>
                <input type="number" name="brothers_count" value="<?php echo $data['user']->brothers_count; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Married Bros</label>
                <input type="number" name="married_brothers" value="<?php echo $data['user']->married_brothers; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Sisters</label>
                <input type="number" name="sisters_count" value="<?php echo $data['user']->sisters_count; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Married Siss</label>
                <input type="number" name="married_sisters" value="<?php echo $data['user']->married_sisters; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
        </div>
    </div>

    <!-- SECTION 5 — Marriage Info -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center border-b pb-4">
            <span
                class="bg-pink-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">5</span>
            First Marriage Info
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Children?</label>
                <select name="has_children" class="w-full rounded-xl border-gray-200">
                    <option value="No" <?php echo ($data['user']->has_children == 'No') ? 'selected' : ''; ?>>No</option>
                    <option value="Yes" <?php echo ($data['user']->has_children == 'Yes') ? 'selected' : ''; ?>>Yes
                    </option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Children Count</label>
                <input type="number" name="children_count" value="<?php echo $data['user']->children_count; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Living With</label>
                <input type="text" name="living_with" value="<?php echo $data['user']->living_with; ?>"
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
                <input type="text" name="pref_age" value="<?php echo $data['user']->pref_age; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Height</label>
                <input type="text" name="pref_height" value="<?php echo $data['user']->pref_height; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Education</label>
                <input type="text" name="pref_education" value="<?php echo $data['user']->pref_education; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Caste</label>
                <input type="text" name="pref_caste" value="<?php echo $data['user']->pref_caste; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred City</label>
                <input type="text" name="pref_city" value="<?php echo $data['user']->pref_city; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Preferred Income</label>
                <input type="text" name="pref_income" value="<?php echo $data['user']->pref_income; ?>"
                    class="w-full rounded-xl border-gray-200">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-bold text-gray-700 mb-2">Other Preference Notes</label>
                <textarea name="pref_others" rows="3"
                    class="w-full rounded-xl border-gray-200"><?php echo $data['user']->pref_others; ?></textarea>
            </div>
        </div>
    </div>

    <!-- SECTION 7 — Bureau Info -->
    <div class="bg-gray-900 rounded-3xl shadow-sm p-8 text-white">
        <h3 class="text-lg font-bold mb-6 flex items-center border-b border-white/10 pb-4">
            <span
                class="bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">7</span>
            Bureau Office Info (OFFICIAL)
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Form Number</label>
                <input type="text" name="form_no" value="<?php echo $data['user']->form_no; ?>"
                    class="w-full rounded-xl bg-white/5 border-white/10">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Receipt Number</label>
                <input type="text" name="receipt_no" value="<?php echo $data['user']->receipt_no; ?>"
                    class="w-full rounded-xl bg-white/5 border-white/10">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Application Fee (PKR)</label>
                <input type="number" name="fee" value="<?php echo (float) $data['user']->fee; ?>"
                    class="w-full rounded-xl bg-white/5 border-white/10">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-400 mb-2">Assign Package</label>
                <select name="package_id" class="w-full rounded-xl bg-white/5 border-white/10 text-white">
                    <option value="" class="text-gray-900">-- Select Package --</option>
                    <?php foreach ($data['packages'] as $package): ?>
                        <option value="<?php echo $package->id; ?>" class="text-gray-900" 
                            <?php echo (isset($data['subscription']) && $data['subscription']->package_id == $package->id) ? 'selected' : ''; ?>>
                            <?php echo $package->name; ?> (PKR <?php echo $package->price; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($data['subscription']) && $data['subscription']->status == 'active'): ?>
                    <div class="text-xs text-green-400 mt-1 italic">
                        Active until: <?php echo date('d M, Y', strtotime($data['subscription']->end_date)); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="md:col-span-1">
                <label class="block text-sm font-bold text-gray-400 mb-2">Officer Signature</label>
                <input type="file" name="admin_signature" class="w-full text-xs text-gray-400">
                <?php if (!empty($data['user']->admin_signature)): ?>
                    <div class="mt-2 bg-white rounded p-2 inline-block">
                        <img src="<?php echo URLROOT; ?>/uploads/signatures/<?php echo $data['user']->admin_signature; ?>"
                            class="h-10">
                    </div>
                <?php endif; ?>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-gray-400 mb-2">Admin Notes</label>
                <textarea name="admin_notes" rows="2"
                    class="w-full rounded-xl bg-white/5 border-white/10"><?php echo $data['user']->admin_notes; ?></textarea>
            </div>
        </div>
    </div>

    <div class="pt-8">
        <button type="submit"
            class="w-full bg-pink-600 text-white py-5 rounded-3xl font-bold text-xl hover:bg-pink-700 transition shadow-xl shadow-pink-200 uppercase">
            UPDATE USER PROFILE
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