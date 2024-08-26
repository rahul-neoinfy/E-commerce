<?php 
include "../includes/header.php";
include '../config/db1.php';  

$query = new Query();

$category_slug = isset($_GET['category']) ? $_GET['category'] : '';

$category = $query->getSlugactive("categories", $category_slug);

if ($category) {
    $category_id = $category['id'];

    $products = $query->getProductCategory($category_id);

    if (!$products) {
        echo "<p>No products found in this category.</p>";
        exit;
    }
} else {
    echo "<p>Category not found or inactive.</p>";
    exit;
}
?>

<div class="py-3 bg-primary">
    <div class="container">
        <h6 class="text-white">
           <a class="text-white" href="categories.php">Home /</a>
           <a class="text-white" href="categories.php">Collections /</a>
           <?= htmlspecialchars($category['name']); ?>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= htmlspecialchars($category['name']); ?></h1>
                <hr>
                <div class="row">
                    <?php
                    if ($products && $products->num_rows > 0) {
                        while ($row = $products->fetch_assoc()) {
                            $imagePath = "../uploads/" . htmlspecialchars($row['image']);
                    ?>
                            <div class="col-md-3 mb-2">
                                <a href="product-details.php?product=<?= htmlspecialchars($row['slug']); ?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <?php if (file_exists($imagePath)): ?>
                                                <img src="<?= $imagePath ?>" alt="Product Image" class="w-100">
                                            <?php else: ?>
                                                <p>Image not available.</p>
                                            <?php endif; ?>
                                            <h4 class="text-center"><?= htmlspecialchars($row['name']); ?></h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No products found in this category.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
