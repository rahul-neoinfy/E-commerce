<?php
ob_start();
include('../middleware/adminMiddleware.php');
include('includes/header.php');
include('../config/db1.php');

$query = new Query();

// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Get the category ID from the URL

    // Fetch the category data
    $category = $query->getDataById('categories', '*', 'id', $id);

    if ($category->num_rows > 0) {
        $data = $category->fetch_assoc();
    } else {
        $_SESSION['message'] = "Category not found!";
        header("Location: category.php");
        exit();
    }
} else {
    $_SESSION['message'] = "ID missing from URL!";
    header("Location: category.php");
    exit();
}

// Handle form submission
if (isset($_POST['update_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    // Handle image upload
    $image = $_FILES['image']['name'];
    if ($image) {
        $path = "uploads/";
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        // Move the uploaded file to the specified path
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename)) {
            // If there was an old image, remove it from the folder
            if ($data['image'] && file_exists($path . $data['image'])) {
                unlink($path . $data['image']); // Delete the old image file
            }
            $image = $filename; // Update the filename for the new image
        } else {
            $_SESSION['message'] = "Failed to upload image!";
            header("Location: edit-category.php?id=$id");
            exit();
        }
    } else {
        // If no new image is uploaded, keep the old one
        $image = $data['image'];
    }

    // Prepare data for updating
    $categoryData = [
        'name' => $name,
        'slug' => $slug,
        'description' => $description,
        'meta_title' => $meta_title,
        'meta_description' => $meta_description,
        'meta_keywords' => $meta_keywords,
        'status' => $status,
        'popular' => $popular,
        'image' => $image
    ];

    // Update the category data
    $result = $query->updateData('categories', $categoryData, 'id', $id);

    if ($result) {
        $_SESSION['message'] = "Category updated successfully!";
        header("Location: category.php");
        exit();
    } else {
        $_SESSION['message'] = "Failed to update category!";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4>Edit Category</h4>
                </div>
                <div class="card-body">
                    <form action="edit-category.php?id=<?= htmlspecialchars($id); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($data['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="<?= htmlspecialchars($data['slug']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($data['description']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" value="<?= htmlspecialchars($data['meta_title']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <input type="text" name="meta_description" id="meta_description" class="form-control" value="<?= htmlspecialchars($data['meta_description']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" value="<?= htmlspecialchars($data['meta_keywords']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" <?= $data['status'] == '1' ? 'selected' : ''; ?>>Visible</option>
                                <option value="0" <?= $data['status'] == '0' ? 'selected' : ''; ?>>Hidden</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="popular">Popular</label>
                            <select name="popular" id="popular" class="form-control">
                                <option value="1" <?= $data['popular'] == '1' ? 'selected' : ''; ?>>Yes</option>
                                <option value="0" <?= $data['popular'] == '0' ? 'selected' : ''; ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <br>
                            <?php if ($data['image']): ?>
                                <img src="uploads/<?= htmlspecialchars($data['image']); ?>" alt="<?= htmlspecialchars($data['name']); ?>" width="100">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update_category_btn" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php ob_end_flush(); // End output buffering ?>
