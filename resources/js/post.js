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
