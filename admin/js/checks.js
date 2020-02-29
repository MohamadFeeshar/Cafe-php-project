
let dateFrom = document.getElementById("date-from");
let dateTo = document.getElementById("date-to");

window.addEventListener("load", function () {
    let dataObj = { user_id: -1, selectUser: 1 };
    $.ajax({
        url: "checksHelper.php",
        type: "post",
        dataType: "json",
        data: dataObj,
        success: function (data) {

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

                    tableRow.addEventListener("click", function (e) {
                        
                        // console.log(e.composedPath()[1].children[2].textContent);
                        let selectedUserID = e.composedPath()[1].children[2].textContent; //selected user id
                        // let selectedUserID = e.path[1].cells[2].textContent; //selected user id
                        
                        if(dateFrom.value !== "" && dateTo.value !== "")
                        {
                            let obj = {user_id: selectedUserID, dateFrom: dateFrom.value, dateTo:dateTo.value, expandUserOrder: 1};
                            // console.log(obj);
                                         
                            $.ajax({
                                url: "checksHelper.php",
                                type: "post",
                                dataType: "json",
                                data: obj,
                                success: function (data) {
                                    if (data.code == "200")
                                    {
                                        let elementExistsTemp2 = document.getElementById("specificUser");
                                        if(elementExistsTemp2 !== null)
                                        {
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

                                        for(let i = 0; i < data.orders.length; i++){
                                            let tableRow = document.createElement("tr");

                                            let orderDateData = document.createElement("td");
                                            orderDateData.innerHTML = data.orders[i].order_date;
                        
                                            let totalAmtData = document.createElement("td");
                                            totalAmtData.innerHTML = data.orders[i].total_amount;
                        
                                            tableRow.appendChild(orderDateData);
                                            tableRow.appendChild(totalAmtData);
                                            table.appendChild(tableRow);
                                        }
                                        contentBody.appendChild(table);
                                        
                                    }
                                        
                                }
                            });
                        }
                        else
                        {
                            alert("You must specify date from and date to");
                        }

                    });
                }

                contentBody.appendChild(table);
            }

        }
    });
})

let dropdownMenu = document.getElementById("users");

dropdownMenu.addEventListener("change", function () {
    let dataObj = {};
    if (dropdownMenu.options[dropdownMenu.selectedIndex].value === "none") {
        dataObj = { user_id: -1, selectUser: 1 };
    }
    else {
        dataObj = { user_id: parseInt(dropdownMenu.options[dropdownMenu.selectedIndex].value), selectUser: 1 };
    }

    $.ajax({
        url: "checksHelper.php",
        type: "post",
        dataType: "json",
        data: dataObj,
        success: function (data) {

            if (data.code == "200") {

                let contentBody = document.getElementsByClassName("content")[0];
                let child = contentBody.lastChild;
                while (child) {
                    contentBody.removeChild(child);
                    child = contentBody.lastChild;
                }
                let elementExistsTemp1 = document.getElementById("allUsers");
                if(elementExistsTemp1!=null)
                {
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

                    tableRow.addEventListener("click", function (e) {
                        let selectedUserID = e.composedPath()[1].children[2].textContent; //selected user id
                        // consolet selectedUserID = e.path[2].rows[1].children[2].textContent; //selected user idle.log(selectedUserID);
                        
                        if(dateFrom.value !== "" && dateTo.value !== "")
                        {
                            let obj = {user_id: selectedUserID, dateFrom: dateFrom.value, dateTo:dateTo.value, expandUserOrder: 1};
                                                       
                            $.ajax({
                                url: "checksHelper.php",
                                type: "post",
                                dataType: "json",
                                data: obj,
                                success: function (data) {
                                    if (data.code == "200")
                                    {

                                        let elementExistsTemp2 = document.getElementById("specificUser");
                                        if(elementExistsTemp2 !== null)
                                        {
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

                                        for(let i = 0; i < data.orders.length; i++){
                                            let tableRow = document.createElement("tr");

                                            let orderDateData = document.createElement("td");
                                            orderDateData.innerHTML = data.orders[i].order_date;
                        
                                            let totalAmtData = document.createElement("td");
                                            totalAmtData.innerHTML = data.orders[i].total_amount;
                        
                                            tableRow.appendChild(orderDateData);
                                            tableRow.appendChild(totalAmtData);
                                            table.appendChild(tableRow);
                                        }
                                        contentBody.appendChild(table);
                                        
                                    }
                                        
                                }
                            });
                        }
                        else
                        {
                            alert("You must specify date from and date to");
                        }

                    });
                }

                contentBody.appendChild(table);
            }

        }
    });
});