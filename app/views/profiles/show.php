<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Sidebar: Photo & Key Actions -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                <div class="p-6">
                    <div class="relative group">
                        <img src="<?php echo URLROOT; ?>/uploads/<?php echo ($data['profile']) ? $data['profile']->profile_pic : 'default.png'; ?>"
                            class="w-full aspect-square rounded-2xl object-cover border-4 border-pink-50 shadow-sm mb-6 <?php echo !isset($_SESSION['user_id']) ? 'blur-2xl select-none pointer-events-none' : ''; ?>">
                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <div class="absolute inset-0 flex items-center justify-center p-4">
                                <div
                                    class="bg-white/80 backdrop-blur-sm px-6 py-4 rounded-3xl border border-white shadow-2xl text-center transform group-hover:scale-105 transition duration-300">
                                    <div
                                        class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-lock text-pink-600 text-xl"></i>
                                    </div>
                                    <p class="text-xs font-bold text-gray-900 uppercase tracking-widest leading-tight">
                                        Login<br>to view</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900"><?php echo $data['user']->name; ?></h2>
                        <p class="text-pink-600 font-medium">Profile ID:
                            PM-<?php echo str_pad($data['user']->id, 5, '0', STR_PAD_LEFT); ?></p>
                    </div>

                    <div class="space-y-3">
                        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['user']->id): ?>
                            <a href="<?php echo URLROOT; ?>/profiles/edit"
                                class="flex items-center justify-center w-full bg-pink-600 text-white py-3.5 rounded-xl font-bold hover:bg-pink-700 transition">
                                <i class="fas fa-edit mr-2"></i> Edit My Profile
                            </a>
                        <?php else: ?>
                            <a href="https://wa.me/923037282398?text=I'm interested in profile: <?php echo URLROOT; ?>/profiles/show/<?php echo $data['user']->id; ?>"
                                target="_blank"
                                class="flex items-center justify-center w-full bg-green-600 text-white py-3.5 rounded-xl font-bold hover:bg-green-700 transition shadow-lg shadow-green-100">
                                <i class="fab fa-whatsapp mr-2 text-xl"></i> Message Now
                            </a>

                        <?php endif; ?>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 border-t border-gray-100">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Core Stats</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-3 rounded-xl border border-gray-100">
                            <span class="block text-xs text-gray-400 mb-1">Age</span>
                            <span
                                class="font-bold text-gray-700"><?php echo ($data['profile']) ? $data['profile']->age : 'N/A'; ?>
                                yrs</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-100">
                            <span class="block text-xs text-gray-400 mb-1">Height</span>
                            <span
                                class="font-bold text-gray-700"><?php echo $data['profile']->height ?? 'N/A'; ?></span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-100">
                            <span class="block text-xs text-gray-400 mb-1">Caste</span>
                            <span
                                class="font-bold text-gray-700 truncate"><?php echo $data['profile']->caste ?? 'N/A'; ?></span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-100">
                            <span class="block text-xs text-gray-400 mb-1">City</span>
                            <span
                                class="font-bold text-gray-700 truncate"><?php echo $data['profile']->city ?? 'N/A'; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">Possessions</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-500"><i
                                class="fas fa-globe-americas w-5 text-gray-400"></i> Overseas</span>
                        <span
                            class="font-bold <?php echo ($data['profile'] && $data['profile']->is_overseas) ? 'text-green-600' : 'text-gray-400'; ?>">
                            <?php echo ($data['profile'] && $data['profile']->is_overseas) ? 'Yes' : 'No'; ?>
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-500"><i
                                class="fas fa-motorcycle w-5 text-gray-400"></i> Motorcycle</span>
                        <span
                            class="font-bold <?php echo ($data['profile'] && $data['profile']->has_bike) ? 'text-green-600' : 'text-gray-400'; ?>">
                            <?php echo ($data['profile'] && $data['profile']->has_bike) ? 'Yes' : 'No'; ?>
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-500"><i class="fas fa-car w-5 text-gray-400"></i>
                            Private Car</span>
                        <span
                            class="font-bold <?php echo ($data['profile'] && $data['profile']->has_car) ? 'text-green-600' : 'text-gray-400'; ?>">
                            <?php echo ($data['profile'] && $data['profile']->has_car) ? 'Yes' : 'No'; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content: Detailed Info -->
        <div class="lg:col-span-2 space-y-8">

            <!-- SECTION 1 — About & Basic Info -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-user-circle text-pink-600 mr-3"></i> About Me
                    </h3>
                    <span
                        class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-bold uppercase tracking-widest">Active
                        Member</span>
                </div>
                <p class="text-gray-600 leading-relaxed mb-8 italic">
                    "<?php echo $data['profile']->bio ?: 'I am a humble individual looking for a compatible soulmate based on mutual respect and values...'; ?>"
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4">
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Gender</span>
                        <span
                            class="text-gray-900 font-bold capitalize"><?php echo $data['profile']->gender ?? 'N/A'; ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Marital Status</span>
                        <span
                            class="text-gray-900 font-bold"><?php echo $data['profile']->marital_status ?? 'N/A'; ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Employment Type</span>
                        <span
                            class="text-gray-900 font-bold"><?php echo $data['profile']->employment_type ?? 'N/A'; ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">House Status</span>
                        <span class="text-gray-900 font-bold"><?php echo $data['profile']->house_status ?? 'N/A'; ?>
                            (<?php echo $data['profile']->house_size ?? 'N/A'; ?>)</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Religion</span>
                        <span class="text-gray-900 font-bold"><?php echo $data['profile']->religion ?? 'N/A'; ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Sect/Maslak</span>
                        <span class="text-gray-900 font-bold"><?php echo $data['profile']->sect ?? 'N/A'; ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Skin Color / Phys.</span>
                        <span class="text-gray-900 font-bold"><?php echo ucfirst($data['profile']->skin_color ?? ''); ?>
                            / <?php echo ucfirst($data['profile']->physique ?? ''); ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-400 text-sm">Blood Group</span>
                        <span
                            class="text-gray-900 font-bold"><?php echo $data['profile']->blood_group ?? 'Unknown'; ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2 col-span-1 md:col-span-2">
                        <span class="text-gray-400 text-sm">Disability (if any)</span>
                        <span
                            class="text-gray-900 font-bold"><?php echo $data['profile']->disability ?: 'None'; ?></span>
                    </div>
                </div>
            </div>

            <!-- SECTION 2 — Education & Profession -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-graduation-cap text-pink-600 mr-3"></i> Career Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-gray-50 p-3 rounded-xl mr-4"><i class="fas fa-award text-gray-400"></i></div>
                            <div>
                                <span
                                    class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider">Education</span>
                                <span
                                    class="text-gray-900 font-bold"><?php echo $data['profile']->education ?? 'N/A'; ?></span>
                                <span
                                    class="block text-sm text-gray-500"><?php echo $data['profile']->degree ?? ''; ?></span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-gray-50 p-3 rounded-xl mr-4"><i class="fas fa-building text-gray-400"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider">Office
                                    Details</span>
                                <span
                                    class="text-gray-900 font-bold"><?php echo $data['profile']->company_name ?? 'Confidential'; ?></span>
                                <span
                                    class="block text-sm text-gray-500"><?php echo $data['profile']->employment_type ?? ''; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-gray-50 p-3 rounded-xl mr-4"><i class="fas fa-briefcase text-gray-400"></i>
                            </div>
                            <div>
                                <span
                                    class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider">Profession</span>
                                <span
                                    class="text-gray-900 font-bold"><?php echo $data['profile']->occupation ?? 'N/A'; ?></span>
                                <span
                                    class="block text-sm text-gray-500"><?php echo $data['profile']->job_title ?? ''; ?></span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-gray-50 p-3 rounded-xl mr-4"><i class="fas fa-wallet text-gray-400"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-wider">Income
                                    Level</span>
                                <span class="text-gray-900 font-bold">Monthly PKR
                                    <?php echo number_format($data['profile']->monthly_income ?? 0); ?> /-</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 3 — Family Background -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fas fa-users text-pink-600 mr-3"></i> Family Structure
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded-2xl">
                        <h4 class="font-bold text-pink-600 mb-4 border-b border-pink-100 pb-2">Parental Info</h4>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between"><span class="text-gray-500">Father Status</span><span
                                    class="font-bold"><?php echo $data['profile']->father_status == 'Yes' ? 'Alive' : 'Deceased'; ?></span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-500">Father Job</span><span
                                    class="font-bold"><?php echo $data['profile']->father_occup ?: 'N/A'; ?></span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-500">Father Income</span><span
                                    class="font-bold">PKR
                                    <?php echo number_format($data['profile']->father_income ?? 0); ?></span></div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between"><span class="text-gray-500">Mother Status</span><span
                                    class="font-bold"><?php echo $data['profile']->mother_status == 'Yes' ? 'Alive' : 'Deceased'; ?></span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-500">Mother Job</span><span
                                    class="font-bold"><?php echo $data['profile']->mother_occup ?: 'N/A'; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-2xl">
                        <h4 class="font-bold text-pink-600 mb-4 border-b border-pink-100 pb-2">Siblings Info</h4>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between"><span class="text-gray-500">Total Brothers</span><span
                                    class="font-bold"><?php echo (int) $data['profile']->brothers_count; ?> Total</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-500">Married Brothers</span><span
                                    class="font-bold"><?php echo (int) $data['profile']->married_brothers; ?>
                                    Married</span></div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between"><span class="text-gray-500">Total Sisters</span><span
                                    class="font-bold"><?php echo (int) $data['profile']->sisters_count; ?> Total</span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-500">Married Sisters</span><span
                                    class="font-bold"><?php echo (int) $data['profile']->married_sisters; ?>
                                    Married</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4 — Spouse Requirements -->
            <div class="bg-pink-600 rounded-3xl shadow-xl p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-6 flex items-center">
                        <i class="fas fa-heart text-white mr-3"></i> Preferred Spouse
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div>
                            <span class="block text-[10px] opacity-70 uppercase font-bold tracking-widest">Age
                                Range</span>
                            <p class="font-bold text-lg"><?php echo $data['profile']->pref_age ?: 'Open'; ?></p>
                        </div>
                        <div>
                            <span
                                class="block text-[10px] opacity-70 uppercase font-bold tracking-widest">Education</span>
                            <p class="font-bold text-lg"><?php echo $data['profile']->pref_education ?: 'Open'; ?></p>
                        </div>
                        <div>
                            <span class="block text-[10px] opacity-70 uppercase font-bold tracking-widest">Income
                                Pref.</span>
                            <p class="font-bold text-lg"><?php echo $data['profile']->pref_income ?: 'Any'; ?></p>
                        </div>
                        <div>
                            <span class="block text-[10px] opacity-70 uppercase font-bold tracking-widest">Preferred
                                City</span>
                            <p class="font-bold text-lg"><?php echo $data['profile']->pref_city ?: 'Anywhere'; ?></p>
                        </div>
                        <div>
                            <span class="block text-[10px] opacity-70 uppercase font-bold tracking-widest">Preferred
                                Caste</span>
                            <p class="font-bold text-lg"><?php echo $data['profile']->pref_caste ?: 'Everywhere'; ?></p>
                        </div>
                        <div>
                            <span class="block text-[10px] opacity-70 uppercase font-bold tracking-widest">Preferred
                                Height</span>
                            <p class="font-bold text-lg"><?php echo $data['profile']->pref_height ?: 'Any'; ?></p>
                        </div>
                    </div>
                    <div class="mt-8 pt-6 border-t border-white/20">
                        <span class="block text-xs opacity-70 uppercase font-bold mb-2">Specific Demands / Notes</span>
                        <p class="text-sm italic italic leading-relaxed">
                            "<?php echo $data['profile']->pref_others ?: 'No specific additional requirements provided.'; ?>"
                        </p>
                    </div>
                </div>
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            </div>

            <!-- SECTION 5 — Contact & Extra Info (Visible to Admin/Own) -->
            <?php if ((isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') || (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $data['user']->id)): ?>
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-address-card text-pink-600 mr-3"></i> Contact & Verification Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm">
                        <div class="space-y-3">
                            <div class="flex justify-between"><span class="text-gray-500">Registered Email</span><span
                                    class="font-bold text-gray-800"><?php echo $data['user']->email; ?></span></div>
                            <div class="flex justify-between"><span class="text-gray-500">Contact Number</span><span
                                    class="font-bold text-gray-800"><?php echo $data['user']->phone; ?></span></div>
                            <div class="flex justify-between"><span class="text-gray-500">WhatsApp No.</span><span
                                    class="font-bold text-gray-800"><?php echo $data['profile']->whatsapp ?: 'N/A'; ?></span>
                            </div>
                            <div class="flex justify-between"><span class="text-gray-500">CNIC Copy Info</span><span
                                    class="font-bold text-gray-800"><?php echo $data['profile']->cnic ?: 'Not Provided'; ?></span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <span class="block text-gray-500 text-xs mb-1">Permanent Address</span>
                                <p class="font-bold text-gray-800">
                                    <?php echo $data['profile']->permanent_address ?: 'Not Stated'; ?>
                                </p>
                            </div>
                            <div>
                                <span class="block text-gray-500 text-xs mb-1">Temporary Address</span>
                                <p class="font-bold text-gray-800">
                                    <?php echo $data['profile']->temporary_address ?: 'Same as permanent'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- SECTION 7 — Bureau Info (Admin ONLY) -->
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                <div class="bg-gray-900 rounded-3xl shadow-2xl p-8 text-white relative border-l-8 border-red-600">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-2xl font-bold flex items-center text-red-500">
                            <i class="fas fa-file-invoice-dollar mr-4"></i> Bureau Office Record
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                        <div class="space-y-4">
                            <div><span class="block text-gray-500 text-xs uppercase mb-1">Form ID</span><span
                                    class="text-xl font-mono"><?php echo $data['profile']->form_no ?: 'No Form'; ?></span>
                            </div>
                            <div><span class="block text-gray-500 text-xs uppercase mb-1">Receipt ID</span><span
                                    class="text-xl font-mono"><?php echo $data['profile']->receipt_no ?: 'Unpaid'; ?></span>
                            </div>
                            <div><span class="block text-gray-500 text-xs uppercase mb-1">Paid Fee</span><span
                                    class="text-2xl font-bold text-green-400">PKR
                                    <?php echo number_format($data['profile']->fee ?? 0); ?></span></div>
                        </div>

                        <div class="md:col-span-2 bg-white/5 p-6 rounded-2xl border border-white/10">
                            <span class="block text-gray-500 text-xs uppercase mb-3">Admin Private Notes</span>
                            <p class="text-gray-300 italic text-sm mb-6">
                                <?php echo $data['profile']->admin_notes ?: 'No specific administrative notes provided for this user.'; ?>
                            </p>

                            <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase mb-2">Authorizing Signature</span>
                                    <?php if (!empty($data['profile']->admin_signature)): ?>
                                        <img src="<?php echo URLROOT; ?>/uploads/signatures/<?php echo $data['profile']->admin_signature; ?>"
                                            class="h-16 invert opacity-80 filter drop-shadow">
                                    <?php else: ?>
                                        <div class="h-10 text-gray-600 text-[10px] flex items-center italic">UNSIGNED RECORD
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="text-right">
                                    <span class="block text-gray-500 text-[10px] uppercase">Registered Since</span>
                                    <span
                                        class="text-xs font-bold"><?php echo date('d M, Y', strtotime($data['user']->created_at)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>