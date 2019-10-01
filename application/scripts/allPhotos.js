function addLike(id) {

    if (id == null)
    {
        id = '0';
    }

    var src = document.getElementById('like_'+id).attributes.getNamedItem("src").value;

    if (src == "/application/images/heart.png") {
        document.getElementById('like_'+id).src = "/application/images/heart-2.png";
        var elem = document.getElementById('numberLike_'+id);
        var numberLike = elem.innerHTML;
        numberLike = parseInt(numberLike);
        numberLike++;
        elem.innerHTML = numberLike+' likes';
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/action/addLike?imageId="+id, true);
        xhr.send(null);
    }
    else if (src == "/application/images/heart-2.png") {
        document.getElementById('like_'+id).src = "/application/images/heart.png";
        var elem = document.getElementById('numberLike_'+id);
        var numberLike = elem.innerHTML;
        numberLike = parseInt(numberLike);
        numberLike--;
        elem.innerHTML = numberLike+' likes';
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/action/deleteLike?imageId="+id, true);
        xhr.send(null);
    }
}

function addComment(id, comment, login) {

    com = htmlEntities(comment.value);
    if (com.trim() === "")
        return ;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/action/addComment", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("imageId="+id+"&comment="+com);
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var div = document.createElement("DIV");
            div.setAttribute("class", "allcomments");
            div.innerHTML = "<b>"+login+"</b> "+com;
            document.getElementById('firstcomment_'+id).appendChild(div);
            comment.value = "";
        }
    }
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    //converts special characters (like <) into their escaped/encoded values (like &lt;).
}

function disp(form) {
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}