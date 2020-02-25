
window.addEventListener("load", function(){
    let dataObj = {user_id: -1};
    $.ajax({
        url: "checksHelper.php",
        type: "post",
        dataType: "json",
        data: dataObj,
        success : function(data){
            
            if (data.code == "200"){
                let contentBody = document.getElementsByClassName("content")[0];
                let child = contentBody.lastChild;
                while (child)
                {
                    contentBody.removeChild(child);
                    child = contentBody.lastChild;
                }
                let table = document.createElement("table");
                table.setAttribute("id", "data");
                let tableRowHeader = document.createElement("tr");
                let nameHeader = document.createElement("th");
                nameHeader.innerHTML = "Name";
                let totalHeader = document.createElement("th");
                totalHeader.innerHTML = "Total Amount";
                tableRowHeader.appendChild(nameHeader);
                tableRowHeader.appendChild(totalHeader);
                table.appendChild(tableRowHeader);
                let usersWthTotal = data.users;
                
                for (let i = 0; i < usersWthTotal.length; i++)
                {
                        let tableRow = document.createElement("tr");
                    
                        let nameData = document.createElement("td");
                        nameData.innerHTML = usersWthTotal[i].user_name;
                    
                        let totalAmtData = document.createElement("td");
                        totalAmtData.innerHTML = usersWthTotal[i].total_amount;
                    
                        tableRow.appendChild(nameData);
                        tableRow.appendChild(totalAmtData);
                        table.appendChild(tableRow);
                    }
                    
                contentBody.appendChild(table);
            }
            
        } 
    });
})

let dropdownMenu = document.getElementById("users");

dropdownMenu.addEventListener("change", function(){
    let dataObj = {};
    if(dropdownMenu.options[dropdownMenu.selectedIndex].value === "none")
    {
        dataObj = {user_id: -1};
    }
    else
    {
        dataObj = {user_id: parseInt(dropdownMenu.options[dropdownMenu.selectedIndex].value)};
    }
    
    $.ajax({
        url: "checksHelper.php",
        type: "post",
        dataType: "json",
        data: dataObj,
        success : function(data){
            
            if (data.code == "200"){
                
                let contentBody = document.getElementsByClassName("content")[0];
                let child = contentBody.lastChild;
                while (child)
                {
                    contentBody.removeChild(child);
                    child = contentBody.lastChild;
                }
                let table = document.createElement("table");
                table.setAttribute("id", "data");
                let tableRowHeader = document.createElement("tr");
                let nameHeader = document.createElement("th");
                nameHeader.innerHTML = "Name";
                let totalHeader = document.createElement("th");
                totalHeader.innerHTML = "Total Amount";
                tableRowHeader.appendChild(nameHeader);
                tableRowHeader.appendChild(totalHeader);
                table.appendChild(tableRowHeader);
                
                let usersWthTotal = data.users;
                
                for (let i = 0; i < usersWthTotal.length; i++)
                {
                        let tableRow = document.createElement("tr");
                    
                        let nameData = document.createElement("td");
                        nameData.innerHTML = usersWthTotal[i].user_name;
                    
                        let totalAmtData = document.createElement("td");
                        totalAmtData.innerHTML = usersWthTotal[i].total_amount;
                    
                        tableRow.appendChild(nameData);
                        tableRow.appendChild(totalAmtData);
                        table.appendChild(tableRow);
                    }
                    
                contentBody.appendChild(table);
            }
            
        } 
    });
});