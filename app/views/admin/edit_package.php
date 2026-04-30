<?php require APPROOT . '/views/inc/admin_layout.php';
admin_header('Edit Package'); ?>

<div class="mb-8">
    <a href="<?php echo URLROOT; ?>/admin/packages" class="text-pink-600 text-sm font-bold"><i
            class="fas fa-arrow-left mr-2"></i> Back to Packages</a>
    <h1 class="text-2xl font-bold text-gray-900 mt-2">Edit Package: <?php echo $data['package']->name; ?></h1>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 max-w-2xl">
    <form action="<?php echo URLROOT; ?>/admin/edit_package/<?php echo $data['package']->id; ?>" method="POST"
        class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Package Name</label>
                <input type="text" name="name" value="<?php echo $data['package']->name; ?>" required
                    class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Price (PKR)</label>
                <input type="number" name="price" value="<?php echo (int) $data['package']->price; ?>" required
                    class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Duration (Days)</label>
                <input type="number" name="duration" value="<?php echo $data['package']->duration_days; ?>" required
                    class="w-full rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500">
            </div>
        </div>

        <?php
        $features = json_decode($data['package']->features, true);
        if (!is_array($features))
            $features = [];
        ?>
        <div class="pt-6 border-t border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-900">Features</h3>
                <button type="button" onclick="addFeatureRow()"
                    class="text-xs font-bold text-pink-600 hover:text-pink-700">
                    <i class="fas fa-plus mr-1"></i> Add Feature
                </button>
            </div>
            <div id="features-container" class="space-y-3">
                <?php if (empty($features)): ?>
                    <div class="flex gap-2">
                        <input type="text" name="features[]" placeholder="Enter feature text"
                            class="flex-1 rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500 text-sm">
                        <button type="button" onclick="this.parentElement.remove()"
                            class="text-gray-400 hover:text-red-500 p-2"><i class="fas fa-times"></i></button>
                    </div>
                <?php else: ?>
                    <?php foreach ($features as $feature): ?>
                        <div class="flex gap-2">
                            <input type="text" name="features[]" value="<?php echo $feature; ?>"
                                placeholder="Enter feature text"
                                class="flex-1 rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500 text-sm">
                            <button type="button" onclick="this.parentElement.remove()"
                                class="text-gray-400 hover:text-red-500 p-2"><i class="fas fa-times"></i></button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="pt-8">
            <button type="submit"
                class="w-full py-4 bg-pink-600 text-white font-bold rounded-2xl hover:bg-pink-700 transition shadow-lg shadow-pink-200">
                Update Package
            </button>
        </div>
    </form>
</div>

<script>
    function addFeatureRow() {
        const container = document.getElementById('features-container');
        const div = document.createElement('div');
        div.className = 'flex gap-2';
        div.innerHTML = `
        <input type="text" name="features[]" placeholder="Enter feature text" class="flex-1 rounded-xl border-gray-200 focus:border-pink-500 focus:ring-pink-500 text-sm">
        <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500 p-2"><i class="fas fa-times"></i></button>
    `;
        container.appendChild(div);
    }
</script>

<?php admin_footer(); ?>