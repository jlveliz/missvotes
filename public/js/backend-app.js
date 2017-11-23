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
        var lastCasting = $("#castings-selected > tr.casting:last");
        var sequentialCasting = 0;
        if (!lastCasting.is(':visible')) {
            sequentialCasting++;
        } else {
            var numCasting = $("#castings-selected > tr.casting").length;
            sequentialCasting = numCasting + 1;
        }
        $("#number_casting").val('casting_' + sequentialCasting)
        $("#createEditCasting").modal('show');
    });

    $(".edit-casting").on('click', function(event) {
        var castingId = $(this).data('casting');
        var startDate = $(this).parents('tr').find('.start_date').text().trim();
        var endDate = $(this).parents('tr').find('.end_date').text().trim();
        var lang = $(this).parents('tr').find('.lang').text();
        var countries = $.parseJSON($(this).parents('tr').find('.casting_countries').val());

        var noCountrySelected = $("#dont-selected").is(':visible');
        if (noCountrySelected) {
            $("#dont-selected").css('display', 'none');
        }
        for (var i = 0; i < countries.length; i++) {
            var htmlInsert = "<tr class='inserted'>";
            htmlInsert += "<td>";
            htmlInsert += "<input type='hidden' name='countries[]' value='" + countries[i].id + "' />";
            htmlInsert += "<span class='country-selected-text'>" + countries[i].name + "</span>";
            htmlInsert += "<td><button type='button' class='btn btn-danger btn-xs remove-country'><i class='fa fa-trash'></i></button></td>"
            htmlInsert += "</td>";
            htmlInsert += "</tr>";
            $("#selected_countries").append(htmlInsert);
        }
        $("#start_date").val(startDate)
        $("#end_date").val(endDate)
        $("#language").val(lang)
        $("#number_casting").val('casting_' + castingId)
        $("#createEditCasting").modal('show');
    });


    $("#createEditCasting").on('hide.bs.modal', function(event) {
        $("#start_date").val('')
        $("#end_date").val('')
        $("#language").val('')
        $("#number_casting").val('');
        $("#selected_countries >tr.inserted").remove();
        $("#dont-selected").css('display', 'table-row');
    });

    $("#createEditCasting").on('shown.bs.modal', function(event) {
        if ($('.inserted').length) {
            $("#dont-selected").css('display', 'none');
        }
    })



    $("#btn_insertar_pais").on('click', function(event) {
        //Insert country on the table
        var noCountrySelected = $("#dont-selected").is(':visible');
        if (noCountrySelected) {
            $("#dont-selected").css('display', 'none');
        }
        var countrySelected = $("#available_countries option:selected").val();
        var countryTextSelected = $("#available_countries option:selected").text();
        var htmlInsert = "<tr class='iserted'>";
        htmlInsert += "<td>";
        htmlInsert += "<input type='hidden' name='countries[]' value='" + countrySelected + "' />";
        htmlInsert += "<span class='country-selected-text'>" + countryTextSelected + "</span>";
        htmlInsert += "<td><button type='button' class='btn btn-danger btn-xs remove-country'><i class='fa fa-trash'></i></button></td>"
        htmlInsert += "</td>";
        htmlInsert += "</tr>";
        $("#selected_countries").append(htmlInsert);
        //remove element from select
        $("#available_countries option:selected").remove();
    });

    $("#selected_countries").on('click', '.remove-country', function(event) {
        $(this).parents('tr').remove();
        var countrySelected = $(this).parents('tr').find('input[type=hidden]').val()
        var countryTextSelected = $(this).parents('tr').find('.country-selected-text').text();
        var htmlInsert = "<option value='" + countrySelected + "'>";
        htmlInsert += countryTextSelected
        htmlInsert += "</option>";
        $(htmlInsert).appendTo('#available_countries');

        if (!$('.inserted').length) {
            $("#dont-selected").css('display', 'table-row');
        }

    });


    $(".dates-casting").datetimepicker({
        defaultDate: moment(),
        format: 'DD-M-YYYY'
    });




});
/**********************/

/**********CONFIG-MAIL***********/
$(document).ready(function() {
    CKEDITOR.replace( 'email-body' );
});
/**********************/

