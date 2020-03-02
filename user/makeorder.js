
// console.log('this is my id',document.getElementById("user").value);

let productHolder = document.getElementsByClassName("productHolder");
let orderedItems = document.getElementsByClassName("orderedItems")[0];
let totalPrice = 0;
let totalPriceNode = document.getElementsByClassName("total")[0];
let productClicked = new Array();

for(let i = 0; i < productHolder.length; i++)
{
    productHolder[i].addEventListener("click", function () {

        if(productClicked[i] !== true)
        {
            let itemHolder = document.createElement("div");
            itemHolder.className = "itemHolder";
            
            // console.log(productHolder[i].children[1].children[0].textContent); //product Name
            // console.log(productHolder[i].children[1].children[2].textContent); //product Price
            // console.log(productHolder[i].children[1].children[4].textContent); //product ID
    
            let productName = document.createElement("h2");
            productName.className = "itemName";
            productName.innerHTML = productHolder[i].children[1].children[0].textContent;
                        
            let productID = document.createElement("h6");
            productID.setAttribute("style", "display:none;");
            productID.innerHTML = productHolder[i].children[1].children[4].textContent;
    
            let productPrice = document.createElement("h2");
            productPrice.className = "itemName";
            productPrice.innerHTML = productHolder[i].children[1].children[2].textContent;
    
            let plusBtn = document.createElement("button");
            plusBtn.innerHTML = "+";
            plusBtn.setAttribute("type", "button");
    
            let productQuantity = document.createElement("h2");
            productQuantity.className = "itemQuantity";
            productQuantity.innerHTML = 1;
    
            let minusBtn = document.createElement("button");
            minusBtn.setAttribute("type", "button");
            minusBtn.innerHTML = "-";
    
            let removeBtn = document.createElement("button");
            removeBtn.setAttribute("type", "button");
            removeBtn.innerHTML = "X";
    
            itemHolder.appendChild(productName);
            itemHolder.appendChild(productPrice);
            itemHolder.appendChild(plusBtn);
            itemHolder.appendChild(productQuantity);
            itemHolder.appendChild(minusBtn);
            itemHolder.appendChild(removeBtn);
            itemHolder.appendChild(productID);
            orderedItems.appendChild(itemHolder);
            productClicked[i] = true;
    
            plusBtn.addEventListener("click", function () {
                let itemQuantity = parseInt(productQuantity.innerHTML, 10);
                itemQuantity += 1;
                if(itemQuantity > 10)
                {
                    productQuantity.innerHTML = "10";
                    alert("You Cannot Order More Than 10 Cups");
                }
                else
                {
                    let itemPrice = parseFloat(productHolder[i].children[1].children[2].textContent);
                    totalPrice += itemPrice;
                    totalPriceNode.innerHTML = totalPrice;
                    itemPrice += parseFloat(productPrice.innerHTML);
                    productPrice.innerHTML = itemPrice;   
                    productQuantity.innerHTML = itemQuantity;
                }
            });
    
            minusBtn.addEventListener("click", function () {
                let itemQuantity = parseInt(productQuantity.innerHTML, 10);
                itemQuantity -= 1;
                if(itemQuantity < 1)
                {
                    productQuantity.innerHTML = "1";
                    alert("You Cannot Order Less Than 1 Cups");
                }
                else
                {
                    let itemPrice = parseFloat(productHolder[i].children[1].children[2].textContent);
                    totalPrice -= itemPrice;
                    totalPriceNode.innerHTML = totalPrice;
                    itemPrice = parseFloat(productPrice.innerHTML) - itemPrice;
                    productPrice.innerHTML = itemPrice;  
                    productQuantity.innerHTML = itemQuantity;
                }
            });
    
            removeBtn.addEventListener("click", function () {
               totalPrice -= (parseFloat(productPrice.innerHTML));
               totalPriceNode.innerHTML = totalPrice;
               productClicked[i] = false;
               orderedItems.removeChild(itemHolder);
            });
            totalPrice += parseFloat(productPrice.innerHTML) * parseInt(productQuantity.innerHTML);
            totalPriceNode.innerHTML = totalPrice;
        }
        else
        {
            alert("You Already Added this Item!");
        }
        
    });
}

let confirmBtn = document.getElementsByClassName("confirmOrder")[0];
confirmBtn.addEventListener("click", function(e){

    e.preventDefault();
    let orderedProducts = document.getElementsByClassName("orderedItems")[0];

    if(orderedProducts.children.length > 0)
    {

        let dataObj = {
            user_id: document.getElementById("user").value,
            room: document.getElementById("rooms").options[document.getElementById("rooms").selectedIndex].value,
            notes: document.getElementById("notes").value,
            total: document.getElementsByClassName("total")[0].textContent,
            items: []
        };

        console.log(dataObj);
     
    
        let obj = {};
        for(let i = 0; i < orderedProducts.children.length; i++)
        {
            obj = {
                product_id: orderedProducts.children[i].children[6].textContent,
                quantity: orderedProducts.children[i].children[3].textContent,
            }
            dataObj.items.push(obj);
        }
    
        console.log(dataObj);
        
        
        $.ajax({
            url: "insertuserorder.php",
            type: "post",
            dataType: "json",
            data: dataObj,
            success : function(data){
                if (data.code == "200"){
                    
                    alert("Order Placed Successfully");
                    document.getElementById("notes").value="";
                    document.getElementById("rooms").selectedIndex = 0;
                    document.getElementsByClassName("total")[0].textContent = 0;
                    document.getElementById("user");
                    let child = orderedItems.lastChild;
                    let i = 0;
                    while (child)
                    {
                        orderedItems.removeChild(child);
                        child = orderedItems.lastChild;
                        productClicked[i] = false;
                        i++;
                    }
                    // window.location = "orders.php";
    
                } else {
                    alert("Failed to Place Order");
                    
                }
                
            } 
        });
    }
    else
    {
        alert("Connot Place an Empty Order");
    }
    
});