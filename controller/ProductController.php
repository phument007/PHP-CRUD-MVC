<?php 
  include "../model/Products.php";
  include "../handle/Redirect.php";
  include "../handle/Message.php";
  class ProudctsController {

    public function store($title,$price,$qty){
        $product = new Proudcts();
        $product->title = $title;
        $product->price = $price;
        $product->qty = $qty;
        $product->save();
        return redirect("main.php");
    }

    public function index($search){
        // is param "search" from view 
        $products = new Proudcts();
        $allData =  $products->all($search);

        return $allData;  // Return data to view 
    }

    public function delete($id){
       $product = new Proudcts();
       $product->setId($id);
       $product->destroy();

       return redirect('main.php');
    }

    public function edit($id){

      $product = new Proudcts();
      $data = $product->selectById($id);
      return $data; // Return data to view

    }

    public function update($id,$title,$price,$qty){
      $product = new Proudcts();
      $product->title = $title;
      $product->price = $price;
      $product->qty = $qty;
      $product->setId($id);
      $product->update();
      return redirect("main.php");
    }

    


  }

?>