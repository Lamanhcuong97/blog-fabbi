(function($){

    $(document).on('change', "input[type='file']", function(){
            readURL(this);
    })

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImage').attr('src', e.target.result);
            }
            console.log(input.files[0]);
            reader.readAsDataURL(input.files[0]);
        }
    }

   
    


})(jQuery);

$(document).ready( function(){
    var url = $('#table-posts').attr('data-url');
    var url_user = $('#table-user-posts').attr('data-url');
    
    $('#table-posts').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'content', name: 'content' },
                    { data: 'author', name: 'author'},
                    { data: 'categories', name: 'categories' },
                    { data: 'thumnail', name: 'thumnail' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
    });

    $('#table-user-posts').DataTable({
        processing: true,
        serverSide: true,
        ajax: url_user,
        columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'content', name: 'content' },
                { data: 'author', name: 'author'},
                { data: 'categories', name: 'categories' },
                { data: 'thumnail', name: 'thumnail' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                ]
    });

    $(document).on('click', '.btn-quick-edit', function(){
        let link = $(this).attr('data-url');
        let link_update = $(this).attr('data-url-update');
        $('#modalEditPost #form-quick-update').attr('action', link_update);
        $.ajax({
            type:'GET',
            url: link,
            success:function(data) {
              console.log(data);
              let temp = "";
              data.categories.forEach( category => {
                  let selected = ''; 
                  console.log(data.post_categories.includes(category.id));
                  if(data.post_categories.includes(category.id)){
                    selected = 'selected';
                  }
                  temp += "<option value='"+ category.id +"'"+ selected +">"+ category.name +"</option>"
              });

              $('#modalEditPost #title').val(data.post.title);      
              $('#modalEditPost #description').val(data.post.description); 
              $('#modalEditPost #content').val(data.post.content); 
              $('#modalEditPost #categories').html(temp); 
              $('#modalEditPost #previewImage').attr('src', data.post.thumnail);       
            }
         });
    });
});
