<?php
// Profile Completeness Calculation
$completeness = 0;
$total_fields = 15; // Defining fields to check
$filled_fields = 0;

$fields_to_check = [
    'bio',
    'dob',
    'city',
    'country',
    'religion',
    'sect',
    'caste',
    'marital_status',
    'education',
    'occupation',
    'age',
    'height',
    'weight',
    'skin_color',
    'profile_pic'
];

foreach ($fields_to_check as $field) {
    if (!empty($profile->$field)) {
        $filled_fields++;
    }
}
$completeness = round(($filled_fields / $total_fields) * 100);

// Check if user is premium
// Assuming $profile has a 'subscription_status' property or we need to check if $data['subscription'] exists 
// Since this is a shared card, we should expect $profile to have joined data if possible, 
// or check a passed variable.
$is_premium = !empty($profile->package_name) && $profile->subscription_status == 'active';
// Fallback check if simple property isn't there
if (!$is_premium && isset($profile->package_id) && !empty($profile->package_id)) {
    // This is a bit weak, usually the model join should handle this.
    // For now, let's look at the existing logic in dashboard.php
}

$is_logged_in = isset($_SESSION['user_id']);
$blur_class = !$is_logged_in ? 'blur-md' : '';
?>

<div
    class="bg-white rounded-[32px] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col h-full group transform hover:-translate-y-1 relative">
    <!-- Top Section: Image and Overlay -->
    <div class="relative h-72 overflow-hidden">
        <img src="<?php echo URLROOT; ?>/uploads/<?php echo $profile->profile_pic ?: 'default-avatar.png'; ?>"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 <?php echo $blur_class; ?>"
            alt="<?php echo $profile->name; ?>">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

        <!-- Profile ID Badge (Top Left) -->
        <div class="absolute top-4 left-4">
            <div
                class="bg-black/60 backdrop-blur-md text-white px-4 py-1.5 rounded-full text-sm font-bold tracking-wide border border-white/20">
                PRO-<?php echo !empty($profile->form_no) ? $profile->form_no : $profile->user_id; ?>
            </div>
        </div>

        <!-- Bookmark Icon (Top Right) -->
        <div class="absolute top-4 right-4">
            <button
                class="bg-white/90 backdrop-blur text-gray-700 p-2.5 rounded-full shadow-sm hover:bg-white hover:text-pink-600 transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
            </button>
        </div>

        <!-- Premium Crown Badge (Top Right Corner Decor) -->
        <?php if ($is_premium): ?>
            <div class="absolute -top-1 -right-1">
                <div class="bg-gradient-to-br from-yellow-400 to-amber-600 p-1.5 rounded-bl-2xl shadow-lg">
                    <i class="fas fa-crown text-white text-xs"></i>
                </div>
            </div>
        <?php endif; ?>

        <!-- Progress Bar (Bottom) -->
        <div class="absolute bottom-6 left-4 right-4">
            <div class="flex items-center justify-between text-white text-xs font-bold mb-1.5 px-0.5">
                <span>Profile Complete</span>
                <span><?php echo $completeness; ?>%</span>
            </div>
            <div class="w-full bg-white/20 backdrop-blur-sm rounded-full h-1.5 overflow-hidden border border-white/10">
                <div class="bg-gradient-to-r from-gray-300 to-white h-full transition-all duration-1000"
                    style="width: <?php echo $completeness; ?>%"></div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-5 flex-1 flex flex-col">
        <!-- Name, Age and Premium Badge -->
        <div class="flex justify-between items-start mb-4">
            <div>
                <h3 class="font-bold text-xl text-gray-900 group-hover:text-pink-600 transition-colors">
                    <?php echo $profile->name; ?>
                    <span class="text-gray-400 font-medium ml-1"><?php echo $profile->age; ?></span>
                </h3>
            </div>
            <?php if ($is_premium): ?>
                <div
                    class="flex items-center bg-gray-900 text-white px-3 py-1.5 rounded-2xl shadow-lg transform group-hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-crown text-yellow-400 mr-2 text-xs"></i>
                    <span class="text-xs font-bold uppercase tracking-wider"><?php echo $profile->package_name; ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Location and Info -->
        <div class="space-y-3 mb-5">
            <div class="flex items-center text-gray-600 text-sm">
                <div class="w-6 h-6 rounded-full overflow-hidden mr-3 border border-gray-100 flex-shrink-0 shadow-sm">
                    <img src="https://flagcdn.com/w40/pk.png" class="w-full h-full object-cover" alt="Pakistan">
                </div>
                <span class="font-bold text-gray-800 mr-2"><?php echo $profile->country ?: 'Pakistan'; ?></span>
                <span class="text-gray-400 mr-2 font-light">|</span>
                <span class="text-gray-500 mr-2"><?php echo $profile->city ?: 'N/A'; ?></span>
                <span class="text-gray-300 mr-2">•</span>
                <span class="text-gray-500"><?php echo $profile->sect ?: 'Islam'; ?></span>
                <span class="text-gray-300 mx-2">•</span>
                <span class="text-gray-500"><?php echo $profile->religion ?: 'Islam'; ?></span>
            </div>
        </div>

        <!-- Tags -->
        <div class="flex flex-wrap gap-2 mb-6">
            <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-xl flex items-center shadow-sm">
                <i class="far fa-heart text-pink-400 mr-2 text-xs"></i>
                <span
                    class="text-xs font-bold text-gray-700"><?php echo !empty($profile->marital_status) ? $profile->marital_status : 'Single'; ?></span>
            </div>
            <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-xl flex items-center shadow-sm">
                <i class="fas fa-users text-blue-400 mr-2 text-xs"></i>
                <span
                    class="text-xs font-bold text-gray-700"><?php echo !empty($profile->caste) ? $profile->caste : 'N/A'; ?></span>
            </div>
            <div class="bg-gray-50 border border-gray-100 px-3 py-1.5 rounded-xl flex items-center shadow-sm">
                <i class="fas fa-graduation-cap text-indigo-400 mr-2 text-xs"></i>
                <span
                    class="text-xs font-bold text-gray-700 truncate max-w-[100px]"><?php echo !empty($profile->education) ? $profile->education : 'Bachelors'; ?></span>
            </div>
        </div>

        <!-- Action Button (Optional or just keep card as is) -->
        <div class="mt-auto">
            <a href="<?php echo URLROOT; ?>/profiles/show/<?php echo $profile->user_id; ?>"
                class="block w-full text-center py-3 rounded-2xl bg-gray-50 text-gray-900 text-sm font-bold border border-gray-100 hover:bg-pink-600 hover:text-white hover:border-pink-600 transition-all duration-300 group-hover:shadow-md">
                View Full Profile
            </a>
        </div>
    </div>
</div>