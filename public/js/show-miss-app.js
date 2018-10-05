// var wallopEl = document.querySelector('.Wallop');
// var wallop = new Wallop(wallopEl);

// var paginationDots = Array.prototype.slice.call(document.querySelectorAll('.Wallop-dot'));

// /*
// Attach click listener on the dots
// */
// paginationDots.forEach(function(dotEl, index) {
//     dotEl.addEventListener('click', function() {
//         wallop.goTo(index);
//     });
// });

// /*
// Listen to wallop change and update classes
// */
// wallop.on('change', function(event) {
//     removeClass(document.querySelector('.Wallop-dot--current'), 'Wallop-dot--current');
//     addClass(paginationDots[event.detail.currentItemIndex], 'Wallop-dot--current');
// });



// // Helpers
// function addClass(element, className) {
//     if (!element) {
//         return;
//     }
//     element.className = element.className.replace(/\s+$/gi, '') + ' ' + className;
// }

// function removeClass(element, className) {
//     if (!element) {
//         return;
//     }
//     element.className = element.className.replace(className, '');
// }


$(document).ready(function() {

    // $("#select-misses").selectize();


    $("#select-misses").on('change', function(event) {
        event.preventDefault();
        $("#select-misses option:selected").each(function() {
            valElement = $(this).val();
            if (!valElement) $("#go-miss").attr('href', '#');
            $("#go-miss").attr('href', valElement);
        });
    });

    // $("#select-tickets").selectize();
    $("#select-tickets").on('change', function(event) {
        event.preventDefault();
        $("#select-tickets option:selected").each(function() {
            valElement = $(this).val();
            if (!valElement) {
                $("#ticket-id").val('');
                $("#vote-ticket-submit").attr('disabled', true);
            } else {
                $("#ticket-id").val(valElement);
                $("#vote-ticket-submit").removeAttr('disabled');
            }
        });
        /* Act on the event */
    });


    /* caoursel*/

    // $(".carrousel-misses").slick({
    //     dots: true,
    //     infinite: true,
    //     slidesToShow: 4,
    //     slidesToScroll: 4,
    // })


    $("#btn-vote-default").on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        _this = $(this);
        _this.attr('disabled', true);
        _this.children('i').removeClass('fa-heart').addClass('fa-spinner fa-spin');
        _this.children('span').css('display', 'none');
        var form = _this.parents('form');
        form = $(form);

        $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
            })
            .done(function() {
                _this.parents('form').remove();
                $("#thanks-vote-js").removeAttr('style');
            })
            .fail(function() {
                _this.removeAttr('disabled', true);
            })
            .always(function() {
                _this.children('i').removeClass('fa-spinner fa-spin').addClass('fa-heart');
                _this.children('span').css('display', 'inline');
            });

    });


    $("#vote-ticket-submit").on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        /* Act on the event */
        _this = $(this);
        _this.attr('disabled', true);
        _this.children('i').removeClass('fa-heart').addClass('fa-spinner fa-spin');
        _this.children('span').css('display', 'none');
        var form = _this.parents('form');
        form = $(form);

        $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
            })
            .done(function() {
                var valRaffle = $("#select-tickets option:selected").data('raffle')
                $("#select-tickets option:selected").remove();
                $("#thanks-vote-ticket-js").removeAttr('style');
                $("#vote-id").text('#' + valRaffle);
                if ($("#select-tickets option").length == 1) {
                    _this.attr('disabled', true);
                }
            })
            .fail(function() {
                _this.removeAttr('disabled', true);
            })
            .always(function() {
                _this.children('i').removeClass('fa-spinner fa-spin').addClass('fa-heart');
                _this.children('span').css('display', 'inline');
            });
    });

});
