<?php
session_start();
// includes("../config/db1.php");
include('../config/db1.php');

if(isset($_POST['add_category_btn']))
{
    $name=$_POST['name'];
    $slug=$_POST['slug'];
    $description=$_POST['description'];
    $meta_title=$_POST['meta_title'];
    $meta_desciption=$_POST['meta_description'];
    $meta_keywords=$_POST['meta_keywords'];
    $status=isset($_POST['status']) ? '1':'0';
    $popular=isset($_POST['popular']) ? '1':'0';
    // $popular=$_POST['popular'];
    $image= $_FILES['image']['name'];

    // $image=$_FILES['image']['name'];
    $path ="uploads/";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;


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

$db = new Query();
$result = $db->insertData('categories', $categoryData);

if ($result) {
    $_SESSION['message'] = "Category added successfully!";
    header("Location: add-categories.php");
} else {
    $_SESSION['message'] = "Something went wrong!";
    header("Location: add-categories.php");
}
}
 
 

?>