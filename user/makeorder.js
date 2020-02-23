let addToProducts = document.getElementById('add_products');
let drink = document.getElementsByClassName('choose_drink');
let currentPrice = document.getElementById("change-price");

for (let i = 0; i < drink.length; i++) {
    drink[i].addEventListener('click', function(e) {
        let drinkTitle = this.title;
        let productInput = document.getElementById(drinkTitle);
        // check_for_product_availability
        if (!productInput) {
            let makeDiv = document.createElement("div");
            let newTitle = document.createElement("span");
            newTitle.textContent = drinkTitle;
            let newProduct = document.createElement("input");
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
            newProduct.setAttribute("id", drinkTitle);
            addToProducts.appendChild(makeDiv);
            makeDiv.appendChild(newTitle);
            makeDiv.appendChild(newProduct);
            makeDiv.appendChild(makeButton);
            //delete order
            makeButton.addEventListener("click",()=>{
                makeDiv.remove();
            });
            // prevent more than one click
        } else {
            // productInput.value = parseInt(productInput.value) + 1;
            alert("sorry, you already choosen this product");
        }
    });
}