var addToProducts = document.getElementById('add_products');
var drink = document.getElementsByClassName('choose_drink');

for (var i = 0; i < drink.length; i++) {
    drink[i].addEventListener('click', function (e) {
        var drinkTitle = this.title;
        // var drinkName = this.name;
        // console.log(drinkName);
        var newTitle = document.createElement("span");
        newTitle.textContent = drinkTitle;
        var newProduct = document.createElement("input");
        newProduct.type = "number";
        var break_line = document.createElement("br");
        // newProduct.setAttribute("class","class name");
        addToProducts.appendChild(newTitle);
        addToProducts.appendChild(newProduct);
        addToProducts.appendChild(break_line);
        e.appendChild('<i class="fa fa-trash-o" aria-hidden="true"></i>');
    });
}