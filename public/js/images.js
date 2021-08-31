
function openImage(imagecontent){
    var image = new Image();
    image.src = imagecontent;
    console.log(imagecontent);
        var appear_image = "<div class='bigimage' id='appear_image_div' onClick='closeImage()'</div>";
        appear_image = appear_image.concat("<img height='auto' style='max-height: 90%;width: auto' width='65%' id='appear_image' src='data:image/png;base64,"+ imagecontent +"' />");
        appear_image = appear_image.concat("<img id='close_image' src'close.png' />");

    $('body').prepend(appear_image);
}
function closeImage(){
    $('#appear_image_div').remove();
    $('#appear_image').remove();
    $('#close_image').remove();
}

