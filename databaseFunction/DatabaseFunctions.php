<?php

class Database {

    protected $connection;
    
    public function __construct($dbhost='localhost', $dbuser='root', $dbpass='', $dbname='')
    {
        try {
            // $dsn = "mysql:dbname=".$dbname.";host=".$dbhost.";port=3306;";
            $dsn = "mysql:dbname=".$dbname.";host=".$dbhost.";";
            // echo "hello";
            $this->$connection = new PDO($dsn, $dbuser, $dbpass);
            $this->$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            //echo "hello";
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
        $sql = "SELECT product_name, price, product_img, product_id,available FROM product;";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allProducts = $stmt->fetchAll();

        return $allProducts;
    }

    public function getAllOrders()
    {
        $allOrders = array();
        $sql = "SELECT o.order_id, o.order_date, u.user_name, o.room, u.ext, o.amount, u.user_id, o.notes FROM user u, orders o WHERE u.user_id = o.user_id AND o.order_status <>\"done\";";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allOrders as $key => $value) {     
            
            $order_id = $value['order_id'];
            $sql = "SELECT p.product_name, p.price, p.product_img, op.quantity FROM product p, order_product op WHERE p.product_id = op.product_id AND op.order_id = :order_id;";
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
    public function getAllCategories(){
        $allCategories=array();
        $sql="select * from category";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allCategories = $stmt->fetchAll();
        
        return $allCategories;

    }
    public function addCategory($name){
        $sql="insert into category(category_name) values(?)";
        $stmt = $this->$connection->prepare($sql);
        try{       
        $val=$stmt->execute([$name]);      
        
        }
        catch (Exception $e){
          
        }
        return $val;
    }
    public function addProduct($name,$img="",$price="",$category_id){
        $sql="insert into product(product_name,product_img,price,available,category_id) values(?,?,?,?,?)";
        $stmt = $this->$connection->prepare($sql);
        try{       
        $val=$stmt->execute([$name,$img,$price,"available",$category_id]);              
        }
        catch (Exception $e){
          
        }
        return $val;
    }

    public function login($email,$password){
        $sql = "SELECT * FROM user where user_password=? AND email=?;"; // SQL with parameters
        $stmt = $this->$connection->prepare($sql); 
        try{       
            $stmt->execute([$password,$email]);      
           $result=$stmt->fetchAll();
           return $result;
        }
        catch (Exception $e){
             return 0;
        }
    }
       

    public function getAllRooms()
    {
        $allRooms = array();
        $sql = "SELECT DISTINCT room FROM user;";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute();
        $allRooms = $stmt->fetchAll();

        return $allRooms;

    }


    public function getUser($id)
    {
        $sql =  "SELECT user_name, user_id, user_password, email, profile_pic, room, ext FROM user where user_id=?";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute([$id]);
        $result=$stmt->fetch();
        return $result;
    }
    public function getProduct($id)
    {
        $sql =  "SELECT * FROM product where product_id=?";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute([$id]);
        $result=$stmt->fetch();
        return $result;
    }


    public function getUsernameWthTotal($user_id)
    {
        $usersWthTotal = array();
        $sql;
        $stmt;
        if($user_id !== "-1")
        {
            $sql = "SELECT u.user_name, SUM(o.amount) AS total_amount, u.user_id FROM user u, orders o WHERE u.user_id = o.user_id AND u.user_id = :user_id GROUP BY u.user_id, u.user_name;";
            $stmt = $this->$connection->prepare($sql);
            $stmt->bindParam(":user_id", $user_id);
        }
        else
        {
            $sql = "SELECT u.user_name, SUM(o.amount) AS total_amount, u.user_id FROM user u, orders o WHERE u.user_id = o.user_id GROUP BY u.user_id, u.user_name;";
            $stmt = $this->$connection->prepare($sql);
        }
        $stmt->execute();
        $usersWthTotal = $stmt->fetchAll();

        return $usersWthTotal;        
    }

    public function getOrdersOfUser($date_from, $date_to, $user_id)
    {
        $orders = array();
        $sql = "SELECT order_id, order_date, SUM(amount) AS total_amount, user_id FROM orders WHERE user_id = :user_id AND order_date BETWEEN :datefrom AND :dateto GROUP BY user_id, order_date, order_id;";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":datefrom", $date_from);
        $stmt->bindParam(":dateto", $date_to);
        $stmt->execute();
        $orders = $stmt->fetchAll();

        return $orders; 
    }

    public function getProductsOfOrder($order_id)
    {
        $products = array();
        $sql = "SELECT p.product_name,p.product_img, p.price, op.quantity FROM product p, order_product op WHERE p.product_id = op.product_id AND op.order_id = :order_id;";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":order_id", $order_id);
        $stmt->execute();
        $products = $stmt->fetchAll();

        return $products; 
    }



    public function deleteUser($id)
    {
        $sql = "DELETE FROM user where user_id=?";
        $stmt = $this->$connection->prepare($sql);
        $stmt->execute([$id]);
        $result=$stmt->rowCount();
        return $result;
    }

    public function resetPassword($email, $password){
        $sql = "UPDATE user SET user_password=:password WHERE email=:email";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result=$stmt->rowCount();
        return $result;
    }
    public function updateUser($id, $username, $email, $room, $ext){
        $sql = "UPDATE user SET user_name=:username, email=:email, room=:room, ext=:ext WHERE user_id=:id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":room", $room);
        $stmt->bindParam(":ext", $ext);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return $result;
    }
    
    public function updateProduct($product_id, $product_name, $price, $available, $category_name){
        $tempsql = "SELECT category_id FROM category where category_name=?;"; 
        $stmt = $this->$connection->prepare($tempsql); 
        try{       
        $stmt->execute([$category_name]);      
        $res=$stmt->fetchAll();

        $sql = "UPDATE product SET product_name=:product_name, price=:price, available=:available, category_id=:category_id WHERE product_id=:product_id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":product_name", $product_name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":available", $available);
        $stmt->bindParam(":category_id",intval($res[0]['category_id']));
        $stmt->bindParam(":product_id", $product_id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return  $result;

        }
        catch (Exception $e){
        return $e;
        }
    }

    public function updateProductWithImage($product_img, $product_id, $product_name, $price, $available, $category_name){
        $tempsql = "SELECT category_id FROM category where category_name=?;"; 
        $stmt = $this->$connection->prepare($tempsql); 
        try{       
        $stmt->execute([$category_name]);      
        $res=$stmt->fetchAll();

        $sql = "UPDATE product SET product_img=:product_img,product_name=:product_name, price=:price, available=:available, category_id=:category_id WHERE product_id=:product_id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":product_img", $product_img);
        $stmt->bindParam(":product_name", $product_name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":available", $available);
        $stmt->bindParam(":category_id",intval($res[0]['category_id']));
        $stmt->bindParam(":product_id", $product_id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return  $result;

        }
        catch (Exception $e){
        return $e;
        }
    }


    public function updateProductStatus($id, $status){
        $sql = "UPDATE product SET available=:available WHERE product_id=:product_id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":available", $status);
        $stmt->bindParam(":product_id", $id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return $result;
    }
    public function updateUserwithPasswordWithPic($id, $username, $email, $password, $room, $ext, $profilePic){
        $sql = "UPDATE user SET user_name=:username, email=:email, user_password=:password, room=:room, ext=:ext, profile_pic=:profilePic WHERE user_id=:id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":room", $room);
        $stmt->bindParam(":ext", $ext);
        $stmt->bindParam(":profilePic", $profilePic);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return $result;
    }
    public function updateUserWithPic($id, $username, $email, $room, $ext, $profilePic){
        $sql = "UPDATE user SET user_name=:username, email=:email, room=:room, ext=:ext, profile_pic=:profilePic WHERE user_id=:id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":room", $room);
        $stmt->bindParam(":ext", $ext);
        $stmt->bindParam(":profilePic", $profilePic);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return $result;
    }
    public function updateUserWithPassword($id, $username, $email, $password, $room, $ext){
        $sql = "UPDATE user SET user_name=:username, email=:email, user_password=:password, room=:room, ext=:ext WHERE user_id=:id";
        $stmt = $this->$connection->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":room", $room);
        $stmt->bindParam(":ext", $ext);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result=$stmt->rowCount();
        return $result;
    }
    public function deleteProduct($id){
        $sql = "DELETE FROM product where product_id=?";
        $stmt = $this->$connection->prepare($sql);
        try{       
            $stmt->execute([$id]);
            $result=$stmt->rowCount();
        }
        catch (Exception $e){
            return false;
        }
        
        return $result;
    }
    public function addUser($username, $email, $password, $room, $ext){
        $sql = "INSERT INTO user (user_name, email, user_password, room, ext, user_type) values(?,?,?,?,?,?)";
        $stmt = $this->$connection->prepare($sql);
        try{
            $stmt->execute([$username, $email, $password, $room, $ext, "user"]);
            $result=$stmt->rowCount();
        }
        catch (Exception $e){
            return false;
        }
        return $result;
    }
    public function addUserWithPic($username, $email, $password, $room, $ext, $profilePic){
        $sql = "INSERT INTO user (user_name, email, user_password, room, ext, profile_pic, user_type) values(?,?,?,?,?,?,?)";
        $stmt = $this->$connection->prepare($sql);
        try{
            $stmt->execute([$username, $email, $password, $room, $ext, $profilePic, "user"]);
            $result=$stmt->rowCount();
        }
        catch (Exception $e){
            return false;
        }
        return $result;
    }
    public function deleteOrder($id){
        $sqlforiegn = "DELETE FROM order_product where order_id=?";
        $stmtforiegn = $this->$connection->prepare($sqlforiegn);
        $stmtforiegn->execute([$id]);
        $result=$stmtforiegn->rowCount();
        // delete primary_key
        $sqlprimary = "DELETE FROM orders where order_id=?";
        $stmtprimary = $this->$connection->prepare($sqlprimary);
        $stmtprimary->execute([$id]);
        $result=$stmtprimary->rowCount();
        return $result;
    }

}

?>