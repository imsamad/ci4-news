<?= $this->extend("layouts/page-layout"); ?>
<?= $this->section("content"); ?>



<div class="container mx-auto">
    <?php $validation = \Config\Services::validation() ?>

    <div class="bg-white mx-auto p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form action="<?= route_to("rt.loginHandler"); ?>" method="POST" class="space-y-6">
            <?= csrf_field(); ?>
            <?php if (!empty(session()->getFlashdata("success"))): ?>
                <div class="info" role="alert">
                    <?= session()->getFlashdata("success"); ?>
                </div>
            <?php endif; ?>


            <?php if (!empty(session()->getFlashdata("fail"))): ?>
                <div class="danger" role="alert">
                    <?= session()->getFlashdata("fail"); ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input type="text" id="email" name="email" value="<?= set_value("email") ?>" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Enter your email">
                <?php if ($validation->getError('email')): ?>
                    <span class="text-red-500 text-sm"><?= $validation->getError('email') ?></span>
                <?php endif; ?>
            </div>

            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" value="<?= set_value("password") ?>" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Enter your password">
                <?php if ($validation->getError('password')): ?>
                    <span class="text-red-500 text-sm"><?= $validation->getError('password') ?></span>
                <?php endif; ?>
            </div>


            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition-colors">Login</button>

        </form>


        <div class="my-6 text-center">
            <span class="text-gray-400">or</span>
        </div>


        <div class="text-center">
            <p class="text-gray-600">Don't have an account? <a href="<?= route_to("rt.signUpForm") ?>" class="text-blue-500 hover:underline">Sign up</a></p>
        </div>
    </div>

</div>



<?= $this->endSection("content"); ?>