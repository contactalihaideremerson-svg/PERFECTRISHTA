<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Registration Requests'); ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Registration Requests</h1>
</div>

<?php echo flash('admin_message'); ?>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="p-4 text-xs font-bold text-gray-400 uppercase">Profile #</th>
                <th class="p-4 text-xs font-bold text-gray-400 uppercase">User</th>
                <th class="p-4 text-xs font-bold text-gray-400 uppercase">Package</th>
                <th class="p-4 text-xs font-bold text-gray-400 uppercase">Details</th>
                <th class="p-4 text-xs font-bold text-gray-400 uppercase text-right">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            <?php foreach ($data['requests'] as $user): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 font-bold text-pink-600">
                        #<?php echo $user->id; ?>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 mr-3 font-bold text-sm">
                                <?php echo substr($user->name, 0, 1); ?>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-sm">
                                    <?php echo $user->name; ?>
                                </div>
                                <div class="text-xs text-gray-500">
                                    <?php echo $user->email; ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <?php if (!empty($user->package_name)): ?>
                            <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full text-[10px] font-bold uppercase">
                                <?php echo $user->package_name; ?>
                            </span>
                        <?php else: ?>
                            <span class="text-gray-400 text-xs italic">No Package</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-4">
                        <div class="text-xs text-gray-600">
                            <?php echo $user->gender; ?> • <?php echo $user->city; ?>
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1">
                            Joined <?php echo date('M d, Y', strtotime($user->created_at)); ?>
                        </div>
                    </td>
                    <td class="p-4 text-right">
                        <form action="<?php echo URLROOT; ?>/admin/approve_user/<?php echo $user->id; ?>" method="POST"
                            class="inline">
                            <button type="submit"
                                class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-lg hover:bg-green-600 transition">Approve</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($data['requests'])): ?>
                <tr>
                    <td colspan="4" class="p-10 text-center text-gray-400">No pending registration requests.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php admin_footer(); ?>