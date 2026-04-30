<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Filters Sidebar -->
        <div class="w-full md:w-1/4">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <i class="fas fa-sliders-h mr-2 text-pink-500"></i> Filters
                </h3>
                <form action="<?php echo URLROOT; ?>/profiles" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select name="gender"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            <option value="">Any</option>
                            <option value="male" <?php echo ($data['filters']['gender'] == 'male') ? 'selected' : ''; ?>>
                                Male</option>
                            <option value="female" <?php echo ($data['filters']['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="city" value="<?php echo $data['filters']['city']; ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                            placeholder="e.g. Karachi">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Religion</label>
                        <input type="text" name="religion" value="<?php echo $data['filters']['religion']; ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                            placeholder="e.g. Islam">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Marital Status</label>
                        <select name="marital_status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                            <option value="">Any</option>
                            <option value="Single" <?php echo (($data['filters']['marital_status'] ?? '') == 'Single') ? 'selected' : ''; ?>>Never Married</option>
                            <option value="Divorced" <?php echo (($data['filters']['marital_status'] ?? '') == 'Divorced') ? 'selected' : ''; ?>>Divorced</option>
                            <option value="Widowed" <?php echo (($data['filters']['marital_status'] ?? '') == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                            <option value="1st Marriage" <?php echo (($data['filters']['marital_status'] ?? '') == '1st Marriage') ? 'selected' : ''; ?>>1st Marriage</option>
                            <option value="2nd Marriage" <?php echo (($data['filters']['marital_status'] ?? '') == '2nd Marriage') ? 'selected' : ''; ?>>2nd Marriage</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Education</label>
                        <input type="text" name="education" value="<?php echo $data['filters']['education'] ?? ''; ?>"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm"
                            placeholder="e.g. Masters">
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Min Age</label>
                            <input type="number" name="min_age" value="<?php echo $data['filters']['min_age']; ?>"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Max Age</label>
                            <input type="number" name="max_age" value="<?php echo $data['filters']['max_age']; ?>"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-pink-600 text-white py-2 rounded-lg hover:bg-pink-700 transition font-medium">Apply
                        Filters</button>
                    <a href="<?php echo URLROOT; ?>/profiles"
                        class="block text-center text-sm text-gray-500 hover:text-pink-600">Clear All</a>
                </form>
            </div>
        </div>

        <!-- Profiles Grid -->
        <div class="w-full md:w-3/4">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Discover Matches</h2>
            <?php if (empty($data['profiles'])): ?>
                <div class="bg-white p-12 text-center rounded-2xl shadow-sm border border-gray-100">
                    <img src="https://illustrations.popsy.co/pink/shrugging-man.svg" class="w-48 mx-auto mb-4"
                        alt="No profiles found">
                    <p class="text-gray-500">No profiles found matching your criteria. Try adjusting your filters.</p>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($data['profiles'] as $profile): ?>
                        <?php require APPROOT . '/views/inc/profile_card.php'; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination UI -->
                <?php if ($data['pagination']['total_pages'] > 1): ?>
                    <div class="mt-12 flex justify-center">
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <!-- Previous Page -->
                            <?php if ($data['pagination']['current_page'] > 1): ?>
                                <a href="?<?php echo http_build_query(array_merge($data['filters'], ['page' => $data['pagination']['current_page'] - 1])); ?>"
                                    class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                    <span class="sr-only">Previous</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            <?php else: ?>
                                <span
                                    class="relative inline-flex items-center px-4 py-2 rounded-l-md border border-gray-300 bg-gray-50 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            <?php endif; ?>

                            <!-- Page Numbers -->
                            <?php
                            $start_page = max(1, $data['pagination']['current_page'] - 2);
                            $end_page = min($data['pagination']['total_pages'], $start_page + 4);
                            if ($end_page - $start_page < 4) {
                                $start_page = max(1, $end_page - 4);
                            }

                            for ($i = $start_page; $i <= $end_page; $i++):
                                $isActive = $i == $data['pagination']['current_page'];
                                ?>
                                <a href="?<?php echo http_build_query(array_merge($data['filters'], ['page' => $i])); ?>"
                                    class="relative inline-flex items-center px-4 py-2 border <?php echo $isActive ? 'bg-pink-600 border-pink-600 text-white z-10' : 'bg-white border-gray-300 text-gray-700 hover:bg-gray-50'; ?> text-sm font-bold transition">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>

                            <!-- Next Page -->
                            <?php if ($data['pagination']['current_page'] < $data['pagination']['total_pages']): ?>
                                <a href="?<?php echo http_build_query(array_merge($data['filters'], ['page' => $data['pagination']['current_page'] + 1])); ?>"
                                    class="relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                                    <span class="sr-only">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            <?php else: ?>
                                <span
                                    class="relative inline-flex items-center px-4 py-2 rounded-r-md border border-gray-300 bg-gray-50 text-sm font-medium text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <div class="mt-4 text-center text-xs text-gray-400">
                        Showing <?php echo ($data['pagination']['current_page'] - 1) * $data['pagination']['limit'] + 1; ?> to
                        <?php echo min($data['pagination']['current_page'] * $data['pagination']['limit'], $data['pagination']['total_profiles']); ?>
                        of <?php echo $data['pagination']['total_profiles']; ?> results
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>