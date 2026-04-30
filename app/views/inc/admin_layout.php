<?php function admin_header($title = 'Admin Dashboard')
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <?php require APPROOT . '/views/inc/translator.php'; ?>
        <title>
            <?php echo $title; ?> | Perfect Rishta.Online
        </title>
    </head>

    <body class="bg-gray-100 font-sans">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside class="w-64 bg-gray-900 text-white flex-shrink-0 hidden md:block">
                <div class="p-6">
                    <a href="<?php echo URLROOT; ?>/admin" class="text-xl font-bold text-pink-500">PR Admin</a>
                </div>
                <nav class="mt-6 px-4 space-y-2">
                    <a href="<?php echo URLROOT; ?>/admin"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition <?php echo (strpos($_GET['url'], 'admin/index') !== false || $_GET['url'] == 'admin') ? 'bg-gray-800 text-pink-500' : ''; ?>">
                        <i class="fas fa-chart-line w-6"></i> Dashboard
                    </a>
                    <a href="<?php echo URLROOT; ?>/admin/users"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition <?php echo (strpos($_GET['url'], 'admin/users') !== false) ? 'bg-gray-800 text-pink-500' : ''; ?>">
                        <i class="fas fa-users w-6"></i> User Management
                    </a>
                    <a href="<?php echo URLROOT; ?>/admin/requests"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition <?php echo (strpos($_GET['url'], 'admin/requests') !== false) ? 'bg-gray-800 text-pink-500' : ''; ?>">
                        <i class="fas fa-user-plus w-6"></i> Reg. Requests
                    </a>
                    <a href="<?php echo URLROOT; ?>/admin/packages"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition <?php echo (strpos($_GET['url'], 'admin/packages') !== false) ? 'bg-gray-800 text-pink-500' : ''; ?>">
                        <i class="fas fa-box w-6"></i> Packages
                    </a>
                    <a href="<?php echo URLROOT; ?>/admin/subscriptions"
                        class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition <?php echo (strpos($_GET['url'], 'admin/subscriptions') !== false) ? 'bg-gray-800 text-pink-500' : ''; ?>">
                        <i class="fas fa-credit-card w-6"></i> Package Subs
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-gray-800 transition">
                        <i class="fas fa-file-alt w-6"></i> CMS Pages
                    </a>
                    <div class="pt-10">
                        <a href="<?php echo URLROOT; ?>/users/logout"
                            class="flex items-center p-3 rounded-lg text-red-400 hover:bg-red-500/10 transition">
                            <i class="fas fa-sign-out-alt w-6"></i> Logout
                        </a>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                <header class="bg-white shadow-sm p-4 flex justify-between items-center">
                    <button class="md:hidden text-gray-600"><i class="fas fa-bars"></i></button>
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">Welcome, <strong>Admin</strong></span>
                            <img src="https://ui-avatars.com/api/?name=Admin&background=db2777&color=fff"
                                class="w-8 h-8 rounded-full">
                        </div>
                    </div>
                </header>
                <div class="p-8">
                <?php } ?>

                <?php function admin_footer()
                { ?>
                </div>
            </main>
        </div>
    </body>

    </html>
<?php } ?>