<?php 
  include "../model/Products.php";
  include "../handle/Redirect.php";
  include "../handle/Message.php";
  class ProudctsController {

    public function store($title,$price,$qty,$image){
        $product = new Proudcts();
        $product->title = $title;
        $product->price = $price;
        $product->qty = $qty;
        $product->image = $image;  //step 3 (store image name in db);
        $product->save();
        return redirect("main.php");
    }

    public function index($search,$page){
        // is param "search" from view 
        $products = new Proudcts();
        $products->pagination($page);
        $allData =  $products->all($search);

        /*$allData = [
                        'record' => 5,
                        'data' => [
                            .....
                        ]
                     ]
        */
        return $allData;  // Return data to view 
    }

    public function delete($id){
       /* 
         Delete : 2 step 
         1. remove image from folder 
         2. delete record from database
       */

       $product = new Proudcts();
       $product->setId($id);

       // Step 1 : remove image from folder
       $row = $product->selectById($id);
       /*
         $row = [
          'product_id' => 1,
          'product_title' => fsdfasf,
          'product_price' => 100,
          'product_qty' => 1,
          'product_image' => image.jpg,
         ]
       */
       $image = $row['product_image'];  //store image name from db
       $imageDir = "../public/images/$image";
       if(file_exists($imageDir)){
           unlink($imageDir);  
       }

       // Step 2 : delete record from database
       $product->destroy();

       return redirect('main.php');

    }

    public function edit($id){

      $product = new Proudcts();
      $data = $product->selectById($id);
      return $data; // Return data to view

    }

    public function update($id,$title,$price,$qty,$image){
      $product = new Proudcts();
      $product->title = $title;
      $product->price = $price;
      $product->qty = $qty;
      $product->image = $image;


      //Apply sql for compere image 
      $row =  $product->selectById($id);

      /*
         $row = [
          'product_id' => 1,
          'product_title' => fsdfasf,
          'product_price' => 100,
          'product_qty' => 1,
          'product_image' => image.jpg,
         ]
       */

       // Check if image name is changed
       $image_db = $row['product_image'];
       $imageDir = "../public/images/$image_db";
       if($image_db != $image ){
          if(file_exists($imageDir)){
              unlink($imageDir);
          }
       }
       

      $product->setId($id);
      $product->update();
      return redirect("main.php");
    }

    


  }

?>