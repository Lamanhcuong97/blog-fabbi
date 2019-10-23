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
            reader.readAsDataURL(input.files[0]);
        }
    }

   
    


})(jQuery);

$(document).ready( function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var url = $('#table-posts').attr('data-url');
    var url_user = $('#table-user-posts').attr('data-url');
    var upload = '';
    
   table = $('#table-posts').DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            createdRow : function( row, data, dataIndex ) {
                $(row).attr('id', 'row-' + data.id);
            },
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
        $('#modalEditPost #btn-image').attr('data-url-update', link_update);
        $('#modalEditPost .btn-quick-update').attr('data-url-update', link_update);
        $.ajax({
            type:'GET',
            url: link,
            success:function(data) {
              let temp = "";
              data.categories.forEach( category => {
                  let selected = ''; 
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


    

    $(document).on('click', '#btn-image', function(e){
        e.preventDefault();
        let link = $(this).attr('data-url-update');
        
        if( window.FormData !== undefined ) 
        {
            var image = $('#image')[0].files[0];
            var  title = $('#title').val();
            var  content = $('#content').val();
            var  description = $('#description').val();
            var  categories = $('#categories').val();
            _method = $("input[name='_method']").val();
            

            upload = $("#upload-imge").uploadFile({
                url: link,
                fileName:"image",
                formData: {title : title, content : content, description : description, categories : categories},
                acceptFiles:"image/*",
                showPreview:true,
                previewHeight: "100px",
                previewWidth: "100px",
                autoSubmit:false,
                onSuccess:function(files,data,xhr,pd){
                    td = $('#row-' + data.post.id + ' td');
                    td.eq(1).html(data.post.title);
                    td.eq(2).html(data.post.content);
                    td.eq(4).html(data.post_categories);
                    td.eq(5).html("<img src='" + data.post.thumnail + "' border='0' width='40' class='img-rounded' align='center' />");
                    td.eq(6).html(data.post.created_at);
                    td.eq(7).html(data.post.updated_at);
                    $('#modalEditPost').modal('hide');
                    $('.ajax-file-upload-container').html('');
                    upload = '';
                },
            }); 
        } 
    });

    $(document).on('click', '.btn-quick-update', function(e){

        if(upload !== ''){
            upload.startUpload();
        }else{
            e.preventDefault();
            let link = $(this).attr('data-url-update');
            
            if( window.FormData !== undefined ) {

                var image = $('#image')[0].files[0];
                var  title = $('#title').val();
                var  content = $('#content').val();
                var  description = $('#description').val();
                var  categories = $('#categories').val();
                _method = $("input[name='_method']").val();
                
                data = $('#form-quick-update').serialize();

                $.ajax({
                    url: link,
                    data: data,
                    processData: false,
                    type: 'POST',
                    success: function ( data ) {
                        td = $('#row-' + data.post.id + ' td');
                        td.eq(1).html(data.post.title);
                        td.eq(2).html(data.post.content);
                        td.eq(4).html(data.post_categories);
                        td.eq(5).html("<img src='" + data.post.thumnail + "' border='0' width='40' class='img-rounded' align='center' />");
                        td.eq(6).html(data.post.created_at);
                        td.eq(7).html(data.post.updated_at);
                        $('#modalEditPost').modal('hide');
                    }
                });
            }
        }
    });
});
