<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Choose Your Plan</h2>
            <p class="mt-4 text-xl text-gray-600 max-w-2xl mx-auto">Upgrade your experience and find your perfect match
                faster with our premium features.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($data['packages'] as $package): ?>
                <?php
                $features = json_decode($package->features, true);
                if (!is_array($features))
                    $features = [];
                ?>
                <div
                    class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 flex flex-col hover:shadow-xl transition duration-300 relative overflow-hidden <?php echo ($package->name == 'Premium' || $package->name == 'Standard') ? 'ring-2 ring-pink-500' : ''; ?>">
                    <?php if ($package->name == 'Premium' || $package->name == 'Standard'): ?>
                        <div
                            class="absolute top-0 right-0 bg-pink-500 text-white text-[10px] font-bold uppercase px-6 py-1 rotate-45 translate-x-6 translate-y-3">
                            Popular</div>
                    <?php endif; ?>

                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            <?php echo $package->name; ?>
                        </h3>
                        <div class="flex items-baseline">
                            <span class="text-4xl font-extrabold text-gray-900">
                                <?php echo CURRENCY; ?>     <?php echo number_format($package->price); ?>
                            </span>
                            <span class="text-gray-500 ml-1">/
                                <?php echo $package->duration_days; ?> days
                            </span>
                        </div>
                    </div>

                    <ul class="space-y-4 mb-10 flex-1">
                        <?php foreach ($features as $feature): ?>
                            <li class="flex items-center text-sm text-gray-700">
                                <i class="fas fa-check-circle text-pink-500 mr-3 text-lg"></i>
                                <?php echo $feature; ?>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($features)): ?>
                            <li class="text-gray-400 text-sm italic">Basic access included</li>
                        <?php endif; ?>
                    </ul>

                    <?php if (isLoggedIn()): ?>
                        <?php if (isset($data['subscription']) && $data['subscription'] && $data['subscription']->package_id == $package->id && $data['subscription']->status == 'active'): ?>
                            <button disabled
                                class="w-full text-center py-3 rounded-xl font-bold bg-green-100 text-green-700 cursor-not-allowed">
                                Current Plan
                            </button>
                        <?php elseif (isset($data['subscription']) && $data['subscription'] && $data['subscription']->package_id == $package->id && $data['subscription']->status == 'pending'): ?>
                            <button disabled
                                class="w-full text-center py-3 rounded-xl font-bold bg-yellow-100 text-yellow-700 cursor-not-allowed">
                                Approval Pending
                            </button>
                        <?php else: ?>
                            <a href="<?php echo URLROOT; ?>/packages/buy/<?php echo $package->id; ?>"
                                class="w-full text-center py-3 rounded-xl font-bold transition <?php echo ($package->name == 'Premium' || $package->name == 'Standard') ? 'bg-pink-600 text-white hover:bg-pink-700 shadow-lg shadow-pink-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                                Subscribe Now
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo URLROOT; ?>/users/register"
                            class="w-full text-center py-3 rounded-xl font-bold transition <?php echo ($package->name == 'Premium' || $package->name == 'Standard') ? 'bg-pink-600 text-white hover:bg-pink-700 shadow-lg shadow-pink-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'; ?>">
                            Get Started
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>