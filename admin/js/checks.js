let dateFrom = document.getElementById("date-from");
let dateTo = document.getElementById("date-to");
let selectedUserID;
window.addEventListener("load", function() {
  let dataObj = { user_id: -1, selectUser: 1 };
  $.ajax({
    url: "checksHelper.php",
    type: "post",
    dataType: "json",
    data: dataObj,
    success: function(data) {
      if (data.code == "200") {
        let contentBody = document.getElementsByClassName("content")[0];
        let child = contentBody.lastChild;
        while (child) {
          contentBody.removeChild(child);
          child = contentBody.lastChild;
        }
        let table = document.createElement("table");
        table.setAttribute("id", "allUsers");
        let tableRowHeader = document.createElement("tr");
        let nameHeader = document.createElement("th");
        nameHeader.innerHTML = "Name";
        let totalHeader = document.createElement("th");
        totalHeader.innerHTML = "Total Amount";
        tableRowHeader.appendChild(nameHeader);
        tableRowHeader.appendChild(totalHeader);
        table.appendChild(tableRowHeader);

        let usersWthTotal = data.users;

        for (let i = 0; i < usersWthTotal.length; i++) {
          let tableRow = document.createElement("tr");

          let nameData = document.createElement("td");
          nameData.innerHTML = usersWthTotal[i].user_name;

          let totalAmtData = document.createElement("td");
          totalAmtData.innerHTML = usersWthTotal[i].total_amount;

          let userIdData = document.createElement("td");
          userIdData.setAttribute("style", "visibility:hidden;");
          userIdData.setAttribute("id", "userID");
          userIdData.innerHTML = usersWthTotal[i].user_id;

          tableRow.appendChild(nameData);
          tableRow.appendChild(totalAmtData);
          tableRow.appendChild(userIdData);
          table.appendChild(tableRow);

          tableRow.addEventListener("click", function(e) {
            let specificOrderTable = document.getElementById("specificorder");
            if (specificOrderTable)
              specificOrderTable.setAttribute("style", "display:none;");
            // console.log(e.composedPath()[1].children[2].textContent);
            selectedUserID = e.composedPath()[1].children[2].textContent; //selected user id
            // let selectedUserID = e.path[1].cells[2].textContent; //selected user id

            if (dateFrom.value !== "" && dateTo.value !== "") {
              let obj = {
                user_id: selectedUserID,
                dateFrom: dateFrom.value,
                dateTo: dateTo.value,
                expandUserOrder: 1
              };
              // console.log(obj);

              $.ajax({
                url: "checksHelper.php",
                type: "post",
                dataType: "json",
                data: obj,
                success: function(data) {
                  if (data.code == "200") {
                    let elementExistsTemp2 = document.getElementById(
                      "specificUser"
                    );
                    if (elementExistsTemp2 !== null) {
                      elementExistsTemp2.remove();
                    }

                    let table = document.createElement("table");
                    table.setAttribute("id", "specificUser");
                    let tableRowHeader = document.createElement("tr");
                    let orderDateHeader = document.createElement("th");
                    orderDateHeader.innerHTML = "Order Date";
                    let totalHeader = document.createElement("th");
                    totalHeader.innerHTML = "Amount";
                    tableRowHeader.appendChild(orderDateHeader);
                    tableRowHeader.appendChild(totalHeader);
                    table.appendChild(tableRowHeader);

                    for (let i = 0; i < data.orders.length; i++) {
                      let tableRow = document.createElement("tr");

                      let orderDateData = document.createElement("td");
                      orderDateData.innerHTML = data.orders[i].order_date;
                      orderDateData.setAttribute("class", "order-details");
                      orderDateData.setAttribute("id", data.orders[i].order_id);
                      let totalAmtData = document.createElement("td");
                      totalAmtData.innerHTML = data.orders[i].total_amount;
                      tableRow.appendChild(orderDateData);
                      tableRow.appendChild(totalAmtData);
                      table.appendChild(tableRow);
                    }
                    contentBody.appendChild(table);
                  }
                  addListenerToOrdersData();
                }
              });
            } else {
              alert("You must specify date from and date to");
            }
          });
        }

        contentBody.appendChild(table);
      }
    }
  });
});

let dropdownMenu = document.getElementById("users");
dropdownMenu.addEventListener("change", function() {
  let dataObj = {};
  if (dropdownMenu.options[dropdownMenu.selectedIndex].value === "none") {
    dataObj = { user_id: -1, selectUser: 1 };
  } else {
    dataObj = {
      user_id: parseInt(dropdownMenu.options[dropdownMenu.selectedIndex].value),
      selectUser: 1
    };
  }

  $.ajax({
    url: "checksHelper.php",
    type: "post",
    dataType: "json",
    data: dataObj,
    success: function(data) {
      if (data.code == "200") {
        let contentBody = document.getElementsByClassName("content")[0];
        let child = contentBody.lastChild;
        while (child) {
          contentBody.removeChild(child);
          child = contentBody.lastChild;
        }
        let elementExistsTemp1 = document.getElementById("allUsers");

        if (elementExistsTemp1 != null) {
          elementExistsTemp1.parentNode.removeChild(elementExistsTemp1);
        }
        let table = document.createElement("table");
        table.setAttribute("id", "allUsers");
        let tableRowHeader = document.createElement("tr");
        let nameHeader = document.createElement("th");
        nameHeader.innerHTML = "Name";
        let totalHeader = document.createElement("th");
        totalHeader.innerHTML = "Total Amount";
        tableRowHeader.appendChild(nameHeader);
        tableRowHeader.appendChild(totalHeader);
        table.appendChild(tableRowHeader);

        let usersWthTotal = data.users;

        for (let i = 0; i < usersWthTotal.length; i++) {
          let tableRow = document.createElement("tr");

          let nameData = document.createElement("td");
          nameData.innerHTML = usersWthTotal[i].user_name;

          let totalAmtData = document.createElement("td");
          totalAmtData.innerHTML = usersWthTotal[i].total_amount;

          let userIdData = document.createElement("td");
          userIdData.setAttribute("style", "visibility:hidden;");
          userIdData.setAttribute("id", "userID");
          userIdData.innerHTML = usersWthTotal[i].user_id;

          tableRow.appendChild(nameData);
          tableRow.appendChild(totalAmtData);
          tableRow.appendChild(userIdData);
          table.appendChild(tableRow);

          tableRow.addEventListener("click", function(e) {
            let specificOrderTable = document.getElementById("specificorder");
            if (specificOrderTable)
              specificOrderTable.setAttribute("style", "display:none;");
            selectedUserID = e.composedPath()[1].children[2].textContent; //selected user id
            // consolet selectedUserID = e.path[2].rows[1].children[2].textContent; //selected user idle.log(selectedUserID);

            if (dateFrom.value !== "" && dateTo.value !== "") {
              let obj = {
                user_id: selectedUserID,
                dateFrom: dateFrom.value,
                dateTo: dateTo.value,
                expandUserOrder: 1
              };

              $.ajax({
                url: "checksHelper.php",
                type: "post",
                dataType: "json",
                data: obj,
                success: function(data) {
                  if (data.code == "200") {
                    let elementExistsTemp2 = document.getElementById(
                      "specificUser"
                    );
                    if (elementExistsTemp2 !== null) {
                      elementExistsTemp2.remove();
                    }

                    let table = document.createElement("table");
                    table.setAttribute("id", "specificUser");
                    let tableRowHeader = document.createElement("tr");
                    let orderDateHeader = document.createElement("th");
                    orderDateHeader.innerHTML = "Order Date";
                    let totalHeader = document.createElement("th");
                    totalHeader.innerHTML = "Amount";
                    tableRowHeader.appendChild(orderDateHeader);
                    tableRowHeader.appendChild(totalHeader);
                    table.appendChild(tableRowHeader);

                    for (let i = 0; i < data.orders.length; i++) {
                      let tableRow = document.createElement("tr");

                      let orderDateData = document.createElement("td");
                      orderDateData.innerHTML = data.orders[i].order_date;
                      orderDateData.setAttribute("class", "order-details");
                      orderDateData.setAttribute("id", data.orders[i].order_id);

                      let totalAmtData = document.createElement("td");
                      totalAmtData.innerHTML = data.orders[i].total_amount;

                      tableRow.appendChild(orderDateData);
                      tableRow.appendChild(totalAmtData);
                      table.appendChild(tableRow);
                    }
                    contentBody.appendChild(table);
                  }
                  addListenerToOrdersData();
                }
              });
            } else {
              alert("You must specify date from and date to");
            }
          });
        }

        contentBody.appendChild(table);
      }
    }
  });
});
function addListenerToOrdersData() {
  let ordersDate = document.getElementsByClassName("order-details");

  if (ordersDate.length >= 1) {
    for (let item of ordersDate) {
      item.addEventListener("click", function() {
        console.log(item);
        let obj = {
          order_id: item.id,
          dateFrom: dateFrom.value,
          dateTo: dateTo.value,
          expandedOrder: 1
        };

        $.ajax({
          url: "checksHelper.php",
          type: "post",
          dataType: "json",
          data: obj,
          success: function(data) {
            if (data.code == "200") {
              let contentBody = document.getElementsByClassName("content")[0];
              console.log(data);
              let elementExistsTemp2 = document.getElementById("specificorder");
              if (elementExistsTemp2 !== null) {
                elementExistsTemp2.remove();
              }

              let table = document.createElement("table");
              table.setAttribute("id", "specificorder");
              let tableRowHeader = document.createElement("tr");
              let nameHeader = document.createElement("th");
              nameHeader.innerHTML = "Name";
              let imageHeader = document.createElement("th");
              imageHeader.innerHTML = "Image";
              let priceHeader = document.createElement("th");
              priceHeader.innerHTML = "Price";
              let quantityHeader = document.createElement("th");
              quantityHeader.innerHTML = "Quantity";
              tableRowHeader.appendChild(nameHeader);
              tableRowHeader.appendChild(imageHeader);
              tableRowHeader.appendChild(priceHeader);
              tableRowHeader.appendChild(quantityHeader);
              table.appendChild(tableRowHeader);

              for (let i = 0; i < data.ordersdetails.length; i++) {
                // console.log(data.ordersdetails[0]);
                let img=data.ordersdetails[i]["product_img"].replace(" ","%20");
                let tableRow = document.createElement("tr");
                let name = document.createElement("td");
                name.innerHTML = data.ordersdetails[i]["product_name"];
                let image = document.createElement("td");
                image.innerHTML = "<img src=../imag/"+img+" >";
                let price = document.createElement("td");
                price.innerHTML = data.ordersdetails[i]["price"];
                let quantity = document.createElement("td");
                quantity.innerHTML = data.ordersdetails[i]["quantity"];
                tableRow.appendChild(name);
                tableRow.appendChild(image);
                tableRow.appendChild(price);
                tableRow.appendChild(quantity);
                table.appendChild(tableRow);
              }
              contentBody.appendChild(table);
            }
          }
        });
      });
    }

    // contentBody.appendChild(table);
  }
}
