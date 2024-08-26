<?php

include("includes/header.php");
include('../middleware/adminMiddleware.php');
include('../config/db1.php');

// Fetch product details based on the product ID
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = new Query();
    $product = $query->getDataById("products", "*", "id", $product_id);

    if ($product->num_rows > 0) {
        $productData = $product->fetch_assoc();
    } else {
        $_SESSION['message'] = "Product not found!";
        header("Location: products.php");
        exit();
    }
} else {
    $_SESSION['message'] = "No product ID provided!";
    header("Location: products.php");
    exit();
}


$query = new Query();
$categories = $query->getData("categories", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Products</h4>

                </div>
                <div class="card-body">
                <form action="code.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?= $productData['id']; ?>">
    <div class="row">
        <div class="col-md-12">
            <label class="mb-0">Select Category</label>
            <select name="category_id" class="form-select mb-2">
                <?php 
                foreach($categories as $row) {
                    $selected = ($row['id'] == $productData['category_id']) ? "selected" : "";
                    echo "<option value='".htmlspecialchars($row['id'])."' $selected>".htmlspecialchars($row['name'])."</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="mb-0">Name</label>
            <input type="text" name="name" value="<?= htmlspecialchars($productData['name']); ?>" placeholder="Enter Product name" class="form-control mb-2">
        </div>
        <div class="col-md-6">
            <label class="mb-0">Slug</label>
            <input type="text" name="slug" value="<?= htmlspecialchars($productData['slug']); ?>" placeholder="Enter Slug" class="form-control mb-2">
        </div>
        <div class="col-md-12">
            <label class="mb-0">Small Description</label>
            <textarea rows="3" name="small_description" placeholder="Enter small description" class="form-control mb-2"><?= htmlspecialchars($productData['small_description']); ?></textarea>
        </div>
        <div class="col-md-12">
            <label class="mb-0">Description</label>
            <textarea rows="3" name="description" placeholder="Enter description" class="form-control mb-2"><?= htmlspecialchars($productData['description']); ?></textarea>
        </div>
        <div class="col-md-6">
            <label class="mb-0">Original Price</label>
            <input type="text" name="original_price" value="<?= htmlspecialchars($productData['orignal_price']); ?>" placeholder="Enter Original Price" class="form-control mb-2">
        </div>
        <div class="col-md-6">
            <label class="mb-0">Selling Price</label>
            <input type="text" name="selling_price" value="<?= htmlspecialchars($productData['selling_price']); ?>" placeholder="Enter Selling Price" class="form-control mb-2">
        </div>
        <div class="col-md-12">
            <label class="mb-0">Upload Image</label>
            <input type="file" name="image" class="form-control mb-2">
            <img src="uploads/<?= htmlspecialchars($productData['image']); ?>" width="100" height="100" alt="<?= htmlspecialchars($productData['name']); ?>">
        </div>
        <div class="col-md-6">
            <label class="mb-0">Quantity</label>
            <input type="number" name="qty" value="<?= htmlspecialchars($productData['qty']); ?>" placeholder="Enter Quantity" class="form-control mb-2">
        </div>
        <div class="col-md-3">
            <label class="mb-0">Status</label><br>
            <input type="checkbox" name="status" <?= $productData['status'] == '1' ? 'checked' : ''; ?>>
        </div>
        <div class="col-md-3">
            <label class="mb-0">Trending</label><br>
            <input type="checkbox" name="trending" <?= $productData['trending'] == '1' ? 'checked' : ''; ?>>
        </div>
        <div class="col-md-12">
            <label class="mb-0">Meta Title</label>
            <input type="text" name="meta_title" value="<?= htmlspecialchars($productData['meta_title']); ?>" placeholder="Enter Meta Title" class="form-control mb-2">
        </div>
        <div class="col-md-12">
            <label class="mb-0">Meta Description</label>
            <textarea rows="3" name="meta_description" placeholder="Enter Meta Description" class="form-control mb-2"><?= htmlspecialchars($productData['meta_description']); ?></textarea>
        </div>
        <div class="col-md-12">
            <label class="mb-0">Meta Keywords</label>
            <textarea rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" class="form-control mb-2"><?= htmlspecialchars($productData['meta_keywords']); ?></textarea>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
        </div>
    </div>
</form>
                  
                </div>
            </div>

</div>  </div>
</div>
<?php include('includes/footer.php'); ?>