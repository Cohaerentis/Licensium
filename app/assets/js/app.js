(function($){
    $(document).ready(function($) {
        $(".chosen-select").chosen({
            allow_single_deselect: true
        });

        /* AEA - Disabled because now is a GET request
        $(".switcher").click(function(){
            // Disable the events for the parents of the "eye" (li)
            $(this).parent().toggleClass("off-element");
            // Enable the events on the eye
            $(this).addClass("on-element");
            // Hides or shows the class depending on its previous state
            $(this).toggleClass("switcher-on");
            // Hides or shows the class depending on its previous state
            $(this).toggleClass("switcher-off");
        });
        */
            $(".set-right").tooltip({
                placement: 'right'
            });
            $(".move-arrow").tooltip({
                placement: 'left'
            });
            $(".how-to-info").tooltip({
                placement: 'top'
            });

            $(".crud-item").click(function(){
                var name      = $(this).attr('data-name'),
                    status    = $(this).attr('data-status');
/*
                var com   = 'compatible';
                var incom = 'incompatible';
                var unk   = 'unknown';
*/
//                $('.project-selected').html(name);
                $('.project-selected').html(
                    '<i class="glyphicon glyphicon-tasks project-selected ' + status + '"></i>' + name);
/*
                if(status == incom) {
                    $('.project-selected').prepend(
                        '<i class="glyphicon glyphicon-tasks icom-project-selected"></i>');
                }
                if(status == com) {
                    $('.project-selected').prepend(
                        '<i class="glyphicon glyphicon-tasks com-project-selected"></i>');
                }
                if(status == unk) {
                    $('.project-selected').prepend(
                        '<i class="glyphicon glyphicon-tasks unk-project-selected"></i>');
                }
*/
            });
    });
})( jQuery );
