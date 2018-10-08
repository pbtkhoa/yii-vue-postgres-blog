$(document).ready(function () {
    $(document).on('click', '.img-post-thumbnail button, .img-post-thumbnail img', function (e) {
        e.preventDefault();
        $(this).parent().find('input[type="file"]').trigger('click');
    });

    $(document).on('change', '.img-post-thumbnail input[type="file"]', function () {
        var input = this,
            url = $(this).val(),
            imgPostEle = $(this).closest('.img-post-thumbnail'),
            ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imgPostEle.find('img').removeClass('hidden').attr('src', e.target.result);
                imgPostEle.find('button').addClass('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            imgPostEle.find('img').addClass('hidden');
            imgPostEle.find('button').removeClass('hidden');
        }
    });
});