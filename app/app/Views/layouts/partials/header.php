<?php

use \App\Libraries\Auth; ?>

<header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-5">
        <a href="<?= route_to("rt.homepage") ?>">
            <div class="text-2xl font-bold">Teapost</div>
        </a>
        <nav>
            <ul class="flex space-x-6">
                <li><a href="<?= route_to("rt.homepage") ?>" class="text-gray-700 hover:text-gray-900">Home</a></li>

                <?php if (!Auth::isLoggedIn()): ?>
                    <!-- Show when the user is not logged in -->
                    <li><a href="<?= route_to("rt.login") ?>" class="text-gray-700 hover:text-gray-900">Login</a></li>
                    <li><a href="<?= route_to("rt.signUpForm") ?>" class="text-gray-700 hover:text-gray-900">Signup</a></li>
                <?php else: ?>
                    <!-- Show when the user is logged in -->
                    <li><a href="<?= route_to("rt.profilepage") ?>" class="text-gray-700 hover:text-gray-900">Profile</a></li>
                    <?php if (Auth::isAdmin()): ?>
                        <li><a href="<?= route_to("rt.adminDashboard") ?>" class="text-gray-700 hover:text-gray-900">AdminDash</a></li>
                    <?php endif; ?>

                    <li><a href="<?= route_to("rt.logout") ?>" class="text-gray-700 hover:text-gray-900">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>