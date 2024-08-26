<?php

include("includes/header.php");
include('../middleware/adminMiddleware.php');
include('../config/db1.php');

$query = new Query();
$categories = $query->getData("categories", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Products</h4>

                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                            <div class="col-md-12">
                            
                          <label class="mb-0" >Select Category</label>
                          <select name="category_id" id="category" class="form-select mb-2">
                              <option selected>Select Category</option>
                              <?php 
                              // Loop through categories
                              if ($categories->num_rows > 0) {
                                  while ($row = $categories->fetch_assoc()) {
                                      ?>
                                      <option value="<?= htmlspecialchars($row['id']); ?>"><?= htmlspecialchars($row['name']); ?></option>
                                      <?php
                                  }
                              } else {
                                  ?>
                                  <option value="">No Categories Available</option>
                                  <?php
                              }
                              ?>
                          </select>
                            </div>
                            <div class="col-md-6">
                              <label class="mb-0" >Name</label>
                                   <input type="text" name="name" placeholder="Enter Category name" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                             <label class="mb-0" >Slug</label>
                             <input type="text" name="slug" placeholder="Enter Slug" class="form-control mb-2">
                             </div>
                            <div class="col-md-12">
                             <label class="mb-0" >Small Description</label>
                             <!-- <input type="text" name="slug" placeholder="Enter Slug" class="form-control"> -->
                              <textarea  rows="3" name="small_description" id="" placeholder="Enter small description" class="form-control mb-2"></textarea>
                             </div>
                            <div class="col-md-12">
                             <label class="mb-0" >Description</label>
                             <!-- <input type="text" name="slug" placeholder="Enter Slug" class="form-control"> -->
                              <textarea  rows="3" name="description" id="" placeholder="Enter description" class="form-control mb-2"></textarea>
                             </div>
                             <div class="col-md-6">
                              <label class="mb-0" >Orignal Price</label>
                                   <input type="text" name="orignal_price" placeholder="Enter Orignal Price" class="form-control mb-2">
                            </div>
                            <div class="col-md-6">
                             <label class="mb-0" >Selling Price</label>
                             <input type="text" name="selling_price" placeholder="Enter Selling Price" class="form-control mb-2">
                             </div>
                            <div class="col-md-12">
                             <label class="mb-0" >Upload Image</label>
                             <input type="file" name="image"  class="form-control mb-2">
                             </div>
                             <div class="row">
                             <div class="col-md-6">
                             <label class="mb-0" >Quantity</label>
                             <input type="number" name="qty" placeholder="Enter the quantity" class="form-control mb-2">
                             </div>
                             <div class="col-md-3">
                                <label class="mb-0" >Status</label> <br>
                                <input type="checkbox" name="status">
                             </div>
                             <div class="col-md-3">
                                <label class="mb-0" >trending</label> <br>
                                <input type="checkbox" name="trendingr">
                             </div>

                             </div>
                            <div class="col-md-12">
                             <label class="mb-0" >Meta Title</label>
                             <input type="text" name="meta_title" placeholder="Enter meta Title" class="form-control mb-2">
                             </div>
                            <div class="col-md-12">
                             <label class="mb-0" >Meta Description</label>
                             <textarea  rows="3" name="meta_description" id="" placeholder="Enter meta description" class="form-control mb-2"></textarea>
                             </div>
                            <div class="col-md-12">
                             <label class="mb-0" >Meta Keywords</label>
                             <textarea  rows="3" name="meta_keywords" id="" placeholder="Enter meta Keywords" class="form-control mb-2"></textarea>
                             </div>
                            

                             <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                             </div>
                    </div>
                    </form>
                  
                </div>
            </div>

</div>  </div>
</div>
<?php include('includes/footer.php'); ?>