// var reciever_id = '';
// let my_id = "{{ Auth::id() }}";
function messaging(){
    $('.conversation').click(function () {
        //alert('kesa');
        $('.hidesidebar').show();
        $('.hidechatfooter').show();
        $('.hiddenchatheader').show();
        $('.conversation').removeClass('unread');
        $(this).addClass('unread');
        $(this).find('.pending').remove();
        $(this).find('.kesa').remove();
        chatName = $(this).attr('value');
        // email = $(this).attr('email');
        // address = $(this).attr('address');
        // telefon = $(this).attr('telefon');
        //car = $(this).attr('itemprop');
        $('.chatName').html(chatName);
        //$('.profile-name').html(chatName);
        // $('#sidename').html(chatName);
        // $('#sideemail').html(email);
        // $('#sideaddress').html(address);
        // $('#sidetelefon').html(telefon);
        $('.Slika img').show();
        conversationId = $(this).attr('id');
        sursId = $(this).attr('itemid');
        $('#cnv').val(conversationId);
        $('#susr').val(sursId);
        $('#cnv1').val(conversationId);
        $('#susr1').val(sursId);
        $('#groupUserId').val(sursId);
        $('#target').attr('data-target', '#offer_form'+conversationId);
        $('#target2').attr('data-target', '#offer_form'+conversationId);
        $('#targetpdf').attr('data-target', '#send_pdf'+conversationId);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/message/read/" + conversationId,
            data: "",
            cache: false,
            success: function (data) {
                console.log(data);
                $('.pending' + conversationId).val(0);
                $('.pending' + conversationId).hide();
            }
        });

        $.ajax({
            type: "get",
            url: "/messages/" + conversationId,
            data: "",
            cache: false,
            success: function (data) {
                $('.chat-body').html(data);
                scrollToBottomFunc();
            }
        });

        $.ajax({
            type: "get",
            url: "/profilename/" + conversationId,
            data: "",
            cache: false,
            success: function (data) {
                $('.sidebarprofilename').html(data);
            }
        });

        $.ajax({
            type: "get",
            url: "/kundedata/" + conversationId,
            data: "",
            cache: false,
            success: function (data) {
                $('.sidebarkundedata').html(data);
            }
        });

        $.ajax({
            type: "get",
            url: "/cardata/" + conversationId,
            data: "",
            cache: false,
            success: function (data) {
                $('.sidebarcardata').html(data);
            }
        });

        $.ajax({
            type: "get",
            url: "/medias/" + conversationId,
            data: "",
            cache: false,
            success: function (data) {
                $('.sidebarmedia').html(data);
            }
        });


        my_id = $('#user_id').val();
        Pusher.logToConsole = true;


    });
    var pusher = new Pusher('e8eff64d8b79b8610b42', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function (data) {
        // alert(JSON.stringify(data.to));
        // alert($('#user_id').val());

        //check if send user id equals user id from pusher then refresh view
        // alert($('#second_user_id').val() == data.to);

        if ($('#user_id').val() == data.from) {
            //alert('got message');
            $('.lasttime' + data.id).val('1 second ago');
            $('#' + $('#conversation_id').val()).click();
        }
        else if ($('#user_id').val() == data.to) {



            if ($('#second_user_id').val() == data.from) {
                var pending = parseInt($('.pending' + data.id).val());
                // if receiver is selected, reload the selected user ...
                if (pending) {
                    var moveup = $(".user-list").find(`[id='${data.id}']`);
                    $(".user-list").prepend(moveup);
                    $('.lastmessage' + data.id).val(data.message);
                    $('.lasttime' + data.id).val('1 second ago');
                    $('.pending' + data.id).show();
                    $('.pending' + data.id).val(pending+1);
                }
                else {
                    var moveup = $(".user-list").find(`[id='${data.id}']`);
                    $(".user-list").prepend(moveup);
                    $('.lastmessage' + data.id).val(data.message);
                    $('.lasttime' + data.id).val('1 second ago');
                    $('.pending' + data.id).show();
                    $('.pending' + data.id).val(1);
                }
                $('#' + $('#conversation_id').val()).click();
            } else {
                // if receiver is not seleted, add notification for that user
                var pending = parseInt($('.pending' + data.id).val());
                console.log(pending);

                if (pending) {
                    var moveup = $(".user-list").find(`[id='${data.id}']`);
                    $(".user-list").prepend(moveup);
                    $('.lastmessage' + data.id).val(data.message);
                    $('.lasttime' + data.id).val('1 second ago');
                    $('.pending' + data.id).show();
                    $('.pending' + data.id).attr('id', 'pendingcss');
                    $('.pending' + data.id).val(pending+1);
                }
                else {
                    var moveup = $(".user-list").find(`[id='${data.id}']`);
                    $(".user-list").prepend(moveup);
                    $('.lastmessage' + data.id).val(data.message);
                    $('.lasttime' + data.id).val('1 second ago');
                    $('.pending' + data.id).show();
                    $('.pending' + data.id).attr('id', 'pendingcss');
                    $('.pending' + data.id).val(1);
                }
            }
        }
    });

     $('#sendImage').on('submit', function(e) {
            e.preventDefault();
         user_id = $('#user_id').val();
         reciever_id = $('#second_user_id').val();
         conversation_id = $('#conversation_id').val();
         read = false;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         var image = $('.image').val();
         //var blob = new Blob([image]),
         slice = image;
         console.log(slice);
         if (image != '' && reciever_id != '') {
             $(this).val('');

             var datastr = "image=" + slice + "&read=" + read + "&user_id=" + user_id + "&conversation_id=" + conversation_id + "&second_user_id=" + reciever_id;
             console.log(datastr);
            $.ajax({
                 type: "post",
                 url: "/sendImage",
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                 cache: false,
                 success: function (data) {
                    
                 },
                 error: function (jqXHR, status, err) {

                 },
                 complete: function () {
                        $(`#drag_files`).modal('toggle');
                     scrollToBottomFunc();
                 }
             })
         }
     });

     $('#offerForm').on('submit', function(e) {
        e.preventDefault();
     user_id = $('#user_id').val();
     reciever_id = $('#second_user_id').val();
     conversation_id = $('#conversation_id').val();
     read = false;
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
         $(this).val('');

        $.ajax({
             type: "post",
             url: "/sendOffer",
             data: new FormData(this),
             processData: false,
             contentType: false,
             cache: false,
             success: function (data) {
                
             },
             error: function (jqXHR, status, err) {

             },
             complete: function () {
                    $(`.angebot`).modal('toggle');
                 scrollToBottomFunc();
             }
         })
     //}
 });


    $(document).on('keyup', '.input', function (e) {
        user_id = $('#user_id').val();
        reciever_id = $('#second_user_id').val();
        conversation_id = $('#conversation_id').val();
        read = false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var message = $(this).val();
        //console.log(message);
        if (e.keyCode == 13 && message != '' && reciever_id != '') {
            $(this).val('');

            var datastr = "body=" + message + "&read=" + read + "&user_id=" + user_id + "&conversation_id=" + conversation_id + "&second_user_id=" + reciever_id;
            console.log(datastr);
            $.ajax({
                type: "post",
                url: "/sendMessage",
                data: datastr,
                cache: false,
                success: function (data) {

                },
                error: function (jqXHR, status, err) {

                },
                complete: function () {
                    scrollToBottomFunc();
                }
            })
        }
    })
    function scrollToBottomFunc() {
        $('.chat-body').animate({
            scrollTop: $('.chat-body').get(0).scrollHeight
        }, 50);
    }
}
function OnloadFunction(){   
    $('#plaudern').click(function() {
        
        $('.startConversation').remove();
        $('.header').append('<button type="button" class="float-right btn btn-circle btn-sm header_button startConversation"'
            +'data-toggle="modal" data-target="#chat-new">'
            +'<i class="fas fa-plus button_plus"></i>'
            +'</button>')

        $.ajax({
            type: "get",
            url: "/normalchat",
            data: "",
            cache: false,
            success: function (data) {
                $('.user-list').remove();
                $('#chatsidebar').html(data);
                messaging();


            }
        });
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

    $('#promotion').click(function() {
        
        $('.startConversation').remove();
        $('.header').append('<a type="button" class="float-right btn btn-circle btn-sm header_button createGroup"'
            +'href="/promotion">'
            +'<i class="fas fa-plus button_plus"></i>'
            +'</a>');

        $.ajax({
            type: "get",
            url: "/promotions",
            data: "",
            cache: false,
            success: function (data) {
                $('.user-list').remove();
                $('#chatsidebar').html(data);
                messaging();         
            }
        });
        
        
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
}

$(document).ready(function () {
    $('.hidesidebar').hide();
    $('.hidechatfooter').hide();
    $('.hiddenchatheader').hide();

    OnloadFunction();
    messaging();
})
// function scrollToBottomFunc() {
//     $('.chat-body').animate({
//         scrollTop: $('.chat-body').get(0).scrollHeight
//     }, 50);
// }
// function openModal(id){
//     //alert(id);
//     //alert(kesa);
//      $('#offer'+id).modal('show');
//             // $('#offer'+id).on('shown.bs.modal', function() {
//             //     $('#offer'+id).find('#billing_adress').html('<strong class="font-14">Billed To :</strong><br>'+
//             //     'vfdv<br>'+
//             //     '795 Folsom Ave<br>'+
//             //     'San Francisco, CA 94107<br>'+
//             //     '<abbr title="Phone">P:</abbr> (123) 456-7890');
//             // });
// }

