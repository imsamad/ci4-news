<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<div class="container mx-auto">
    <h2 class="text-3xl font-bold text-center mb-8">Forgot Your Password?</h2>
    <p class="text-center mb-6">Enter your email address below and we’ll send you a link to reset your password.</p>

    <form action="<?= base_url('reset-password') ?>" method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <input type="email" id="email" name="email" required
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-500">
            Send Reset Link
        </button>
    </form>

    <p class="mt-4 text-center">
        <a href="<?= route_to('rt.login') ?>" class="text-blue-600 hover:text-blue-500">Back to Login</a>
    </p>
</div>
<?= $this->endSection() ?>