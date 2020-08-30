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
        additem.insertAdjacentHTML("afterend",`<span class="items" id="${item}">${item} <button onclick="removeItem('${item}')"    class="crossbtn">X</button></span>`);
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

function recipedisplay()
{
    document.getElementById('fav').style.display="none";
    document.getElementById('review').style.display="none";
    document.getElementById('favnav').style.borderBottom="none";
    document.getElementById('reviewnav').style.borderBottom="none";
    document.getElementById('recipe').style.display="block";
    document.getElementById('recipenav').style.borderBottom="3px solid #337279";
}
function favdisplay()
{
    document.getElementById('recipe').style.display="none";
    document.getElementById('review').style.display="none";
    document.getElementById('recipenav').style.borderBottom="none";
    document.getElementById('reviewnav').style.borderBottom="none";
    document.getElementById('fav').style.display="block";
    document.getElementById('favnav').style.borderBottom="3px solid #337279";
}

function reviewdisplay()
{
    document.getElementById('fav').style.display="none";
    document.getElementById('recipe').style.display="none";
    document.getElementById('favnav').style.borderBottom="none";
    document.getElementById('recipenav').style.borderBottom="none";
    document.getElementById('review').style.display="block";
    document.getElementById('reviewnav').style.borderBottom="3px solid #337279";
}

function editopen()
{
    document.getElementById('editprofileback').style.visibility="visible";
}
function editclose()
{
    document.getElementById('editprofileback').style.visibility="hidden";
}
function changeprofilepic()
{
    document.getElementById('profilepicdiv').style.background="linearGradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(images/defaultprofilepic1.png));"
    document.getElementById('editprofilepic').style.visibility="visible"
}
function changeprofilepicstop()
{
    document.getElementById('profilepicdiv').style.background="url(images/defaultprofilepic1.png);"
    document.getElementById('editprofilepic').style.visibility="hidden";
}
