jQuery(document).ready(function($) {
    $(document).on( 'click', '.cactus-welcome-notice .notice-dismiss', function() {

    $.ajax({
        url: cactus_admin.ajaxurl,
        data: {
            action: 'cactus_dismiss_notice'
        }
    })

})
});