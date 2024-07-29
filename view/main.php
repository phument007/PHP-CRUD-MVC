<?php include "components/header.php"; ?>
<?php include "../controller/ProductController.php" ?>
<?php include_once "../handle/Modal.php"; ?>
    <div class=" container">
        <div class="d-flex justify-content-between align-items-center">
           <h3>Products</h3>
           <a href="add-product.php" class=" btn btn-primary btn-sm rounded-0">Add more</a>
        </div>

        <?php if(isset($_SESSION['status']) == 'success'){?>
        <div class="alert bg-success alert-dismissible fade show" role="alert">
            <strong class=" text-white">Happy Happy❤️😍</strong> <span class=" text-white"><?php echo $_SESSION['message'] ?> </span> 
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session_destroy(); } ?>

        <?php 
           $obj = new ProudctsController();
           $products = $obj->index("");
        ?>
        <?php ModelDelete()  ?>
        <div class=" d-flex justify-content-between align-items-center "> 
          <a href="main.php" class=" btn btn-danger btn-sm rounded-0">reset</a>
          <form >
             <input type="search" name="search" class=" form-control shadow-none" placeholder=" Search here....">
          </form>
          <?php
             if(isset($_GET['search'])){
                $search = $_GET['search'];
                $products = $obj->index($search);
             }
          ?>
        </div>
        <table class=" table table-bordered mt-3">
            <tr class=" table-dark">
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>QTY</th>
                <th class=" text-center">Action</th>
            </tr>
            <?php 
            foreach($products as $product){
            ?>
             <tr>
                <td><?php echo $product['product_id'] ?></td>
                <td>product.jpg</td>
                <td><?php echo $product['product_title'] ?></td>
                <td>$<?php echo $product['product_price'] ?></td>
                <td><?php echo $product['product_qty'] ?>in stock</td>
                <td class=" text-center">
                    <a href="edit.php?id=<?php echo $product['product_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a onclick="DeleteProduct(<?php echo $product['product_id']  ?>)" data-bs-toggle="modal" data-bs-target="#Modal_delete"  class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php
            }

            if(isset($_POST['yes_delete'])){
                $id = $_POST['product_id'];
                $obj->delete($id);
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Deleted Product successfully.";
            }
            ?>

           


        </table>
    </div>

<?php include "components/footer.php"; ?>