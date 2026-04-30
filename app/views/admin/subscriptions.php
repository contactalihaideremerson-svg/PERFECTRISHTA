<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Subscription Requests'); ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Subscription Requests</h1>
    <p class="text-gray-500 text-sm italic">Manage and approve package subscription requests from users.</p>
</div>

<?php echo flash('admin_message'); ?>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="font-bold text-gray-900 text-lg">Pending Requests</h3>
        <span class="bg-pink-50 text-pink-600 px-3 py-1 rounded-full text-xs font-bold uppercase">Manual Approval
            Required</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-bold">
                <tr>
                    <th class="px-6 py-4">User Details</th>
                    <th class="px-6 py-4">Package Requested</th>
                    <th class="px-6 py-4">Payment Info</th>
                    <th class="px-6 py-4">Requested Date</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php foreach ($data['subscriptions'] as $sub): ?>
                    <tr class="hover:bg-gray-50/50 transition whitespace-nowrap">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($sub->user_name); ?>&background=db2777&color=fff"
                                    class="w-10 h-10 rounded-full mr-3 border-2 border-pink-50">
                                <div>
                                    <p class="font-bold text-gray-900 text-sm">
                                        <?php echo $sub->user_name; ?>
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        <?php echo $sub->user_email; ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-gray-900">
                                <?php echo $sub->package_name; ?>
                            </span>
                            <div class="text-[10px] text-pink-600 font-black uppercase">
                                <?php echo CURRENCY . ' ' . number_format($sub->price); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-gray-700 bg-gray-100 px-2 py-1 rounded inline-block">
                                <i class="fas fa-wallet mr-1 text-gray-400"></i>
                                <?php echo $sub->payment_method; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php echo date('M d, Y h:i A', strtotime($sub->created_at)); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="<?php echo URLROOT; ?>/admin/confirm_subscription/<?php echo $sub->id; ?>"
                                    class="px-4 py-2 bg-green-600 text-white text-xs font-black rounded-lg hover:bg-green-700 transition shadow-sm"
                                    onclick="return confirm('Confirm payment and activate this package?')">
                                    <i class="fas fa-check mr-1"></i> Confirm
                                </a>
                                <a href="<?php echo URLROOT; ?>/admin/reject_subscription/<?php echo $sub->id; ?>"
                                    class="px-4 py-2 bg-red-100 text-red-600 text-xs font-black rounded-lg hover:bg-red-200 transition"
                                    onclick="return confirm('Reject this request?')">
                                    <i class="fas fa-times mr-1"></i> Reject
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($data['subscriptions'])): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-inbox text-4xl mb-3 text-gray-100"></i>
                                <p>No pending subscription requests.</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php admin_footer(); ?>