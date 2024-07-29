<?php 
include "../database/Database.php";
//POJO = Plan Old java object
class Proudcts extends Database {
    private $id;
    public $title;
    public $qty;
    public $price;
    public $image;

    public function setId($id){
        $this->id = $id;
    }

    public function save(){
        $sql ="INSERT INTO `products`( `product_title`, `product_price`, `product_qty`,`product_image`) 
        VALUES ('{$this->title}','{$this->price}','{$this->qty}','{$this->image}')";
        mysqli_query($this->conn,$sql);
    }

    public function selectById($id){
        $sql = "SELECT * FROM `products` WHERE `product_id` = $id";
        $result = mysqli_query($this->conn,$sql);

        $row = mysqli_fetch_assoc($result);


        return $row;  //return to controller

    }

    public function update(){
        $sql = "UPDATE `products` SET 
        `product_title`='{$this->title}',`product_price`='{$this->price}',`product_qty`='{$this->qty}' 
        WHERE `product_id` = {$this->id}";
        mysqli_query($this->conn,$sql);
    }

    public function all($search){
        $sql = "SELECT * FROM `products` WHERE `product_title` LIKE '%$search%' ";
        $result = mysqli_query($this->conn,$sql);

        //covert to associative array 
        /*
         "name" => "kkk"
        */
        $data = [];
        while($row  = mysqli_fetch_assoc($result)){
            $data[] = [
                'product_id' => $row['product_id'],
                'product_title' => $row['product_title'],
                'product_price' => $row['product_price'],
                'product_qty' => $row['product_qty'],
                'product_image' => $row['product_image']
            ];
            /* $data[] = $row;*/
        }

        /*
         $row =  array(
          'product_id' => 1,
          'product_title' => fsdfasf,
          'product_price' => 100,
          'product_qty' => 1,
          'product_image' => image.jpg,
          )

          echo $row['product_id']

        */


        return $data;  //Return data to Controller 


    }

    public function destroy(){
        $sql = "DELETE FROM `products` WHERE `product_id` = {$this->id} ";
        mysqli_query($this->conn,$sql);

    }




}
?>