<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
            <i class="fas fa-check text-2xl text-green-600"></i>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900">
            Registration Successful!
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Your account has been created and is pending admin approval.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <h3 class="text-lg font-medium text-gray-900 border-b pb-4 mb-4">Account Details</h3>

            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                    <dd class="mt-1 text-sm text-gray-900 font-semibold">
                        <?php echo $data['user']->name; ?>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <?php echo $data['user']->email; ?>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <?php echo $data['user']->phone; ?>
                    </dd>
                </div>
                <div class="sm:col-span-1">
                    <dt class="text-sm font-medium text-gray-500">Selected Package</dt>
                    <dd class="mt-1 text-sm text-pink-600 font-bold">
                        <?php echo $data['subscription']->package_name; ?>
                    </dd>
                </div>
            </dl>

            <div class="mt-8 bg-pink-50 rounded-lg p-6 border border-pink-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fab fa-whatsapp text-2xl text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-pink-800">Next Step: Payment Confirmation</h3>
                        <div class="mt-2 text-sm text-pink-700">
                            <p>
                                To activate your account, please send a message to our Admin on WhatsApp with your
                                payment confirmation.
                            </p>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div>
                                    <p class="font-bold text-gray-900 border-b border-pink-100 pb-1 mb-2">WhatsApp
                                        Contact</p>
                                    <p class="text-xs">
                                        <strong>Number:</strong> 03037282398
                                    </p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 border-b border-pink-100 pb-1 mb-2">Mobile Wallets</p>
                                    <p class="text-[10px] leading-tight">
                                        <strong>EasyPaisa/JazzCash</strong><br>
                                        Number: 03037282398<br>
                                        Admin Account
                                    </p>
                                </div>
                                <div class="md:col-span-2 lg:col-span-1">
                                    <p class="font-bold text-gray-900 border-b border-pink-100 pb-1 mb-2">Bank Details
                                    </p>
                                    <p class="text-[10px] leading-tight">
                                        <strong>Meezan Bank</strong><br>
                                        Title: SHOAIB SHAHID<br>
                                        Acc: 05070111301612
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="https://wa.me/923037282398?text=Hi, I just registered on Perfect Rishta. My email is <?php echo $data['user']->email; ?>. Please activate my account."
                                target="_blank"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <i class="fab fa-whatsapp mr-2"></i> Confirm on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="<?php echo URLROOT; ?>/users/login"
                    class="text-sm font-medium text-pink-600 hover:text-pink-500">
                    Return to Login
                </a>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
    // Link for wa.me usually uses international format without + or 00
    // If the number is 03200005601, international is 923200005601
</script>