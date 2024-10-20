<?= $this->extend("layouts/page-layout") ?>

<?= $this->section("content") ?>
<?php
if (isset($post)) {
    $title = $post["title"];
    $body = $post["body"];
    $postId = $post["id"];
    $isEdit = true;
    $label = "Edit";
} else {
    $title = "";
    $body = "";
    $isEdit = false;
    $label = "Create";
}

?>
<div class="container mx-auto mt-8  max-w-lg">
    <a href="javascript:history.back()" class="bg-green-500 btn inline-block my-2">Go Back</a>
    <h2 class="text-2xl font-bold mb-6 mx-auto flex justify-center">
        <?= $label ?> New Post</h2>

    <?php $validation = \Config\Services::validation() ?>

    <form action="<?= $isEdit ? route_to("rt.editPostHandler", $postId) : route_to("rt.createPostHandler"); ?>" method="POST" class="mx-auto w-full bg-white p-6 rounded-md shadow-md">
        <?= csrf_field() ?>
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

        <!-- ttitle -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" value="<?= set_value('title', $title) ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <?php if ($validation->getError('title')): ?>
            <span class="danger"><?= $validation->getError('title') ?></span>
        <?php endif; ?>



        <!-- Body -->
        <div class="mb-4">
            <label for="body" class="block text-gray-700 font-bold mb-2">Body</label>
            <textarea required name="body" id="body" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required><?= set_value("body", $body) ?></textarea>
        </div>
        <?php if ($validation->getError('body')): ?>
            <span class="danger"><?= $validation->getError('body') ?></span>
        <?php endif; ?>

        <!-- submit btn -->
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                <?= $label ?>

                Post
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>