<?php include('includes/header.php');
include('../middleware/adminMiddleware.php');
include('../config/db1.php');
$query = new Query();


$products = $query->getData("products", "*");
?>
 


 <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h4> Products</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                
                            if ($products->num_rows > 0) {
                                // Loop through each category and display the data
                                while ($row = $products->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td>
                                            <img src="uploads/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" width="50" height="50">
                                        </td>
                                        <td><?= $row['status'] == '1' ? 'Visible' : 'Hidden'; ?></td>
                                        <td>
                                            <a href="edit-product.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    
                                        </td>
                                        <td>
 
                  <button type="button" class="btn btn-sm btn-danger delete_product_btn" value="<?= $row['id'] ?>">Delete</button>
                                    
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5">No Categories Found</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
 </div>
<?php include('includes/footer.php'); ?>