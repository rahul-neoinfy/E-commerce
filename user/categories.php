<?php 
include "../includes/header.php";
include '../config/db1.php';  

// Initialize the Query class
$query = new Query();

// Fetch data where status is '0'
$result = $query->getDataWithStatus('categories', '*');  
?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Collection</h1>
                <hr>
                <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    // Loop through the result set and display the data
                    while ($row = $result->fetch_assoc()) {
                        // Construct the full path to the image
                        $imagePath = "../uploads/" . htmlspecialchars($row['image']);
                        ?>
                       <div class="col-md-3 mb-2">
                        <a href="products.php?category=<?= $row['slug']; ?>">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php if (file_exists($imagePath)): ?>
                                    <img src="<?= $imagePath ?>" alt="Category Image" class="w-100">
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
                    echo "<p>No items found with status '0'.</p>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
