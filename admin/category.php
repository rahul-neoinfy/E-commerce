<?php include('includes/header.php');
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
                   <h4> Categories</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                
                            if ($categories->num_rows > 0) {
                                // Loop through each category and display the data
                                while ($row = $categories->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= $row['name']; ?></td>
                                        <td>
                                            <img src="uploads/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" width="50" height="50">
                                        </td>
                                        <td><?= $row['status'] == '1' ? 'Visible' : 'Hidden'; ?></td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $row['id']; ?>" class="btn btn-primary">Edit</a>
                                            <form action="code.php" method="POST">
               <input type="hidden" name="category_id" value="<?= $row['id']; ?>">
                  <button class="btn btn-danger" name="delete_category_btn">Delete</button>
                                   </form>
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