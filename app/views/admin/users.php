<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('User Management'); ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Platform Users</h1>
    <a href="<?php echo URLROOT; ?>/admin/add_user"
        class="px-4 py-2 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 transition">
        <i class="fas fa-plus mr-2"></i> Add New User
    </a>
</div>

<?php echo flash('admin_message'); ?>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100">
        <h3 class="font-bold text-gray-900 text-lg mb-4">Manage All Users</h3>
        <form action="<?php echo URLROOT; ?>/admin/users" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <!-- Search -->
                <div class="md:col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Search</label>
                    <input type="text" name="search" value="<?php echo $data['filters']['search'] ?? ''; ?>"
                        placeholder="ID, Name, Email"
                        class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm focus:bg-white focus:ring-2 focus:ring-pink-500 outline-none transition">
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Gender</label>
                    <select name="gender" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm">
                        <option value="">Any</option>
                        <option value="male" <?php echo ($data['filters']['gender'] == 'male') ? 'selected' : ''; ?>>Male
                        </option>
                        <option value="female" <?php echo ($data['filters']['gender'] == 'female') ? 'selected' : ''; ?>>
                            Female</option>
                    </select>
                </div>

                <!-- Religion -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Religion</label>
                    <input type="text" name="religion" value="<?php echo $data['filters']['religion'] ?? ''; ?>"
                        placeholder="Islam" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm">
                </div>

                <!-- Marital Status -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Status</label>
                    <select name="marital_status"
                        class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm">
                        <option value="">Any</option>
                        <option value="Single" <?php echo ($data['filters']['marital_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                        <option value="1st Marriage" <?php echo ($data['filters']['marital_status'] == '1st Marriage') ? 'selected' : ''; ?>>1st Marriage</option>
                        <option value="2nd Marriage" <?php echo ($data['filters']['marital_status'] == '2nd Marriage') ? 'selected' : ''; ?>>2nd Marriage</option>
                    </select>
                </div>

                <!-- City -->
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">City</label>
                    <input type="text" name="city" value="<?php echo $data['filters']['city'] ?? ''; ?>"
                        placeholder="Lahore" class="w-full bg-gray-50 border-gray-200 rounded-xl px-4 py-2 text-sm">
                </div>

                <!-- Action -->
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 bg-pink-600 text-white rounded-xl py-2 text-sm font-bold hover:bg-pink-700 transition">
                        Filter
                    </button>
                    <a href="<?php echo URLROOT; ?>/admin/users"
                        class="px-3 py-2 bg-gray-100 text-gray-500 rounded-xl hover:bg-gray-200 transition"
                        title="Clear">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">Profile #</th>
                    <th class="px-6 py-4">User Details</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Package</th>
                    <th class="px-6 py-4 text-center">Verification</th>
                    <th class="px-6 py-4">Location</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($data['users'] as $user): ?>
                    <tr class="hover:bg-gray-50/50 transition whitespace-nowrap">
                        <td class="px-6 py-4 font-bold text-pink-600">
                            #<?php echo $user->id; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user->name); ?>&background=db2777&color=fff"
                                    class="w-10 h-10 rounded-full mr-3 border-2 border-pink-50">
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">
                                        <?php echo $user->name; ?>
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        <?php echo $user->email; ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <?php
                            $status = isset($user->status) ? $user->status : 'pending';
                            if ($status == 'active'): ?>
                                <span
                                    class="bg-green-100 text-green-600 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase ring-1 ring-green-200">Active</span>
                            <?php else: ?>
                                <span
                                    class="bg-red-100 text-red-600 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase ring-1 ring-red-200">
                                    <?php echo ($status == 'suspended') ? 'Suspended' : ucfirst($status); ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php if (!empty($user->package_name)): ?>
                                <span
                                    class="bg-pink-100 text-pink-600 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase ring-1 ring-pink-200">
                                    <?php echo $user->package_name; ?>
                                </span>
                            <?php else: ?>
                                <span class="text-gray-400 text-xs italic">No Package</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php if ($user->is_verified): ?>
                                <span class="text-blue-500 text-sm"><i class="fas fa-check-circle mr-1"></i> Verified</span>
                            <?php else: ?>
                                <span class="text-gray-400 text-sm"><i class="fas fa-clock mr-1"></i> Unverified</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <?php echo $user->city ?: '<span class="text-gray-300 italic">Not set</span>'; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="<?php echo URLROOT; ?>/admin/edit_user/<?php echo $user->id; ?>"
                                    class="p-2 bg-gray-50 text-gray-600 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition"
                                    title="Edit Profile"><i class="fas fa-edit"></i></a>

                                <a href="<?php echo URLROOT; ?>/admin/toggle_status/<?php echo $user->id; ?>"
                                    class="p-2 bg-gray-50 <?php echo $status == 'active' ? 'text-red-500 hover:bg-red-50' : 'text-green-500 hover:bg-green-50'; ?> rounded-xl transition"
                                    title="Toggle Access"><i
                                        class="fas <?php echo $status == 'active' ? 'fa-user-slash' : 'fa-user-check'; ?>"></i></a>

                                <form action="<?php echo URLROOT; ?>/admin/delete_user/<?php echo $user->id; ?>"
                                    method="POST"
                                    onsubmit="return confirm('Permanently delete this user? This cannot be undone!')">
                                    <button type="submit"
                                        class="p-2 bg-gray-50 text-gray-400 hover:bg-red-500 hover:text-white rounded-xl transition">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($data['users'])): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">No registered users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php admin_footer(); ?>