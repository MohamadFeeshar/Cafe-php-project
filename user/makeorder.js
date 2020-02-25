let addToProducts = document.getElementById('add_products');
let drink = document.getElementsByClassName('choose_drink');
let newProduct;
let total = 0;
for (let i = 0; i < drink.length; i++) {
    drink[i].addEventListener('click', function (e) {
        let drinkTitle = this.title;
        let productInput = document.getElementById(drinkTitle);
        // check_for_product_availability
        if (!productInput) {
            let makeDiv = document.createElement("div");
            let newTitle = document.createElement("span");
            newTitle.textContent = drinkTitle;
            newProduct = document.createElement("input");
            let makeButton = document.createElement("button");
            makeButton.type = "button";
            makeButton.innerHTML = "X";
            makeDiv.style.display = "block";
            newProduct.style.marginLeft = "17px";
            newProduct.style.marginTop = "17px";
            newProduct.className = "form-group";
            newProduct.type = "number";
            newProduct.value = 1;
            newProduct.setAttribute("min", 1);
            // newProduct.setAttribute("max", 10);
            newProduct.setAttribute("id", drinkTitle);
            addToProducts.appendChild(makeDiv);
            makeDiv.appendChild(newTitle);
            makeDiv.appendChild(newProduct);
            makeDiv.appendChild(makeButton);
            //delete order
            makeButton.addEventListener("click", () => {
                makeDiv.remove();
            });
            // console.log("dfdgfdgb");
            //find total price
            // let products = document.getElementsByName('qty');
            total += parseFloat(drink[i].dataset.price);
            document.getElementById('change-price').innerHTML = total;
            //change price when change input
            console.log(drink[i].dataset.price);
            // newProduct.addEventListener("input", () => {
                //     total += parseFloat(drink[i].dataset.price);
                //     document.getElementById('change-price').innerHTML = total;
                // (newProduct.value - 1)
                //     total -= parseFloat(drink[i].dataset.price);
                //     document.getElementById('change-price').innerHTML = total;
                // }
            // });

            //remove price when press close
            makeButton.addEventListener("click", () => {
                let currentItemPrice = parseFloat(drink[i].dataset.price) * makeButton.value;
                document.getElementById('change-price').innerHTML = total- currentItemPrice;
            });
            // prevent more than one click
        } else {
            // productInput.value = parseInt(productInput.value) + 1;
            alert("sorry, you already choosen this product");
        }
    });
}