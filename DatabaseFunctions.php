<?php

class Database {

    protected $connection;
    
    public function __construct($dbhost='localhost', $dbuser='root', $dbpass='', $dbname='')
    {
        try {
            $dsn = "mysql:dbname=".$dbname.";host=".$dbhost.";port=3306;";
            //$dsn = "mysql:dbname=".$dbname.";host=".$dbhost.";";
            // echo "hello";
            $this->$connection = new PDO($dsn, $dbuser, $dbpass);
            // echo "hello";
            $this->$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            echo "hello";
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function closeDBConnection() {
        $this->connection = null;
    }

    public function addOrder($order_date, $order_room, $order_amount, $order_notes, $order_status, $user_id, $products_quantity)
    {
        $sql = "INSERT INTO orders (order_status, order_date, room, amount, notes, user_id) VALUES (:order_status, :order_date, :room, :amount, :notes, :user_id)";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(':order_status', $order_status);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':room', $order_room);
        $stmt->bindParam(':amount', $order_amount);
        $stmt->bindParam(':notes', $order_notes);
        $stmt->bindParam(':user_id', $user_id);
        $insertOrderReturn = $stmt->execute();
        $insertOrderDetailsReturn = 0;

        if($insertOrderReturn == 1)
        {
            $last_inserted_order_id = $this->$connection->lastInsertId();
            // echo $last_inserted_order_id;
            $sql = "INSERT INTO order_product (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)";
            $stmt = $this->$connection->prepare($sql);
    
            foreach($products_quantity as $item)
            {
                $stmt->bindParam(':order_id', $last_inserted_order_id);
                $stmt->bindParam(':product_id', $item["product_id"]);
                $stmt->bindParam(':quantity', $item["quantity"]);
                $insertOrderDetailsReturn = $stmt->execute();
            }
        }

        if($insertOrderDetailsReturn == 1)
            return 1; //Success

        return 0; //Failed

    }

    public function getAllProducts()
    {
        $allProducts = array();
        $sql = "SELECT product_name, price, product_img FROM product;";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allProducts = $stmt->fetchAll();

        //// How to loop over the array and extract values
        // foreach ($allProducts as $item) { 

        //     echo $item['product_name']." ".$item['price']." ".$item['product_img']."<br>";
        // }

        return $allProducts;
    }

    public function getAllOrders()
    {
        $allOrders = array();
        $sql = "SELECT o.order_id, o.order_date, u.user_name, o.room, u.ext, o.amount FROM user u, orders o WHERE u.user_id = o.user_id AND o.order_status <>\"done\";";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allOrders as $key => $value) {     
            
            $order_id = $value['order_id'];
            $sql = "SELECT p.product_name, p.price, op.quantity FROM product p, order_product op WHERE p.product_id = op.product_id AND op.order_id = :order_id;";
            $stmt = $this->$connection->prepare($sql);
            $stmt->bindParam(":order_id", $order_id);
            $stmt->execute();
            $products_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $allOrders[$key]["items"] = $products_list;
            
        } 

        return $allOrders;
    }

    public function getAllUsers()
    {
        $allUsers = array();
        $sql = "SELECT user_id, user_name, room, profile_pic, ext FROM user;";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allUsers = $stmt->fetchAll();

        return $allUsers;
    }

}

// $db = new Database('127.0.0.1', '', '123456', 'cafedb');

?>