$(document).ready(function(){
    var i = 0;
    $('#addRow').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'">'+
            '<td><input type="hidden" name="items['+i+'][id]" value=""><input type="text" name="items['+i+'][article]" class="form-control desc"> </td>'+
            '<td><input type="text" name="items['+i+'][name]"  class="form-control desc"> </td>'+
            '<td><input type="text" name="items['+i+'][amount]"  class="form-control amount"> </td>'+
            '<td><input type="text" name="items['+i+'][price]" class="form-control price"> </td>'+
            '<td><input type="text" class="form-control input-sm totalRow" name="items['+i+'][total]" id="total" readonly> <input type="hidden" class="totalFlat" name="items['+i+'][totalFlat]" id="totalFlat"></td>'+
            '<td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>'+
            '</tr>'
        )
    });

    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id");
        $("#row" +button_id+"").remove();
    });
    $('tbody').on('keyup','.price,.amount',function(){
        var tr =$(this).parent().parent();
        var amount = tr.find('.amount').val();
        var price = tr.find('.price').val();
        var mul =(amount*price);
        tr.find('.totalRow').val(accounting.formatMoney(mul,"", 2, ".", ",")+' €');
        tr.find('.totalFlat').val(mul);
        result();
    });

    function result(){
    
    var sum = 0;
    $('.totalFlat').each(function(i,e){
        var mul = $(this).val()-0;

        sum += mul;
    })
     
    $('#result').html(accounting.formatMoney(sum,"", 2, ".", ",")+' €');
        console.log(sum);
    }; 
});