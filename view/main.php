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

           if(isset($_GET['page']) >= 1){
                $page = $_GET['page'];
                $products = $obj->index("",$page)['data'];
            }else{
                $products = $obj->index("",1)['data'];
            }
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
                $products = $obj->index($search,1)['data'];
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
            $i = 1;
            foreach($products as $product){
            ?>
             <tr class=" align-middle text-center">
                <td><?php echo $product['product_id'] ?></td>
                <td>
                    <img style="width: 100px; height: 100px;" src="../public/images/<?php echo $product['product_image'] ?>" alt="">
                </td>
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

            //Router 
            if(isset($_POST['yes_delete'])){
                $id = $_POST['product_id'];
                $obj->delete($id);
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Deleted Product successfully.";
            }
            ?>

           


        </table>
        <?php
            $search = "";
            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }
            $allData = $obj->index($search,1)['record'];
            $totalPages = ceil($allData / 3);  // 2.03 => 3
        ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php echo ($page == 1) ? 'd-none' : '' ?>">
                    <a class="page-link" href="main.php?page=<?php  echo $page - 1 ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                for($i =1;$i<=$totalPages;$i++){
                    ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : '' ?>"><a class="page-link" href="main.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                   }
                 ?>
                

                <li class="page-item <?php echo ($page == $totalPages) ? 'd-none' : '' ?>">
                    <a class="page-link" href="main.php?page=<?php  echo $page + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>

            <?php 
              
            ?>
        </nav>
    </div>

<?php include "components/footer.php"; ?>