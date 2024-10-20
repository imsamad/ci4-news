<?= $this->extend("layouts/page-layout"); ?>
<?= $this->section("content"); ?>


<div class="container mx-auto">
    <?php $validation = \Config\Services::validation() ?>
    <div class="bg-white p-8 mx-auto rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Signup</h2>

        <form action="<?= route_to("rt.signUpHandler") ?>" method="POST" class="space-y-6">
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
                <label for="name" class="block text-gray-700">Name</label>
                <input value="<?= set_value("name") ?>" type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Enter your name">
                <?php if ($validation->getError('name')): ?>
                    <span class="text-red-500 text-sm"><?= $validation->getError('name') ?></span>
                <?php endif; ?>

            </div>

            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input value="<?= set_value("email") ?>" type="text" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Enter your email">

                <?php if ($validation->getError('email')): ?>
                    <span class="text-red-500 text-sm"><?= $validation->getError('email') ?></span>
                <?php endif; ?>
            </div>

            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input value="<?= set_value("password") ?>" type="password" id="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none" placeholder="Enter your password">

                <?php if ($validation->getError('password')): ?>
                    <span class="text-red-500 text-sm"><?= $validation->getError('password') ?></span>
                <?php endif; ?>
            </div>


            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition-colors">Signup</button>


        </form>

        <div class="my-6 text-center">
            <span class="text-gray-400">or</span>
        </div>

        <div class="text-center">
            <p class="text-gray-600">Don't have an account? <a href="<?= route_to("rt.login") ?>" class="text-blue-500 hover:underline">Log In</a></p>
        </div>
    </div>

</div>



<?= $this->endSection("content"); ?>