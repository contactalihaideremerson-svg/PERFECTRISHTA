<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="max-w-3xl mx-auto px-4 py-20">
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-pink-50 text-center">
            <h2 class="text-2xl font-black text-gray-900">Confirm Your Subscription</h2>
            <p class="text-gray-600">You are subscribing to the <span class="font-bold text-pink-600">
                    <?php echo $data['package']->name; ?>
                </span> plan.</p>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-center mb-10 bg-gray-50 p-6 rounded-2xl">
                <div>
                    <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Total Amount</p>
                    <p class="text-3xl font-black text-gray-900">
                        <?php echo CURRENCY; ?>
                        <?php echo number_format($data['package']->price); ?>
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500 uppercase font-bold tracking-wider">Duration</p>
                    <p class="text-xl font-bold text-gray-900">
                        <?php echo $data['package']->duration_days; ?> Days
                    </p>
                </div>
            </div>

            <form action="<?php echo URLROOT; ?>/packages/request/<?php echo $data['package']->id; ?>" method="POST"
                class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-4">Choose Payment Method</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label
                            class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-pink-50 transition group">
                            <input type="radio" name="payment_method" value="EasyPaisa" required
                                class="w-5 h-5 text-pink-600 focus:ring-pink-500">
                            <div class="ml-4">
                                <p class="font-bold text-gray-900">EasyPaisa</p>
                                <p class="text-xs text-gray-500">0303-7282398 (Admin Account)</p>
                            </div>
                        </label>
                        <label
                            class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-pink-50 transition group">
                            <input type="radio" name="payment_method" value="JazzCash"
                                class="w-5 h-5 text-pink-600 focus:ring-pink-500">
                            <div class="ml-4">
                                <p class="font-bold text-gray-900">JazzCash</p>
                                <p class="text-xs text-gray-500">0303-7282398 (Admin Account)</p>
                            </div>
                        </label>
                        <label
                            class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-pink-50 transition group">
                            <input type="radio" name="payment_method" value="U-Paisa"
                                class="w-5 h-5 text-pink-600 focus:ring-pink-500">
                            <div class="ml-4">
                                <p class="font-bold text-gray-900">Sada Pay</p>
                                <p class="text-xs text-gray-500">0303-7282398 (Admin Account)</p>
                            </div>
                        </label>
                        <label
                            class="relative flex items-center p-4 border rounded-2xl cursor-pointer hover:bg-pink-50 transition group">
                            <input type="radio" name="payment_method" value="Bank Transfer"
                                class="w-5 h-5 text-pink-600 focus:ring-pink-500">
                            <div class="ml-4">
                                <p class="font-bold text-gray-900">Meezan Bank</p>
                                <p class="text-[10px] text-gray-500 leading-tight">
                                    Shoaib Shahid<br>
                                    05070111301612<br>
                                    PK37MEZN0005070111301612
                                </p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-2xl">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                After clicking confirm, please send the amount to the provided account and share the
                                screenshot with Admin. Your package will be activated after manual verification.
                            </p>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-pink-600 text-white py-4 rounded-2xl font-black text-lg hover:bg-pink-700 transition shadow-lg shadow-pink-100">
                    Confirm Subscription Request
                </button>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>