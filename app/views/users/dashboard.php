<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <?php echo flash('profile_message'); ?>
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-center p-6">
                <img src="<?php echo URLROOT; ?>/uploads/<?php echo ($data['profile']) ? $data['profile']->profile_pic : 'default.png'; ?>"
                    class="w-32 h-32 rounded-3xl object-cover mx-auto mb-4 border-4 border-pink-50">
                <h3 class="font-bold text-gray-900 text-lg">
                    <?php echo $data['user']->name; ?>
                </h3>
                <p class="text-xs text-gray-500 mb-6">
                    <?php echo $data['user']->email; ?>
                </p>

                <div class="space-y-2">
                    <a href="<?php echo URLROOT; ?>/profiles/edit"
                        class="block w-full bg-pink-50 text-pink-600 py-2 rounded-xl font-bold hover:bg-pink-100 transition">Edit
                        Profile</a>
                    <a href="<?php echo URLROOT; ?>/profiles/show/<?php echo $_SESSION['user_id']; ?>"
                        class="block w-full text-pink-500 text-sm py-2 hover:underline transition">View My Public
                        Profile</a>
                    <a href="<?php echo URLROOT; ?>/users/logout"
                        class="block w-full text-gray-400 text-sm py-2 hover:text-red-500 transition">Logout</a>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mt-6 p-6">
                <h4 class="font-bold text-gray-900 mb-4">Account Status</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Subscription</span>
                        <?php if ($data['subscription']): ?>
                            <?php if ($data['subscription']->status == 'active'): ?>
                                <span
                                    class="bg-green-100 text-green-700 px-2 py-0.5 rounded font-bold text-[10px] border border-green-200 uppercase">
                                    <?php echo $data['subscription']->package_name; ?>
                                </span>
                            <?php elseif ($data['subscription']->status == 'pending'): ?>
                                <span
                                    class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded font-bold text-[10px] border border-yellow-200 uppercase">
                                    Pending
                                </span>
                            <?php else: ?>
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-bold text-[10px] uppercase">
                                    Expired / None
                                </span>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded font-bold text-[10px] uppercase">Free
                                Plan</span>
                        <?php endif; ?>
                    </div>
                    <?php if ($data['subscription'] && $data['subscription']->status == 'active'): ?>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">Expires On</span>
                            <span
                                class="text-pink-600 font-bold"><?php echo date('M d, Y', strtotime($data['subscription']->end_date)); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Verification</span>
                        <span class="text-gray-400 italic">Pending</span>
                    </div>
                </div>
                <a href="<?php echo URLROOT; ?>/pages/packages"
                    class="block w-full text-center mt-6 bg-gray-900 text-white py-2 rounded-xl font-bold text-sm hover:bg-gray-800 transition">Upgrade
                    to Premium</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex items-center justify-between bg-gradient-to-r from-white to-pink-50">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-1">Hello,
                        <?php echo explode(' ', $_SESSION['user_name'])[0]; ?>! 👋
                    </h2>
                    <p class="text-gray-500">Your profile is 65% complete. Complete it to get better matches.</p>
                </div>
                <div class="hidden md:block">
                    <img src="https://perfectrishta.online/public/uploads/LOGO.png" class="w-24">
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <!-- Matches summary -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900">New Matches</h3>
                        <a href="<?php echo URLROOT; ?>/profiles"
                            class="text-pink-600 text-xs font-bold hover:underline">View All</a>
                    </div>
                    <div class="space-y-4">
                        <p class="text-gray-400 text-sm text-center py-10 italic">Complete your profile to unlock smart
                            matching.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>