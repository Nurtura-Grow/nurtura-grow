import $ from 'jquery';

$('.chooseDate').on('click', function () {
    // Add bg-primary class
    $(this).addClass('bg-primary text-white font-semibold');

    $('.chooseDate').not(this).removeClass('bg-primary text-white font-semibold');

    // If this has ID: "lainnya", do dateLainnya()
    if ($(this).attr('id') == 'lainnya') {
        datelainnya();
    } else {
        // If dateLainnya doesn't have hidden
        if (!$('.dateLainnya').hasClass('hidden')) {
            // Add hidden class on .dateLainnya
            $('.dateLainnya').addClass('hidden');
        }
    }
})

function datelainnya() {
    // If dateLainnya doesn't have hidden
    if ($('.dateLainnya').hasClass('hidden')) {
        // Remove hidden class on .dateLainnya
        $('.dateLainnya').removeClass('hidden');
    } else {
        // Add hidden class on .dateLainnya
        $('.dateLainnya').addClass('hidden');
    }
}
