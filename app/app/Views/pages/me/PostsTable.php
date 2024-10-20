<?= $this->extend("layouts/page-layout") ?>

<?= $this->section("content") ?>
<?php
$isAdmin = isset($is_admin) ? $is_admin : false;

?>
<script async>
    $(document).on("click", "#delete-btn", function() {
        const postId = $(this).data("post-id");
        const row = $(this).closest("tr");
        const url = "<?= base_url('/me/posts/') ?>" + postId;

        if (confirm("Are you sure you want to delete this post?")) {
            $.ajax({
                url,
                type: 'DELETE',
                success: function(response) {
                    console.log("response: ", response);
                    row.remove();
                },
                error: function(xhr, status, error) {
                    console.log("Error: ", xhr.responseText);
                }
            });
        }
    });
</script>

<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4"><?= $isAdmin ? "Admin" : "User" ?> Panel</h1>

    <div class="flex justify-end py-4">
        <a href="<?= route_to("rt.createPostPage") ?>" class="bg-green-500 btn">Create Post +</a>
    </div>
    <div class="flex justify-center">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Body</th>
                    <?php if ($isAdmin): ?>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Author</th> <?php endif; ?>

                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($posts)) : ?>
                    <?php foreach ($posts as $post) : ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <a href="#" class="text-blue-500 hover:underline">
                                    <?= $post['id'] ?>
                                </a>
                            </td>
                            <td class="py-3 px-4"><?= esc($post['title']) ?></td>
                            <td class="py-3 px-4"><?= esc($post['body']) ?></td>
                            <?php if ($isAdmin): ?>
                                <td class="py-3 px-4"><?= esc($post['name']) ?></td>
                            <?php endif; ?>
                            <td class="py-3 px-4 flex gap-2" data-post-id="<?= $post["id"] ?>">
                                <button id='delete-btn'
                                    data-post-id="<?= $post["id"] ?>"
                                    class="bg-red-500 btn">
                                    Delete
                                </button>

                                <a href="<?= route_to("rt.editPostPage", $post['id']) ?>" class="bg-yellow-500 btn">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center py-3 px-4">No posts found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>