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



/**********CONFIG-CASTING***********/
$(document).ready(function() {
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');
    
    //hashing url 
    $('a[data-toggle="tab"]').on('click', function() {
        if ($(this).parent('li').hasClass('disabled')) {
            return false;
        }
        var scrollmem = $('body').scrollTop() || $('html').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });


    $("#create-casting").on('click', function(event) {
        console.log("entra");
        $("#createEditCasting").modal('show');
    });
});
/**********************/