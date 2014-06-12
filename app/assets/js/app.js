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

    });

})( jQuery );
