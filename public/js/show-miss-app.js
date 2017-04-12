var wallopEl = document.querySelector('.Wallop');
var wallop = new Wallop(wallopEl);

var paginationDots = Array.prototype.slice.call(document.querySelectorAll('.Wallop-dot'));

/*
Attach click listener on the dots
*/
paginationDots.forEach(function(dotEl, index) {
    dotEl.addEventListener('click', function() {
        wallop.goTo(index);
    });
});

/*
Listen to wallop change and update classes
*/
wallop.on('change', function(event) {
    removeClass(document.querySelector('.Wallop-dot--current'), 'Wallop-dot--current');
    addClass(paginationDots[event.detail.currentItemIndex], 'Wallop-dot--current');
});



// Helpers
function addClass(element, className) {
    if (!element) {
        return;
    }
    element.className = element.className.replace(/\s+$/gi, '') + ' ' + className;
}

function removeClass(element, className) {
    if (!element) {
        return;
    }
    element.className = element.className.replace(className, '');
}


$(document).ready(function() {

    $("#select-misses").selectize();


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
                $("#vote-ticket-submit").attr('disabled',true);
            } else {
                $("#ticket-id").val(valElement);
                $("#vote-ticket-submit").removeAttr('disabled');
            }
        });
        /* Act on the event */
    });


    /* caoursel*/

    $(".carrousel-misses").slick({
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
    })

});
