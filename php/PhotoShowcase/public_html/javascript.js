function validateLogin(form){
    var username = form.username.value;
    var password = form.password.value;
    
    if((/\W/.test(username))){
        alert("A-z 0-9 _ ONLY!");
        return false;
    }
    else if ((/\W/.test(password))){
        alert("A-z 0-9 _ ONLY!");
        return false;
    }
    else{
        return true;
    }
}
function validateUpload(form){
    var image = form.image.value;
    var title = form.title.value;
    var area = form.description.value;
    if(/\W/.test(title)){
        alert("A-z 0-9 and _ can be used in title.");
        return false;
    }
    if(title ===''){
        alert("Image must have a name!");
        return false;
    }
    if(image ===''){
        alert("No image selected!");
        return false;
    }
    else{
        return true;
    }
}
function showImage(image){
    img = document.createElement('img');
    img.src = image.src;
    img.className = 'showImg';
    document.body.appendChild(img);
    div = document.getElementById('darkLayer');
    div.className = 'darkBackground';
    
    img.onclick = function(){
        div.className = '';
        img.parentNode.removeChild(img);
    };
}

function hover(button){
    button.style.color = '#000000';
    button.style.background = '#FFFFFF';
}
function noHover(button){
    button.style.color = '#FFFFFF';
    button.style.background = '#000000';
}