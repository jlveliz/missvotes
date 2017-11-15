$(document).ready(function() {
    /******** PROFILE ********/
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.flag-img').css('background-image', 'url(' + e.target.result + ')');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#flag-section").on('click', function(event) {
        event.preventDefault();
        $("#file-flag-upload").click();
    });

    $("#file-flag-upload").on('change', function(event) {
        readURL(this);
    });
    /******** PROFILE ********/
})