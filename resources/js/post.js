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
});
