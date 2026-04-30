<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Hero Section -->
<div class="relative w-full overflow-hidden pt-32 pb-20 min-h-[80vh] flex items-center">
    <!-- Background Video -->
    <div class="absolute inset-0 z-0 overflow-hidden bg-black flex justify-center items-center">
        <iframe 
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-auto h-auto min-w-[115%] min-h-[115%] aspect-video max-w-none pointer-events-none scale-[1.15]"
            src="https://www.youtube.com/embed/2DFYBb4VbS8?autoplay=1&mute=1&controls=0&showinfo=0&rel=0&loop=1&start=25&end=60&playlist=2DFYBb4VbS8&modestbranding=1&playsinline=1"
            frameborder="0" 
            allow="autoplay; encrypted-media" 
            allowfullscreen>
        </iframe>
        <!-- Dark/Gradient Overlay for readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70"></div>
    </div>

    <div class="relative z-20 flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto text-center">
        
        <!-- Trust Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-md text-white border border-white/30 font-semibold text-sm mb-6">
            <span class="text-yellow-400">🌟</span> Trusted by thousands of families across Pakistan
        </div>

        <!-- Headline -->
        <h1 class="text-4xl sm:text-5xl md:text-7xl font-extrabold text-white tracking-tight mb-6 drop-shadow-lg">
            Find Your Perfect <span class="text-pink-400">Rishta</span>
        </h1>

        <!-- Subtitle -->
        <p class="text-gray-100 font-medium text-base md:text-xl max-w-2xl mx-auto mb-8 md:mb-10 px-2 drop-shadow-md">
            A secure, family-friendly platform designed to bring hearts together with respect, tradition, and modern convenience.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 mb-16 relative z-50">
            <a href="<?php echo URLROOT; ?>/users/register" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-4 px-8 rounded-full shadow-lg transition flex items-center justify-center gap-2">
                Create Profile <i class="fas fa-arrow-right"></i>
            </a>
            <a href="#discover" class="bg-white hover:bg-gray-50 text-pink-600 font-bold py-4 px-8 rounded-full shadow-md border border-pink-100 transition flex items-center justify-center gap-2">
                Browse Matches <i class="fas fa-users"></i>
            </a>
        </div>

        <!-- Search Bar -->
        <div class="w-full max-w-4xl bg-white/95 backdrop-blur rounded-3xl p-5 shadow-xl border border-pink-100 relative z-50">
            <form action="<?php echo URLROOT; ?>/pages/index" method="GET" class="flex flex-col md:flex-row gap-5 items-stretch md:items-end">
                
                <!-- Looking For -->
                <div class="flex-1 text-left w-full">
                    <label class="text-pink-600 font-bold text-xs uppercase tracking-wider ml-1 mb-1 block">Looking For</label>
                    <select name="gender" class="w-full h-12 bg-transparent text-gray-800 text-base border-b-2 border-gray-100 focus:border-pink-500 outline-none transition-all font-semibold">
                        <option value="female" <?php echo (($data['filters']['gender'] ?? '') == 'female') ? 'selected' : ''; ?>>A Bride</option>
                        <option value="male" <?php echo (($data['filters']['gender'] ?? '') == 'male') ? 'selected' : ''; ?>>A Groom</option>
                    </select>
                </div>

                <!-- Age Range -->
                <div class="flex-1 text-left w-full">
                    <label class="text-pink-600 font-bold text-xs uppercase tracking-wider ml-1 mb-1 block">Age Range</label>
                    <div class="flex items-center gap-2 border-b-2 border-gray-100 focus-within:border-pink-500 transition-all h-12">
                        <input type="number" name="min_age" value="<?php echo $data['filters']['min_age'] ?? '20'; ?>" class="w-full bg-transparent text-gray-800 font-semibold outline-none text-center">
                        <span class="text-gray-400">-</span>
                        <input type="number" name="max_age" value="<?php echo $data['filters']['max_age'] ?? '35'; ?>" class="w-full bg-transparent text-gray-800 font-semibold outline-none text-center">
                        <span class="text-gray-500 text-sm mr-2">Years</span>
                    </div>
                </div>

                <!-- City -->
                <div class="flex-1 text-left w-full">
                    <label class="text-pink-600 font-bold text-xs uppercase tracking-wider ml-1 mb-1 block">City</label>
                    <select name="city" class="w-full h-12 bg-transparent text-gray-800 text-base border-b-2 border-gray-100 focus:border-pink-500 outline-none transition-all font-semibold">
                        <option value="">Any City</option>
                        <option value="Lahore" <?php echo (($data['filters']['city'] ?? '') == 'Lahore') ? 'selected' : ''; ?>>Lahore</option>
                        <option value="Karachi" <?php echo (($data['filters']['city'] ?? '') == 'Karachi') ? 'selected' : ''; ?>>Karachi</option>
                        <option value="Islamabad" <?php echo (($data['filters']['city'] ?? '') == 'Islamabad') ? 'selected' : ''; ?>>Islamabad</option>
                        <option value="Multan" <?php echo (($data['filters']['city'] ?? '') == 'Multan') ? 'selected' : ''; ?>>Multan</option>
                    </select>
                </div>

                <!-- Search Button -->
                <div class="w-full md:w-auto mt-2 md:mt-0">
                    <button type="submit" class="bg-pink-100 hover:bg-pink-200 text-pink-600 font-bold h-12 px-8 rounded-xl transition flex items-center justify-center gap-2 w-full md:w-auto">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>


<section id="discover" class="py-16 bg-pink-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-pink-600 sm:text-4xl">Featured Matches</h2>
                <p class="mt-2 text-sm text-gray-500">Discover recently joined, verified profiles.</p>
            </div>
            <a href="<?php echo URLROOT; ?>/profiles" class="text-pink-600 font-bold hover:text-pink-700 text-sm hidden sm:block">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Listing Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php if (empty($data['profiles'])): ?>
                <div class="col-span-full py-20 text-center">
                    <div class="text-pink-200 text-6xl mb-4"><i class="fas fa-search"></i></div>
                    <h3 class="text-xl font-bold text-gray-900">No matches found</h3>
                    <p class="text-gray-500">Try adjusting your filters to see more results.</p>
                </div>
            <?php else: ?>
                <?php foreach ($data['profiles'] as $profile): ?>
                    <?php require APPROOT . '/views/inc/profile_card.php'; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="mt-8 text-center sm:hidden">
            <a href="<?php echo URLROOT; ?>/profiles" class="text-pink-600 font-bold hover:text-pink-700 text-sm">
                View All <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-pink-600 mb-4">How It Works</h2>
        <p class="text-pink-400 mb-12 max-w-2xl mx-auto text-sm">Your journey to finding the perfect match is simple, secure, and respectful of our traditions.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
            <!-- Connecting Line -->
            <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-pink-100 -z-10"></div>

            <!-- Step 1 -->
            <div class="relative group">
                <div class="w-24 h-24 bg-pink-50 border-2 border-pink-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-105 transition-transform duration-300 relative z-10 rotate-3">
                    <div class="w-full h-full bg-white rounded-2xl border-2 border-pink-100 flex items-center justify-center -rotate-3">
                        <span class="text-3xl text-pink-500"><i class="far fa-user"></i></span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-pink-600 mb-2">1. Create Profile</h3>
                <p class="text-pink-400 text-xs px-4">Register and complete your profile with accurate details and preferences.</p>
            </div>

            <!-- Step 2 -->
            <div class="relative group">
                <div class="w-24 h-24 bg-pink-50 border-2 border-pink-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-105 transition-transform duration-300 relative z-10 -rotate-3">
                    <div class="w-full h-full bg-white rounded-2xl border-2 border-pink-100 flex items-center justify-center rotate-3">
                        <span class="text-3xl text-pink-500"><i class="fas fa-search"></i></span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-pink-600 mb-2">2. Find Matches</h3>
                <p class="text-pink-400 text-xs px-4">Browse verified profiles that align with your family's expectations.</p>
            </div>

            <!-- Step 3 -->
            <div class="relative group">
                <div class="w-24 h-24 bg-pink-50 border-2 border-pink-200 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-sm group-hover:scale-105 transition-transform duration-300 relative z-10 rotate-3">
                    <div class="w-full h-full bg-white rounded-2xl border-2 border-pink-100 flex items-center justify-center -rotate-3">
                        <span class="text-3xl text-pink-500"><i class="far fa-comments"></i></span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-pink-600 mb-2">3. Connect Safely</h3>
                <p class="text-pink-400 text-xs px-4">Initiate contact securely, involve parents when the time is right.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Banner -->
<section class="py-12 bg-pink-600 bg-[url('https://www.transparenttextures.com/patterns/cross-stripes.png')] relative">
    <div class="absolute inset-0 bg-pink-600 opacity-90"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
            <div>
                <h4 class="text-4xl font-extrabold mb-1">50k+</h4>
                <p class="text-sm font-semibold opacity-90">Verified Profiles</p>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold mb-1">10k+</h4>
                <p class="text-sm font-semibold opacity-90">Success Stories</p>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold mb-1">100%</h4>
                <p class="text-sm font-semibold opacity-90">Privacy Secured</p>
            </div>
            <div>
                <h4 class="text-4xl font-extrabold mb-1">24/7</h4>
                <p class="text-sm font-semibold opacity-90">Customer Support</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-pink-50/30">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-pink-50 rounded-[3rem] p-10 md:p-16 border border-pink-100 shadow-xl">
            <h2 class="text-3xl md:text-4xl font-extrabold text-pink-900 mb-4">Ready to find your life partner?</h2>
            <p class="text-pink-700 mb-10 max-w-xl mx-auto">Join Pakistan's most trusted matrimonial platform today. Set up your profile in minutes and start connecting with verified families.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?php echo URLROOT; ?>/users/register" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-4 px-8 rounded-full shadow-lg transition">
                    Register for Free
                </a>
                <a href="<?php echo URLROOT; ?>/pages/contact" class="bg-white hover:bg-gray-50 text-pink-600 font-bold py-4 px-8 rounded-full shadow-md border border-pink-200 transition">
                    Talk to an Advisor
                </a>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>