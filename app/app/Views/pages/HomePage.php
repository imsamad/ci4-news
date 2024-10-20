<?= $this->extend("layouts/page-layout"); ?>

<?= $this->section("content"); ?>
<div class="container mx-auto">
    <h2 class="text-3xl font-bold text-center mb-8">Our Posts</h2>

    <?php if (!empty($posts)) : ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($posts as $post) : ?>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">
                        <?= esc($post['title']); ?>
                    </h3>
                    <p class="text-gray-600 mb-4">
                        <?= esc($post['body']); ?>
                    </p>
                    <p class="text-gray-600 mb-4 italic">
                        by: <?= esc($post['name']); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="text-center">No posts available at the moment.</p>
    <?php endif; ?>
</div>
<?= $this->endSection("content"); ?>