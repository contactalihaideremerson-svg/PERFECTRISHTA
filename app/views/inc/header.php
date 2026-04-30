<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>

        /* NAV LINKS */
        .nav-link {
            position: relative;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            transition: 0.3s;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            background: #ec4899;
            left: 0;
            bottom: -4px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #ec4899;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* MOBILE LINKS */
        .mobile-link {
            color: #374151;
            font-weight: 500;
            transition: 0.3s;
        }

        .mobile-link:hover {
            color: #ec4899;
        }

        /* BUTTON */
        .btn-primary {
            background: linear-gradient(135deg, #ec4899, #db2777);
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
            box-shadow: 0 4px 14px rgba(236,72,153,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(236,72,153,0.4);
        }

        /* HAMBURGER */
        .bar {
            width: 25px;
            height: 3px;
            background: #374151;
            border-radius: 2px;
            transition: 0.3s;
        }

        /* Hamburger animation */
        .open .bar:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .open .bar:nth-child(2) {
            opacity: 0;
        }

        .open .bar:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

    </style>
</head>

<body class="bg-gray-50 font-sans">

<!-- ================= NAVBAR ================= -->
<nav class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="<?php echo URLROOT; ?>" class="flex items-center gap-3">
                <img src="<?php echo URLROOT; ?>/public/uploads/LOGO.png"
                     alt="Logo"
                     class="h-10 md:h-12 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-10">
                <a href="<?php echo URLROOT; ?>" class="nav-link">Home</a>
                <a href="<?php echo URLROOT; ?>/pages/packages" class="nav-link">Packages</a>
                <a href="<?php echo URLROOT; ?>/pages/about" class="nav-link">About</a>
                <a href="<?php echo URLROOT; ?>/pages/contact" class="nav-link">Contact</a>
            </div>

            <!-- Right Side -->
            <div class="hidden lg:flex items-center space-x-4">

                <?php if (isset($_SESSION['user_id'])): ?>

                    <a href="<?php echo URLROOT; ?>/users/dashboard"
                       class="text-gray-700 font-medium hover:text-pink-500">
                       Dashboard
                    </a>

                    <a href="<?php echo URLROOT; ?>/users/logout"
                       class="btn-primary">
                       Logout
                    </a>

                <?php else: ?>

                    <a href="<?php echo URLROOT; ?>/users/login"
                       class="text-gray-700 font-medium hover:text-pink-500">
                       Login
                    </a>

                    <a href="<?php echo URLROOT; ?>/users/register"
                       class="btn-primary">
                       Register
                    </a>

                <?php endif; ?>

            </div>

            <!-- Mobile Button -->
            <button id="menu-btn" onclick="toggleMobileMenu()" class="lg:hidden flex flex-col gap-1.5">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu"
         class="max-h-0 overflow-hidden transition-all duration-500 bg-white/95 backdrop-blur-md">

        <div class="flex flex-col p-6 space-y-5 text-lg">

            <a href="<?php echo URLROOT; ?>" class="mobile-link">Home</a>
            <a href="<?php echo URLROOT; ?>/pages/packages" class="mobile-link">Packages</a>
            <a href="<?php echo URLROOT; ?>/pages/about" class="mobile-link">About</a>
            <a href="<?php echo URLROOT; ?>/pages/contact" class="mobile-link">Contact</a>

            <hr>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?php echo URLROOT; ?>/users/dashboard">Dashboard</a>
                <a href="<?php echo URLROOT; ?>/users/logout" class="btn-primary text-center">Logout</a>
            <?php else: ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
                <a href="<?php echo URLROOT; ?>/users/register" class="btn-primary text-center">Register</a>
            <?php endif; ?>

        </div>
    </div>

</nav>

<!-- ================= MAIN CONTENT ================= -->
<main class="pt-0">


<!-- ================= SCRIPT ================= -->
<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    const btn = document.getElementById('menu-btn');

    // Toggle height
    if (menu.style.maxHeight) {
        menu.style.maxHeight = null;
        btn.classList.remove('open');
    } else {
        menu.style.maxHeight = menu.scrollHeight + "px";
        btn.classList.add('open');
    }
}
</script>

</body>
</html>