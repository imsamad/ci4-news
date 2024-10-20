<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : "Teapost" ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style type="text/tailwindcss">
        @layer utilities {
      .danger {
        @apply bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative;
    }
    .info {
        @apply bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative;
    }
    .success {
        @apply bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative;
    }
    .btn {
        @apply text-white px-3 py-1 rounded-md;
    }
    }
  </style>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <?php include("partials/header.php"); ?>

        <section class="py-12 flex-1">
            <?= $this->renderSection("content"); ?>
        </section>

        <!-- Footer -->
        <?php include("partials/footer.php"); ?>
    </div>
</body>

</html>