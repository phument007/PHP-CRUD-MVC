<?php 
  if($_GET['id'] == "" || $_GET['id'] == null){
    header("location:main.php");  // redirect to main file 
  }
?>

<?php include "components/header.php" ?>
<?php include_once "../controller/ProductController.php"; ?>
<div class="container">
   
    <form method="POST" class=" shadow p-5">
        <?php 
         if(isset($_SESSION['status']) == 'error'){
        ?>
        <div class="alert bg-danger alert-dismissible fade show" role="alert">
            <strong class=" text-white">Please checking!</strong> <span class=" text-white">Please input all fields</span>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php     
         session_destroy();
         }


         $obj = new ProudctsController();

         if(isset($_GET['id'])){
            $id = $_GET['id'];
            $product = $obj->edit($id);
         }


        ?>
        <div class="form-header d-flex justify-content-between align-items-center">
            <h3>Update Product</h3>
            <a href="main.php" class=" btn btn-danger btn-sm rounded-0">Back</a>
        </div>
        
        <div class="form-group">
             <input type="hidden" value="<?php echo ( !empty($product['product_id']) ) ? $product['product_id'] : '' ?>" name="product_id" class=" form-control">
            <label for="">Product title</label>
            <input type="text" name="title" value="<?php echo ( !empty($product['product_title']) ) ? $product['product_title'] : '' ?>" class=" form-control shadow-none" id="">
        </div>
        <div class="form-group">
            <label for="">Product price($)</label>
            <input type="number" name="price" value="<?php echo ( !empty($product['product_price']) ) ? $product['product_price'] : '' ?>" class=" form-control shadow-none" id="">
        </div>
        <div class="form-group">
            <label for="">Product Qty(in Stock)</label>
            <input type="number" name="qty" value="<?php echo ( !empty($product['product_qty']) ) ? $product['product_qty'] : '' ?>" class=" form-control shadow-none" id="">
        </div>
        <div class="form-group">
            <label for="">Product image</label>
            <input type="file" name="image" class=" form-control shadow-none" id="">
        </div>
        <div class="form-button mt-3">
            <button name="update" type="submit" class="btn btn-success btn-block rounded-0">Update</button>
            <a href="main.php" class="btn btn-danger btn-block rounded-0">Cancel</a>
        </div>
    </form>
    <?php 
      if(isset($_POST['update'])){
          $id  = $_POST['product_id'];
          $title = $_POST['title'];
          $price = $_POST['price'];
          $qty = $_POST['qty'];

          if(empty($id) || empty($title) || empty($price) || empty($qty)){
            $_SESSION['status'] = 'error';
            header("location:edit.php?id=$id");
          }else{
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = "Updated Product successfully.";
            $obj->update($id, $title, $price, $qty);
          }

      }
    ?>
   
</div>
<?php include "components/footer.php" ?>