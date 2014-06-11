(function($){
    $(document).ready(function($) {
        $(".chosen-select").chosen({
            allow_single_deselect: true
        });

        $(".switcher").click(function(){
            $(this).parent().toggleClass("off-element"); /* Disable the events for the parents of the "eye" (li) */
            $(this).addClass("on-element"); /* Enable the events on the eye */
            $(this).toggleClass("switcher-on"); /* Hides or shows the class depending on its previous state */
            $(this).toggleClass("switcher-off"); /* Hides or shows the class depending on its previous state */
        });

    });

})( jQuery );
