(function($){
    $(document).ready(function($) {
        $(".chosen-select").chosen({
            allow_single_deselect: true
        });

        $(".switcher").click(function(){
            $(this).parent().toggleClass("off-element");
            $(this).addClass("on-element");
            $(this).toggleClass("switcher-off");
        });

    });

})( jQuery );
