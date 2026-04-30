<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <?php echo flash('register_success'); ?>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Sign in to your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <a href="<?php echo URLROOT; ?>/users/register" class="font-medium text-pink-600 hover:text-pink-500">
                create a new account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="<?php echo URLROOT; ?>/users/login" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" value="<?php echo $data['email']; ?>"
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['email_err'])) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        <span class="text-red-500 text-xs mt-1">
                            <?php echo $data['email_err']; ?>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" value="<?php echo $data['password']; ?>"
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['password_err'])) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        <span class="text-red-500 text-xs mt-1">
                            <?php echo $data['password_err']; ?>
                        </span>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox"
                            class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            Remember me
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-pink-600 hover:text-pink-500">
                            Forgot your password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Pending Approval Modal -->
<?php if (!empty($data['email_err']) && strpos($data['email_err'], 'pending approval') !== false): ?>
    <div id="pendingModal" class="fixed inset-0 z-[10001] overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Account Pending Approval
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                <?php echo $data['email_err']; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-100 text-left">
                    <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-2">Payment Details</h4>
                    <div class="grid grid-cols-2 gap-4 text-[10px]">
                        <div>
                            <p class="font-bold text-pink-600">Mobile Wallets</p>
                            <p class="text-gray-600">EasyPaisa / JazzCash / SadaPay</p>
                            <p class="font-bold text-gray-900">0300-4522210</p>
                        </div>
                        <div>
                            <p class="font-bold text-pink-600">Meezan Bank</p>
                            <p class="text-gray-600">MUHAMMAD ASGHAR</p>
                            <p class="font-bold text-gray-900">05130107233163</p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-6 space-y-3">
                    <a href="https://wa.me/923200005601?text=Hi, my account is pending approval. Please activate it."
                        target="_blank"
                        class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                        <i class="fab fa-whatsapp mr-2 mt-1"></i> Contact Admin on WhatsApp
                    </a>
                    <button type="button" onclick="document.getElementById('pendingModal').style.display='none'"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>