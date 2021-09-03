var reciever_id = '';
let my_id = "{{ Auth::id() }}";

$(document).ready(function () {
    $('.conversation').click(function () {
        $('.conversation').removeClass('unread');
        $(this).addClass('unread');
        $(this).find('.pending').remove();
        chatName = $(this).attr('value');
        car = $(this).attr('itemprop');
        $('.chatName').html(chatName +'    '+ car);
        $('.profile-name').html(chatName);
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


        // $("#documentModal").on("click", function(e) { 
        //     e.preventDefault();
        //     alert('klik');
        //     // $('.offerModal').modal('show');
        //     // $('.offerModal').on('shown.bs.modal', function() {
        //     //     $('.offerModal').find('#billing_adress').html('<strong class="font-14">Billed To :</strong><br>'+
        //     //     'vfdv<br>'+
        //     //     '795 Folsom Ave<br>'+
        //     //     'San Francisco, CA 94107<br>'+
        //     //     '<abbr title="Phone">P:</abbr> (123) 456-7890');
        //     // });
        // });
        



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
            $('#' + $('#conversation_id').val()).click();
        }
        else if ($('#user_id').val() == data.to) {



            if ($('#second_user_id').val() == data.from) {
                // if receiver is selected, reload the selected user ...
                $('#' + $('#conversation_id').val()).click();
            } else {
                // if receiver is not seleted, add notification for that user
                var pending = parseInt($('#' + data.from).find('.pending').html());

                if (pending) {
                    alert('pending');
                    $('#' + data.from).find('.pending').html(pending + 1);
                } else {
                    alert('not pending');
                    $('#' + data.from).append('<span class="pending">1</span>');
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
                        $(`#drag_files`).modal('hide');
                     scrollToBottomFunc();
                 }
             })
         }
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
})
function scrollToBottomFunc() {
    $('.chat-body').animate({
        scrollTop: $('.chat-body').get(0).scrollHeight
    }, 50);
}
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

