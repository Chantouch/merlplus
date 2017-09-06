Dropzone.options.imageUpload = {
    maxFilesize: 100,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    parallelUploads: 100, //all images should upload same time
    addRemoveLinks: true, // add a remove link underneath each image to
    autoProcessQueue: false, // Prevents Dropzone from uploading dropped files immediately
    removedfile: function (file) {
        let name = file.name;
        if (name) {
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                }, //passes the current token of the page to image url
                type: 'DELETE',
                url: "/api/v1/media-library/drop/" + name,  //passes the image name to  the method handling this url to //remove file
                dataType: 'json'
            });
        }
        let _ref;
        return (_ref = file.previewElement) !== null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    },
    init: function () {
        let submitButton = document.querySelector("#insert-media");
        imageUpload = this; // closure
        submitButton.addEventListener("click", function () {
            imageUpload.processQueue(); // Tell Dropzone to process all queued files.
        });
        // You might want to show the submit button only when
        // files are dropped here:
        this.on("addedfile", function (file) {
            //Check file name, size, and lastModified exist will remove from uploading
            if (this.files.length) {
                let _i, _len;
                for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) {
                    if (this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()) {
                        this.removeFile(file);
                    }
                }
                // Show submit button here and/or inform user to click it.
                $("#close").prop("disabled", true);
                $("#insert-media").prop("disabled", false);
            }
        });
        this.on("complete", function () {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                $.toast({
                    heading: 'Welcome to my Elite admin',
                    text: 'All files were uploaded to server!',
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'success',
                    hideAfter: 3000,
                    stack: 6
                });
                $("#close").prop("disabled", false);
                $("#insert-media").prop("disabled", true);
            }
        });
    }
};
