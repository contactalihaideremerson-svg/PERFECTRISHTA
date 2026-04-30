<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Create your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Or
            <a href="<?php echo URLROOT; ?>/users/login" class="font-medium text-pink-600 hover:text-pink-500">
                login to your existing account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="<?php echo URLROOT; ?>/users/register" method="POST">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Full Name
                    </label>
                    <div class="mt-1">
                        <input id="name" name="name" type="text" value="<?php echo $data['name']; ?>"
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['name_err'])) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        <span class="text-red-500 text-xs mt-1">
                            <?php echo $data['name_err']; ?>
                        </span>
                    </div>
                </div>

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
                    <label for="phone" class="block text-sm font-medium text-gray-700">
                        Phone Number
                    </label>
                    <div class="mt-1">
                        <input id="phone" name="phone" type="text" value="<?php echo $data['phone']; ?>"
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
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

                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <div class="mt-1">
                        <input id="confirm_password" name="confirm_password" type="password"
                            value="<?php echo $data['confirm_password']; ?>"
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['confirm_password_err'])) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                        <span class="text-red-500 text-xs mt-1">
                            <?php echo $data['confirm_password_err']; ?>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="package_id" class="block text-sm font-medium text-gray-700">
                        Select Package
                    </label>
                    <div class="mt-1">
                        <select id="package_id" name="package_id"
                            class="appearance-none block w-full px-3 py-2 border <?php echo (!empty($data['package_err'])) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm">
                            <option value="">-- Choose a Package --</option>
                            <?php foreach ($data['packages'] as $package): ?>
                                <option value="<?php echo $package->id; ?>" <?php echo ($data['package_id'] == $package->id) ? 'selected' : ''; ?>>
                                    <?php echo $package->name; ?> - <?php echo CURRENCY . $package->price; ?>
                                    (<?php echo $package->duration_days; ?> days)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-red-500 text-xs mt-1">
                            <?php echo $data['package_err']; ?>
                        </span>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>