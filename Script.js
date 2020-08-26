
var itemList = [];
function addItem()
{
    
    var item = (document.getElementById('items').value).toLowerCase();
    if(item === "")
    {
        return;
    }
    else if(itemList.includes(item))
    {
        alert("Item already Added !!");
        document.getElementById('items').value = "";
    }
    else{
        var additem = document.getElementById('itemAdded');
        itemList.push(item);
        document.getElementById('items').value = "";
        additem.insertAdjacentHTML("afterend",`<span class="items" id="${item}">${item}<button onclick="removeItem('${item}')">X</button></span>`);
    }
}

function removeItem(item)
{
    document.getElementById(item).remove();
    var index = itemList.indexOf(item);
    itemList.splice(index,1);
}

function popup()
{
    document.getElementById('popupid2').style.visibility="hidden";
    document.getElementById('popupid').style.visibility="visible";
}
function popupclose()
{
    document.getElementById('popupid').style.visibility="hidden";
}
function popupsignup()
{
    document.getElementById('popupid').style.visibility="hidden";
    document.getElementById('popupid2').style.visibility="visible";
}
function popupsignupclose()
{
    document.getElementById('popupid2').style.visibility="hidden";
}
function menushow()
{
    document.getElementById('dropdownmenu').style.visibility="visible";
}
function menuhide()
{
    document.getElementById('dropdownmenu').style.visibility="hidden";
}
