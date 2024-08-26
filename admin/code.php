<?php
session_start();
include('../config/db1.php');
include('../functions/myfunctions.php');

if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    // Handle file upload
    $image = $_FILES['image']['name'];
    $path ="../uploads/";

    // Debugging: Check for upload errors
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['message'] = "File upload error: " . $_FILES['image']['error'];
        header("Location: add-categories.php");
        exit();
    }

    // Validate file extension
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    if (!in_array($image_ext, $allowed_ext)) {
        $_SESSION['message'] = "Invalid file type!";
        header("Location: add-categories.php");
        exit();
    }

    // Generate a unique filename
    $filename = time() . '.' . $image_ext;

    // Check if the directory exists, if not create it
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename)) {
        // Prepare data for insertion
        $categoryData = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'status' => $status,
            'popular' => $popular,
            'image' => $filename
        ];

        // Insert data into the database
        $db = new Query();
        $result = $db->insertData('categories', $categoryData);

        if ($result) {
            $_SESSION['message'] = "Category added successfully!";
        } else {
            $_SESSION['message'] = "Something went wrong!";
        }
    } else {
        // File upload failed
        $_SESSION['message'] = "Failed to upload image!";
    }

    // Redirect back to the form page
    header("Location: add-categories.php");
    exit();
}
else if (isset($_POST['delete_category_btn'])) {
    $category_id = intval($_POST['category_id']); // Get the category ID

    $query = new Query();

    // First, fetch the category to get the current image filename
    $category = $query->getDataById('categories', '*', 'id', $category_id);

    if ($category->num_rows > 0) {
        $data = $category->fetch_assoc();
        $image = $data['image'];

        // Delete the category from the database
        $result = $query->deleteData('categories', 'id', $category_id);

        if ($result) {
            // If the category was deleted successfully, remove the image file
            if ($image && file_exists("uploads/" . $image)) {
                unlink("uploads/" . $image);
            }

            $_SESSION['message'] = "Category deleted successfully!";
        } else {
            $_SESSION['message'] = "Failed to delete category!";
        }
    } else {
        $_SESSION['message'] = "Category not found!";
    }

    header("Location: category.php");
    exit();
}
else if(isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['orignal_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $path ="../uploads/";

    // Debugging: Check for upload errors
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['message'] = "File upload error: " . $_FILES['image']['error'];
        header("Location: add-product.php");
        exit();
    }

    // Validate file extension
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    if (!in_array($image_ext, $allowed_ext)) {
        $_SESSION['message'] = "Invalid file type!";
        header("Location: ./add-product.php");
        exit();
    }

    // Generate a unique filename
    $filename = time() . '.' . $image_ext;

    // Check if the directory exists, if not create it
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename)) {
        // Prepare data for insertion
        $productData = [
            'category_id' => $category_id,
            'name' => $name,
            'slug' => $slug,
            'small_description' => $small_description,
            'description' => $description,
            'orignal_price' => $original_price,
            'selling_price' => $selling_price,
            'qty' => $qty,
            'status' => $status,
            'trending' => $trending,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'image' => $filename
        ];

        // Insert data into the database
        $query = new Query();
        $result = $query->insertData('products', $productData);

        if ($result) {
            $_SESSION['message'] = "Product added successfully!";
        } else {
            $_SESSION['message'] = "Something went wrong!";
        }
    } else {
        // File upload failed
        $_SESSION['message'] = "Failed to upload image!";
    }

    // Redirect back to the form page
    header("Location: add-product.php");
    exit();
}
else if(isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];

    $image = $_FILES['image']['name'];
    $path ="../uploads/";

    // Handle image upload
    if ($image != "") {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename);

        // Delete the old image
        $query = new Query();
        $old_image = $query->getDataById("products", "image", "id", $product_id);
        if ($old_image->num_rows > 0) {
            $data = $old_image->fetch_assoc();
            if (file_exists($path . $data['image'])) {
                unlink($path . $data['image']);
            }
        }

        $productData['image'] = $filename;
    }

    // Update product data
    $productData = [
        'category_id' => $category_id,
        'name' => $name,
        'slug' => $slug,
        'small_description' => $small_description,
        'description' => $description,
        'orignal_price' => $original_price,
        'selling_price' => $selling_price,
        'qty' => $qty,
        'status' => $status,
        'trending' => $trending,
        'meta_title' => $meta_title,
        'meta_description' => $meta_description,
        'meta_keywords' => $meta_keywords
    ];

    // If a new image was uploaded, add it to the array
    if (isset($filename)) {
        $productData['image'] = $filename;
    }

    $query = new Query();
    $result = $query->updateData('products', $productData, 'id', $product_id);

    if ($result) {
        $_SESSION['message'] = "Product updated successfully!";
    } else {
        $_SESSION['message'] = "Something went wrong!";
    }

    header("Location: products.php");
    exit();



}
else if(isset($_POST['delete_product_btn']))

{
     
        $product_id = intval($_POST['product_id']); // Get the product ID
    
        $query = new Query();
    
        // First, fetch the product to get the current image filename
        $product = $query->getDataById('products', '*', 'id', $product_id);
    
        if ($product->num_rows > 0) {
            $data = $product->fetch_assoc();
            $image = $data['image'];
    
            // Delete the product from the database
            $result = $query->deleteData('products', 'id', $product_id);
    
            if ($result) {
                // If the product was deleted successfully, remove the image file
                if ($image && file_exists("uploads/" . $image)) {
                    unlink("uploads/" . $image);
                }
    
                // echo "Product deleted successfully!";
                // redirect("product.php","Product deleted successfully");
                echo 200;
            } else {
                // redirect("product.php","Failed to delete successfully");
                echo 500;
            }
        } else {
            redirect("product.php","Product not found");
        }
}

?>

