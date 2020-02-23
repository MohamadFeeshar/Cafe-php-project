<div class="container-fluid">
<?php include('header.php');?>
    <form action="orders.php" method="POST">
        <!--Price(left_side)-->
        <div class="row mt-5">
            <div class="col-md-3 orderProcess ml-5">
                <!--Add More to Order-->
                <div class="mt-3" id="add_products">

                </div>
                <!--write notes-->
                <div class="form-group mt-5">
                    <label for="note">Notes</label>
                    <textarea class="form-control" name="notes" id="note" rows="4"></textarea>
                </div>
                <!--rooms option-->
                <div class="form-group row mb-4">
                    <label for="rooms" class="col-sm-2 col-form-label">Rooms</label>
                    <div class="col-sm-9">
                        <select class="form-control ml-4" id="rooms">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <!--Add Price-->
                <div class="makeBorder"></div>
                <div class="mt-2 mb-5">
                    <span class="make_price">Total Price: <span id="change-price">0</span> EGP</span>
                </div>
                <!--Confirm Order-->
                <button type="submit" href="#" class="btn btn-success mt-5 mb-3 align_btn">Confirm</button>
            </div>
            <!--menu(right_side)-->
            <div class="col-md-8 ml-4">
                <span><h1 class="choose_text">Choose from our menu...</h1></span>
                <div class="align_product">
                    <div class="align_img" id="allDrinks"> 
                    <?php
                        require_once("order.php");
                        print_r(getProducts());
                        
                    ?>
                        <img class="choose_drink" title="tea" name="tea" src="">
                        <img class="choose_drink" title="nescafe" name="nescafe" src="">
                        <img class="choose_drink" title="cola" name="cola" src="">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="makeorder.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>