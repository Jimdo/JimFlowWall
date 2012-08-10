window.setTimeout('location.reload()', 5 * 60 * 1000);

(function($) {
    $(document).ready(function () {
        $('#boardselect').find('select').change(function() {
            window.location.href = $(this).find('option:selected').attr('data-href');
        })
    })
})(jQuery);