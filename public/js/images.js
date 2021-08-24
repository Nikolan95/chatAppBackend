
function openImage(){
    var img = $('#img').attr("src");
    //var blob = $('#blob').val();
    var image = new Image();
    image.src = img;
    console.log(blob);
        var appear_image = "<div class='bigimage' id='appear_image_div' onClick='closeImage()'</div>";
        appear_image = appear_image.concat("<img id='appear_image' src='"+ img +"' />");
        appear_image = appear_image.concat("<img id='close_image' src'close.png' />");

    $('body').prepend(appear_image);
}
function closeImage(){
    $('#appear_image_div').remove();
    $('#appear_image').remove();
    $('#close_image').remove();
}

