import { finished } from "stream";

$(document).on('click', '.quick-edit', function(){
    let link = $(this).attr('data-url');
    let linkUpdate = $(this).attr('data-url-update');
    $('button#update-ajax').attr('data-id', linkUpdate);
    $.ajax({
        type: 'GET',
        url: link,
        dataType: 'json',
        success:function(data){
            $('#name').val(data.categories.name);
            $('#text').val(data.categories.text);
        }        
    });
});

$(document).on('click', '#update-ajax', function(){
    let link = $(this).attr('data-id');
    let name = $('#name').val();
    let text = $('#text').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        type: 'POST',
        url: link,
        data: {
            name: name,
            text: text
        },
        success:function(response){
            console.log(response);
            $('#exampleModal').modal('hide');
            $('tr#tr_' + response.id).find('.name').html(response.name);
            $('tr#tr_' + response.id).find('.text').html(response.text);
            $('tr#tr_' + response.id).find('.created_at').html(response.created_at);
            $('tr#tr_' + response.id).find('.updated_at').html(response.updated_at);     
        }
    });
});
