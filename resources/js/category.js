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

$(document).ready( function(){
    let url = $('#list-category').attr('data-url');
    let urlAdmin = $('#admin-list-category').attr('data-url-admin');
    $('#list-category').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'text', name: 'text' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
    
    $('#admin-list-category').DataTable({
        processing: true,
        serverSide: true,
        ajax: urlAdmin,
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'text', name: 'text' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    }); 
});
