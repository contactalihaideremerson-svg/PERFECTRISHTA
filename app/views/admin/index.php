<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Dashboard'); ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
    <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-blue-500">
        <div class="flex items-center justify-between mb-2">
            <div class="p-2 bg-blue-50 text-blue-500 rounded-lg"><i class="fas fa-users"></i></div>
            <span class="text-[10px] font-bold text-gray-400 uppercase">Total Users</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900">
            <?php echo number_format($data['stats']['total_users']); ?>
        </h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-green-500">
        <div class="flex items-center justify-between mb-2">
            <div class="p-2 bg-green-50 text-green-500 rounded-lg"><i class="fas fa-user-check"></i></div>
            <span class="text-[10px] font-bold text-gray-400 uppercase">Active</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900">
            <?php echo number_format($data['stats']['active_users']); ?>
        </h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-orange-500">
        <div class="flex items-center justify-between mb-2">
            <div class="p-2 bg-orange-50 text-orange-500 rounded-lg"><i class="fas fa-user-clock"></i></div>
            <span class="text-[10px] font-bold text-gray-400 uppercase">Pending</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 flex items-center">
            <?php echo number_format($data['stats']['pending_users']); ?>
            <?php if ($data['stats']['pending_users'] > 0): ?>
                <span class="ml-2 flex h-2 w-2 rounded-full bg-orange-500 animate-pulse"></span>
            <?php endif; ?>
        </h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-purple-500">
        <div class="flex items-center justify-between mb-2">
            <div class="p-2 bg-purple-50 text-purple-500 rounded-lg"><i class="fas fa-crown"></i></div>
            <span class="text-[10px] font-bold text-gray-400 uppercase">Paid Subs</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900">
            <?php echo number_format($data['stats']['paid_users']); ?>
        </h3>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border-b-4 border-pink-500">
        <div class="flex items-center justify-between mb-2">
            <div class="p-2 bg-pink-50 text-pink-500 rounded-lg"><i class="fas fa-dollar-sign"></i></div>
            <span class="text-[10px] font-bold text-gray-400 uppercase">Revenue</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900">Rs.
            <?php echo number_format($data['stats']['revenue']); ?>
        </h3>
    </div>
</div>

<!-- Recent Requests Section -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-10">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="font-bold text-gray-900">Recent Registration Requests</h3>
        <a href="<?php echo URLROOT; ?>/admin/requests" class="text-pink-600 text-sm font-bold hover:underline">View All
            Requests</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Joined</th>
                    <th class="px-6 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($data['recent_requests'])): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400 text-sm">No new requests pending.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['recent_requests'] as $request): ?>
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 text-sm font-bold text-gray-900"><?php echo $request->name; ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?php echo $request->email; ?></td>
                            <td class="px-6 py-4 text-xs text-gray-400">
                                <?php echo date('M d, Y', strtotime($request->created_at)); ?></td>
                            <td class="px-6 py-4 text-right">
                                <form action="<?php echo URLROOT; ?>/admin/approve_user/<?php echo $request->id; ?>"
                                    method="POST">
                                    <button type="submit"
                                        class="text-xs bg-green-500 text-white px-3 py-1.5 rounded-lg font-bold hover:bg-green-600 transition">Approve</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php admin_footer(); ?>