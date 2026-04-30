<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Manage Packages'); ?>

<div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Subscription Packages</h1>
    <a href="<?php echo URLROOT; ?>/admin/add_package"
        class="px-4 py-2 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 transition">
        <i class="fas fa-plus mr-2"></i> Add New Package
    </a>
</div>

<?php echo flash('admin_message'); ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($data['packages'] as $package): ?>
        <div
            class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col h-full relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg"><?php echo $package->name; ?></h3>
                    <p class="text-pink-600 font-bold text-2xl"><?php echo CURRENCY; ?>
                        <?php echo number_format($package->price); ?></p>
                </div>
                <div class="text-xs font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">
                    <?php echo $package->duration_days; ?> Days
                </div>
            </div>

            <div class="flex-1">
                <h4 class="text-xs font-bold text-gray-400 uppercase mb-3">Included Features</h4>
                <ul class="space-y-2 mb-8">
                    <?php
                    $features = json_decode($package->features, true);
                    if (is_array($features)):
                        foreach ($features as $feature): ?>
                            <li class="text-gray-700 text-sm flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <?php echo $feature; ?>
                            </li>
                        <?php endforeach;
                    else: ?>
                        <li class="text-gray-400 text-sm italic">No features defined</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="flex gap-2 mt-auto">
                <a href="<?php echo URLROOT; ?>/admin/edit_package/<?php echo $package->id; ?>"
                    class="flex-1 text-center py-2 bg-gray-100 text-gray-700 text-xs font-bold rounded-lg hover:bg-gray-200 transition">Edit</a>
                <form action="<?php echo URLROOT; ?>/admin/delete_package/<?php echo $package->id; ?>" method="POST"
                    class="flex-1" onsubmit="return confirm('Are you sure?')">
                    <button type="submit"
                        class="w-full py-2 bg-red-50 text-red-500 text-xs font-bold rounded-lg hover:bg-red-500 hover:text-white transition">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php admin_footer(); ?>