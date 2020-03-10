let tableSection = document.getElementsByClassName("content")[0]; 
let isCancelled = false;

window.addEventListener("load", function() {
    let dataObj = { getAllOrders: 1 };

    $.ajax({
        url: "homeHelper.php",
        type: "post",
        dataType: "json",
        data: dataObj,
        success: function (data) {

            if (data.code == "200") {
                
                let usersOrders = data.orders;

                let ordersTable = document.createElement("table");
                ordersTable.setAttribute("id", "data");

                let tableRow = document.createElement("tr");
                let nameHeader = document.createElement("th");
                nameHeader.innerHTML = "User Name";
                let orderDateHeader = document.createElement("th");
                orderDateHeader.innerHTML = "Order Date";
                let roomHeader = document.createElement("th");
                roomHeader.innerHTML = "Room";
                let notesHeader = document.createElement("th");
                notesHeader.innerHTML = "Notes";
                let amountHeader = document.createElement("th");
                amountHeader.innerHTML = "Amount";
                let actionHeader = document.createElement("th");
                actionHeader.innerHTML = "Action";
                tableRow.appendChild(nameHeader);
                tableRow.appendChild(orderDateHeader);
                tableRow.appendChild(roomHeader);
                tableRow.appendChild(notesHeader);
                tableRow.appendChild(amountHeader);
                tableRow.appendChild(actionHeader);
                ordersTable.appendChild(tableRow);

                for(let i = 0; i < usersOrders.length; i++) {

                    let tableRow = document.createElement("tr");

                    let nameData = document.createElement("td");
                    nameData.innerHTML = usersOrders[i].user_name;

                    let orderDate = document.createElement("td");
                    orderDate.innerHTML = usersOrders[i].order_date;

                    let orderRoom = document.createElement("td");
                    orderRoom.innerHTML = usersOrders[i].room;

                    let orderNotes = document.createElement("td");
                    orderNotes.innerHTML = usersOrders[i].notes;

                    let orderAmount = document.createElement("td");
                    orderAmount.innerHTML = usersOrders[i].amount;

                    let orderAction = document.createElement("button");
                    orderAction.innerHTML = "Cancel?";
                    orderAction.setAttribute("type", "button");
                    orderAction.setAttribute("id", usersOrders[i].order_id);
                    orderAction.setAttribute("class", "button deletebtn");

                    tableRow.appendChild(nameData);
                    tableRow.appendChild(orderDate);
                    tableRow.appendChild(orderRoom);
                    tableRow.appendChild(orderNotes);
                    tableRow.appendChild(orderAmount);
                    tableRow.appendChild(orderAction);
                    ordersTable.appendChild(tableRow);
                    
                    orderAction.addEventListener("click", function(e) {
                        
                        let orderID = e.target.id;
                        let dataObj = {delteOrder: 1, order_id: orderID};
                        
                        $.ajax({
                            url: "homeHelper.php",
                            type: "post",
                            dataType: "json",
                            data: dataObj,
                            success: function (data) {
                                if(data.code == "200" && data.result)
                                {
                                    orderisCancelled(e);
                                }
                            }
                        });
                        
                    });
                    
                    
                }

                tableSection.appendChild(ordersTable);
            }
        }
    });
});

function orderisCancelled(value)
{
    // console.log(value.target.parentNode);
    value.target.parentNode.remove();
}