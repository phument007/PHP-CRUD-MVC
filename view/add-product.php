<?php include "components/header.php" ?>

<div class="container">
   
    <form method="POST" enctype="multipart/form-data" class=" shadow p-5">
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
        ?>
        <div class="form-header d-flex justify-content-between align-items-center">
            <h3>Add Product</h3>
            <a href="main.php" class=" btn btn-danger btn-sm rounded-0">Back</a>
        </div>
        
        <div class="form-group">
            <label for="">Product title</label>
            <input type="text" name="title" class=" form-control shadow-none" id="">
        </div>
        <div class="form-group">
            <label for="">Product price($)</label>
            <input type="number" name="price" class=" form-control shadow-none" id="">
        </div>
        <div class="form-group">
            <label for="">Product Qty(in Stock)</label>
            <input type="number" name="qty" class=" form-control shadow-none" id="">
        </div>
        <div class="form-group">
            <label for="">Product image</label>
            <input type="file" name="image" class=" form-control shadow-none" id="">
        </div>
        <div class="form-button mt-3">
            <button name="save" type="submit" class="btn btn-success btn-block rounded-0">Add Product</button>
            <a href="main.php" class="btn btn-danger btn-block rounded-0">Cancel</a>
        </div>
    </form>
    <?php 
       if (isset($_POST['save'])){
          include "../controller/ProductController.php";
          $obj = new ProudctsController();
          
          $title = $_POST['title'];
          $price = $_POST['price'];
          $qty = $_POST['qty'];


          /*step uload :  
             1.get image name
             2.upload image to folder 
             3.store image name in database
          */

          #step 1 (get image name)
          $file_name = $_FILES['image']['name'];
          $file_tmp  = $_FILES['image']['tmp_name'];  //get image template
          #step 2 (upload image to folder)
          $imageDir = "../public/images/$file_name";
          move_uploaded_file($file_tmp,$imageDir);

          if(empty($title) || empty($price) || empty($qty)){
            $_SESSION['status'] = 'error';
            header("location: add-product.php");
          }else{
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = "Added Product Successfully.";
            $obj->store($title,$price,$qty,$file_name);
          }

          

       }
    ?>
</div>
<?php include "components/footer.php" ?>