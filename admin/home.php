
<?php
include '../login/login.php'; // Includes Login Script

if (isset($_SESSION['login_user'])) {
    if ($_SESSION['user_type'] == 'user') {
        header("location: ../login");
    }
} else {
    header("location: ../login");
}

// require_once '../databaseFunction/DatabaseFunctions.php';

// $db = new Database("localhost", $DBUserName, $DBPassword, "cafedb");
// $myTest = $db->getAllOrders();
?>

<!DOCTYPE Html>
<html>

<?php include "../adminHeader.php";?>

<div class="main">
    <section>
        <h1 class="pageTitle"> Orders </h1>
        <!-- <button class="addLink">add product ?</button>   -->
        <br>
    </section>

    <section class="content">
            <!-- <table id="data">
                <tr>
                <th> User Name </th>
                <th> Order Date </th>
                <th> Room </th>
                <th> Notes</th>
                <th> Amount</th>
                <th> Action</th>
                </tr>
            <?php
// foreach ($myTest as $row) {
//     echo "<tr><td>" . $row['user_name'] . "</td><td>" . $row['order_date'] . "</td><td>" .
//         $row['room'] . "</td><td>" .
//         $row['notes'] . "</td><td>" .
//         $row['amount'] . "</td><td> <button class='button deletebtn' id=\"".$row['user_id']."\"> Cancel?  </button> </td></tr>";
// }

?>
            </table> -->



    </section>
</div>
<script src="js/adminHome.js"></script>
</body>
</html>