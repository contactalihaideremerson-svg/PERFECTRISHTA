</main>
<footer class="bg-gray-900 text-gray-400 pt-20 pb-10 overflow-hidden relative">
    <!-- Subtle Background Element -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-pink-600/5 rounded-full blur-3xl -mr-48 -mt-48"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <!-- Brand Column -->
            <div class="col-span-1 md:col-span-1">
                <a href="<?php echo URLROOT; ?>" class="text-3xl font-extrabold text-white mb-6 block">
                    Perfect <span class="text-pink-500">Rishta.Online</span>
                </a>
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    Pakistan's leading matrimonial platform connecting hearts globally. We help you find your perfect
                    life partner with absolute security and verified trust.
                </p>
                <div class="flex space-x-5">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition-all duration-300">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white font-bold text-lg mb-6">Explore</h3>
                <ul class="space-y-4 text-sm">
                    <li><a href="<?php echo URLROOT; ?>" class="hover:text-pink-500 transition-colors">Find Matches</a>
                    </li>
                    <li><a href="<?php echo URLROOT; ?>/pages/packages"
                            class="hover:text-pink-500 transition-colors">Premium Plans</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/how_it_works"
                            class="hover:text-pink-500 transition-colors">How it Works</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/about" class="hover:text-pink-500 transition-colors">Our
                            Story</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/contact"
                            class="hover:text-pink-500 transition-colors">Success Stories</a></li>
                </ul>
            </div>

            <!-- Legal & Support -->
            <div>
                <h3 class="text-white font-bold text-lg mb-6">Support</h3>
                <ul class="space-y-4 text-sm">
                    <li><a href="<?php echo URLROOT; ?>/pages/privacy"
                            class="hover:text-pink-500 transition-colors">Privacy Policy</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/terms" class="hover:text-pink-500 transition-colors">Terms
                            of Use</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/data_deletion"
                            class="hover:text-pink-500 transition-colors">Safety Tips</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/contact"
                            class="hover:text-pink-500 transition-colors">Help Center</a></li>
                </ul>
            </div>

            <!-- Contact/Location -->
            <div>
                <h3 class="text-white font-bold text-lg mb-6">Get in Touch</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt text-pink-500 mt-1 mr-3"></i>
                        <span>Perfect Rishta.Online Garden Town, Al-Quraish, Multan, Punjab, Pakistan</span>
                         <i class="fas fa-map-marker-alt text-pink-500 mt-1 mr-3"></i>
                        <span>Perfect Rishta.Online ChaseUp Plaza Bosan Rd, Multan, Punjab, Pakistan</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt text-pink-500 mr-3"></i>
                        <span>+92 303 7282398</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-pink-500 mr-3"></i>
                        <span>info@perfectrishta.online</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright Line -->
        <div class="border-t border-gray-800 pt-10 flex flex-col md:flex-row justify-between items-center text-sm">
            <p class="text-gray-500 mb-4 md:mb-0">
                &copy; <?php echo date('Y'); ?> <span class="text-white font-medium">Perfect Rishta.Online</span>. All
                rights reserved.
            </p>
            <p class="text-gray-500 flex items-center">
                Developed with <i class="fas fa-heart text-pink-600 mx-1"></i> by <a href="#"
                    class="text-white hover:text-pink-500 ml-1 transition">Tech Tube Hub</a>
            </p>
        </div>
    </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/923037282398"
    class="fixed bottom-8 right-8 z-[9999] bg-[#25D366] text-white w-14 h-14 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 transform hover:scale-110 group"
    target="_blank" aria-label="Contact us on WhatsApp">
    <i class="fab fa-whatsapp text-3xl group-hover:scale-110 transition-transform"></i>
    <span
        class="absolute right-full mr-4 bg-gray-900 text-white px-3 py-1 rounded text-sm opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
        Chat with us
    </span>
</a>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Swiper Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Slider
        if (document.querySelector('.hero-swiper')) {
            const heroSwiper = new Swiper('.hero-swiper', {
                loop: true,
                speed: 2000,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                Observer: true,
                observeParents: true,
            });
        }

        // Testimonial Slider
        if (document.querySelector('.testimonial-swiper')) {
            const testimonialSwiper = new Swiper('.testimonial-swiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 7000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
                Observer: true,
                observeParents: true,
            });
        }
    });
</script>

</body>
</html>