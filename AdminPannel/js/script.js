$(document).ready(function () {

    $types = {
        'url': 'URL',
        'home': 'Home (redirection to Base URL)',
        'share': 'Share',
        'about': 'About',
        'rate_us': 'Rate Us',
        'languages': 'Languages',
        'dark': 'Dark Mode',
        'divider': 'Divider',
        'title_block': 'Title Block',
        'socials': 'List Socials',
        'notification': 'List Notifications'
    };

    var updateOutput = function () {
        $('#nestable-output').val(JSON.stringify($('#nestable').nestable('serialize')));
    };

    $('#nestable').nestable().on('change', updateOutput);

    updateOutput();


    //Form Submit
    $("#add-item").submit(function (e) {
        e.preventDefault();
        id = Date.now();
        let label = $("#name").val();
        let url = $("#url").val();
        let type = $("#type_menu").val();

        let image = $("#thumb_img").attr('src');

        let data_base64 = "true";
        if (image.indexOf(".png") != -1) {
            data_base64 = "false";
        }

        let title = label;
        if (type != "url" && type != "title") {
            title = $types[type]
        }

        let item = '<li class="dd-item dd3-item" data-id="' + id + '" data-label="' + label + '" data-old="false"  data-imagebase64="' + image + '" data-base64="' + data_base64 + '" data-url="' + url + '" data-type="' + type + '" data-icon="' + image + '">' +
            '<div class="dd-handle dd3-handle" > Drag</div>' +
            '<div class="dd3-content"><span>' + title + '</span>' +
            '<div class="item-edit">Edit</div>' +
            '</div>' +
            '<div class="item-settings d-none">';

        if (type == 'url') {
            item = item +
                '<div class="form-group col-xl-12 col-md-12 "><label for="">Navigation Label</label><input class="form-control" type="text" name="navigation_label" value="' + label + '"></div>' +
                '<div class="form-group col-xl-12 col-md-12 "><label for="">Navigation Url</label><input class="form-control" type="text" name="navigation_url" value="' + url + '"></div>' +
                '<div class="form-group col-xl-12 col-md-12 ">' +
                '<label for="image">Image</label><div class="input-group">' +
                '<input type="image" class="add_image img-thumbnail" name="answers_images[]" style="width:70px" id="test-' + id + '" src="' + image + '"  >' +
                '<input type="file" class="select_file" name="answers_images[]"  id="file-' + id + '" style="display: none;">' +
                '<input type="hiden" class="select_file_base64" name="answers_images_base64[]"  id="file-base64-' + id + '" style="display: none;">' +
                '</div></div> ' +
                '<a href="javascript:;" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' +
                '<span class="icon text-white-50">' +
                '<i class="fas fa-pencil-alt"></i>' +
                '</span>' +
                '<span class="text">Edit</span>' +
                '</a>';
        }

        if (type == 'title_block') {
            item = item +
                '<div class="form-group col-xl-12 col-md-12 "><label for="">Title Block</label><input class="form-control" type="text" name="navigation_label" value="' + label + '"></div>' +
                '<div class="form-group col-xl-12 col-md-12 ">' +
                '<a href="javascript:;" class="item-close btn btn-info btn-icon-split btn-sm mr-2">' +
                '<span class="icon text-white-50">' +
                '<i class="fas fa-pencil-alt"></i>' +
                '</span>' +
                '<span class="text">Edit</span>' +
                '</a>';
        }

        item = item + '<a href="javascript:;" class="item-delete btn btn-danger btn-icon-split btn-sm">' +
            '<span class="icon text-white-50">' +
            '<i class="fas fa-trash"></i>' +
            '</span>' +
            '<span class="text">Delete</span>' +
            '</a>' +
            '</div>' +
            '</li>';
        $("#nestable > .dd-list").append(item);
        $("#nestable").find('.dd-empty').remove();
        $("#name").val('');
        $("#url").val('');
        $("#type_menu").val('url');
        $("#url").prop('disabled', false);
        $("#url").prop('required', true);
        $("#name").prop('disabled', false);
        $("#name").prop('required', true);
        $("#image").prop('disabled', false);
        updateOutput();
    });
    $("body").delegate(".item-delete", "click", function (e) {
        $(this).closest(".dd-item").remove();
        updateOutput();
    });
    $("body").delegate(".item-edit, .item-close", "click", function (e) {
        var item_setting = $(this).closest(".dd-item").find(".item-settings");
        if (item_setting.hasClass("d-none")) {
            item_setting.removeClass("d-none");
        } else {
            item_setting.addClass("d-none");
        }
    });
    $("body").delegate("input[name='navigation_label']", "change paste keyup", function (e) {
        $(this).closest(".dd-item").data("label", $(this).val());
        $(this).closest(".dd-item").find(".dd3-content span").text($(this).val());
    });
    $("body").delegate("input[name='navigation_url']", "change paste keyup", function (e) {
        $(this).closest(".dd-item").data("url", $(this).val());
    });
    $("body").delegate("input[name='answers_images[]']", "change", function (e) {
        console.log($(this).val())
        console.log(e)
        $(this).closest(".dd-item").data("base64", "true");

        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(this).closest(".dd-item").data("base64", "true");
                // $(this).closest(".dd-item").data("imagebase64", e.target.result);
            }
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });
    $("body").delegate("input[class='select_file']", "change", function (e) {
        e.preventDefault()
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                //load file into actual preview img
                alert(e.target.result);
                $(this).closest(".dd-item").data("imagebase64", e.target.result);
                //alert(e.target.result)
            }
            reader.readAsDataURL(this.files[0]); // convert to base64 string
        }
    });

    /* $("body").delegate("input[name='answers_images[]']", "change", function (e) {
        $(this).closest(".dd-item").data("imagebase64", $(this).val()); 
        alert("change")
    }); */


    //Form Listner Change
    $("#type_menu").change(function () {
        $("#url").prop('disabled', $(this).val() != 'url');
        $("#url").prop('required', $(this).val() == 'url');
        $("#name").prop('disabled', ($(this).val() != 'url' && $(this).val() != 'title_block'));
        $("#name").prop('required', ($(this).val() != 'url' && $(this).val() != 'title_block'));
        $("#image").prop('disabled', $(this).val() != 'url');
    });


    //Load preview image on each answer
    $(document).on('click', '.add_image', function (e) {
        e.preventDefault()
        //add file to input / trigger click
        $(this).next('input').click();
    })


    //Watch the change on select file
    $(document).on('change', '.select_file', function (e) {
        e.preventDefault()
        //get the sibling img src of the change file
        var prevInput = $(this).prev('input')
        var prevInputBase64 = $(this).next('input')
        //Call read file preview
        previewFile(this, prevInput, prevInputBase64);
    });


    //Preview img
    function previewFile(input, previewSrc, prevInputBase64) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                //load file into actual      img
                $(previewSrc).attr('src', e.target.result);
                $(prevInputBase64).val(e.target.result)
                //alert(e.target.result)
                alert(e.target.result);
            }
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

});