let dateFrom = document.getElementById("date-from");
let dateTo = document.getElementById("date-to");
let userId = document.getElementById("getUserId");

window.addEventListener("load", function() {
  // console.log(userId);

  let dataObj = {
    user_id: userId.value,
    dateFrom: "2020-01-01",
    dateTo: "2020-12-30",
    expandUserOrder: 1
  }; //change the user id
  $.ajax({
    url: "displaymanual.php",
    type: "post",
    dataType: "json",
    data: dataObj,
    success: function(data) {
      if (data.code == "200") {
        let contentBody = document.getElementsByClassName("mainpart2")[0];
        console.log(data)
        let table = document.createElement("table");
        table.setAttribute("id", "data");
        let tableRowHeader = document.createElement("tr");
        let orderDateHeader = document.createElement("th");
        orderDateHeader.innerHTML = "Order Date";
        let totalHeader = document.createElement("th");
        totalHeader.innerHTML = "Amount";
        let cancelOrder = document.createElement("th");
        cancelOrder.innerHTML = "Control Order";
        tableRowHeader.appendChild(orderDateHeader);
        tableRowHeader.appendChild(totalHeader);
        tableRowHeader.appendChild(cancelOrder);
        table.appendChild(tableRowHeader);

        for (let i = 0; i < data.orders.length; i++) {
          let tableRow = document.createElement("tr");
          // tableRow.style.cursor = "pointer";
          tableRow.setAttribute("class", "order");
          tableRow.setAttribute("id",data.orders[i].order_id)
          let orderDateData = document.createElement("td");
          // orderDateData.setAttribute("class", "order");
          orderDateData.innerHTML = data.orders[i].order_date;

          let totalAmtData = document.createElement("td");
          totalAmtData.innerHTML = data.orders[i].total_amount;

          // let cancelButtonLink = document.createElement("a");
          // cancelButtonLink.href = './displaymanual.php';

          let cancelButton = document.createElement("button");
          cancelButton.innerHTML = "Cancel?";
          cancelButton.setAttribute("id", "cancelOrder");

          cancelButton.classList.add("btn-delete");
          cancelButton.setAttribute("order-id", data.orders[i].order_id);
          cancelButton.addEventListener("click", function() {
            const id = this.getAttribute("order-id");
            $.ajax({
              url: "./removeorder.php?order_id=" + id,
              type: "get",
              dataType: "json",
              success: function() {
                cancelButton.parentNode.remove();
              }
            });
          });

          tableRow.appendChild(orderDateData);
          tableRow.appendChild(totalAmtData);
          tableRow.appendChild(cancelButton);
          table.appendChild(tableRow);
        }

        contentBody.appendChild(table);
        addListenerToOrdersData();
      } else {
        alert("Failed to retrieve ");
      }
    }
  });
});

let getOrdersBtn = document.getElementById("getOrders"); //button

getOrdersBtn.addEventListener("click", function() {
  if (dateFrom.value !== "" && dateTo.value !== "") {
    let dataObj = {
      user_id: userId.value,
      dateFrom: dateFrom.value,
      dateTo: dateTo.value,
      expandUserOrder: 1
    }; //change the user id
    $.ajax({
      url: "displaymanual.php",
      type: "post",
      dataType: "json",
      data: dataObj,
      success: function(data) {
        if (data.code == "200") {
          let contentBody = document.getElementsByClassName("mainpart2")[0];

          let elementExistsTemp1 = document.getElementById("data");
          if (elementExistsTemp1 != null) {
            elementExistsTemp1.remove();
          }
          let table = document.createElement("table");
          table.setAttribute("id", "data");
          let tableRowHeader = document.createElement("tr");
          let orderDateHeader = document.createElement("th");
          orderDateHeader.innerHTML = "Order Date";
          let totalHeader = document.createElement("th");
          totalHeader.innerHTML = "Amount";
          let cancelOrder = document.createElement("th");
          cancelOrder.innerHTML = "Control Order";
          tableRowHeader.appendChild(orderDateHeader);
          tableRowHeader.appendChild(totalHeader);
          tableRowHeader.appendChild(cancelOrder);
          table.appendChild(tableRowHeader);

          for (let i = 0; i < data.orders.length; i++) {
            let tableRow = document.createElement("tr");
            // tableRow.style.cursor = "pointer";
            tableRow.setAttribute("class", "order-row");
            let orderDateData = document.createElement("td");
            orderDateData.innerHTML = data.orders[i].order_date;

            let totalAmtData = document.createElement("td");
            totalAmtData.innerHTML = data.orders[i].total_amount;

            let cancelButton = document.createElement("button");
            cancelButton.innerHTML = "Cancel?";
            cancelButton.setAttribute("id", "cancelOrder");

            cancelButton.classList.add("btn-delete");
            cancelButton.setAttribute("order-id", data.orders[i].order_id);
            cancelButton.addEventListener("click", function() {
              const id = this.getAttribute("order-id");
              $.ajax({
                url: "removeorder.php?order_id=" + id,
                type: "get",
                dataType: "json",
                success: function() {
                  cancelButton.parentNode.parentNode.remove();
                }
              });
            });

            tableRow.appendChild(orderDateData);
            tableRow.appendChild(totalAmtData);
            tableRow.appendChild(cancelButton);
            table.appendChild(tableRow);
          }

          contentBody.appendChild(table);
        //   addListenerToOrdersData();

        } else {
          alert("Failed to retrieve ");
        }
      }
    });
  } else {
    alert("You must specify date from and date to");
  }
});

function addListenerToOrdersData() {
  let ordersDate = document.getElementsByClassName("order");
  console.log(ordersDate.length);
  if (ordersDate.length >= 1) {
    for (let item of ordersDate) {
      item.addEventListener("click", function() {
        let obj = {
          order_id: item.id,
          dateFrom: dateFrom.value,
          dateTo: dateTo.value,
          expandedOrder: 1
        };

        $.ajax({
          url: "displaymanual.php",
          type: "post",
          dataType: "json",
          data: obj,
          success: function(data) {
            if (data.code == "200") {
              let contentBody = document.getElementsByClassName("mainpart2")[0];
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
                console.log(data.ordersdetails[i]["product_img"]);
                if(data.ordersdetails[i]["product_img"])
                var img = data.ordersdetails[i]["product_img"].replace(" ","%20");
                let tableRow = document.createElement("tr");
                let name = document.createElement("td");
                name.innerHTML = data.ordersdetails[i]["product_name"];
                let image = document.createElement("td");
                if(img)
                image.innerHTML = "<img src=../imag/" + img + " >";
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
