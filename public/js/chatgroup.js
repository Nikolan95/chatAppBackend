$('#plaudern').click(function() {
    $('.createGroup').remove();
    $('.listgroup').remove();
    $('.user-list').show();
    $('.header').append('<button type="button" class="float-right btn btn-circle btn-sm header_button startConversation"'
                        +'data-toggle="modal" data-target="#chat-new">'
                        +'<i class="fas fa-plus button_plus"></i>'
                        +'</button>')
});

$('#gruppe').click(function() {
    $('.user-list').hide();
    $('.startConversation').remove();
    $('.header').append('<button type="button" class="float-right btn btn-circle btn-sm header_button createGroup"'
                        +'data-toggle="modal" data-target="#group-new">'
                        +'<i class="fas fa-plus button_plus"></i>'
                        +'</button>');
    $('#chatsidebar').prepend('<ul class="user-list listgroup">'
                            +'<li class="user-list-item conversation">'
                            +'<div class="users-list-body">'
                            +'<div>'
                                +'<h5>grupa1</h5>'
                                +'<p>grupa</p>'
                            +'</div>'
                            +'</div>'
                            +'</li>'
                            +'</ul>')
});

$('#creategroups').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },              
        success: function(data)
        {
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                alert('success');
            }
        }
    })
});
$('#creategroup').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
        url:$(this).attr('action'),
        method:$(this).attr('method'),
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        beforeSend:function(){
            $(document).find('span.error-text').text('');
        },              
        success: function(data)
        {
            if(data.status == 0){
                $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                });
            }else{
                $('#group-new').modal('hide');
                alert('success');
            }
        }
    })
});