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


// Image preview of input images
var i=0;
var filesList={};
function PreviewImage() {

    var oFReader = new FileReader();
    var item = document.getElementById("uploadImage").files[0];
    filesList[i] = item;
    oFReader.readAsDataURL(item);

    
    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").insertAdjacentHTML("afterend",
        `<div id="${i}" class="preview">
            <img  style="width: 100px; height: 100px;" src="${oFREvent.target.result}" class="previewimg"><button onclick="removeimage('${i}')"class="removebtn">X</button>
        </div>`);
    };
    i=i+1;
    console.log(filesList);
};

function removeimage(i)
{
    document.getElementById(i).remove();
    delete filesList[i];
    console.log(filesList);
}

//Feed Back Form popup
function feedbackFormOpen()
{
    document.getElementById('review-box').style.visibility="visible";
}
function feedbackFormClose()
{
    document.getElementById('review-box').style.visibility="hidden";
}

//img onclick

function picboxdisplay(smallpicid1,smallpicid2,smallpicid3,smallpicid4)
{
    var sourceimg=document.getElementById(smallpicid1).src;
    document.getElementById(smallpicid1).style.border="2px solid #337279";
    document.getElementById(smallpicid2).style.border="none";
    document.getElementById(smallpicid3).style.border="none";
    document.getElementById(smallpicid4).style.border="none";
    document.getElementById('bigpicdiv').style.backgroundImage="url('"+sourceimg+"')";
}
