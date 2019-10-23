
$(document).on('click', '.quick-edit', function(){
    let link = $(this).attr('data-url');
    let linkUpdate = $(this).attr('data-url-update');
    $('#form-quick-update').attr('action', linkUpdate);
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
