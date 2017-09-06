$(function () {

    $(function () {
        $(".select2").select2();
        $('.summernote').summernote({
            height: 450, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false, // set focus to editable area after initializing summernote,
            callbacks: {
                onImageUpload: function (image) {
                    let sizeKB = image[0]['size'] / 1000;
                    let tmp_pr = 0;
                    if (sizeKB > 200) {
                        tmp_pr = 1;
                        alert("pls, select less then 200kb image.");
                    }
                    if (image[0]['type'] !== 'image/jpeg' && image[0]['type'] !== 'image/png') {
                        tmp_pr = 1;
                        alert("pls, select png or jpg image.");
                    }
                    if (tmp_pr === 0) {
                        let file = image[0];
                        let reader = new FileReader();
                        reader.onloadend = function () {
                            let image = $('<img>').attr('src', reader.result);
                            $('#editor').summernote("insertNode", image[0]);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        });
    });
});

$('#media-library-slim').slimScroll({
    color: '#3900ff',
    size: '10px',
    height: '500px',
    railVisible: true,
    alwaysVisible: false
});

$(document).ready(function (e) {
    $('.input-hiddens34').on('change', function () {
        $('.input-hiddens34').not(this).prop('checked', false);
        console.log(this);
    });
});