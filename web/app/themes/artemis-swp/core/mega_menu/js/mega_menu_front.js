jQuery(document).ready(function($) {
	artemisMegaMenu($);
	$(window).on("debouncedresize", function(event) {
		artemisMegaMenu($);
	});
});

function artemisMegaMenu($) {

    var images = {};
    $('ul.menu > li.menu-item-swp-megamenu-parent').each(function(){
        var left_pos = $('header#at_page_header').offset().left - $(this).parent().offset().left;
        var $mega_ul = $(this).find('> ul');
        $mega_ul.css("width", $('header#at_page_header').width());
        $mega_ul.css("left", left_pos);
        $mega_ul.css("padding-left", 0 - left_pos);
        $mega_ul.addClass("mega_menu_ul");

        var liElems = $mega_ul.find( 'li.swp-menu-item-with-image' );
        $.each(liElems, function(){
            var img_src = $(this).data( 'menuitemimg' );
            if ( img_src ) {
                var cachedImage = new Image();
                cachedImage.src = img_src;
                cachedImage.alt = $( this ).find( 'a' ).text();
                images[$( this ).attr( 'id' )] = cachedImage;
            }
        });

        var max_height = $mega_ul.height();
        $mega_ul.find(" > li").each(function() {
            var local_height = 0;
            local_height = $(this).height() + $(this).find(" > ul").height();
            if (local_height > max_height) {
                max_height = local_height;
            }

        });
        $mega_ul.css("height", max_height + 30);
        $mega_ul.css("padding-bottom", "30px");
        $mega_ul.append('<li class="swp_preview_item_img"></li>');


        var $preview_li_img = $mega_ul.find(".swp_preview_item_img img");
        if (!$preview_li_img) {
            return;
        }

        $mega_ul.find('li.swp-menu-item-with-image').hover(
              function() {
                  var id = $( this ).attr( 'id' );
                if (images[id] !== "undefined") {
                    $mega_ul.find( ".swp_preview_item_img" ).append( images[id]);
                }
              }, function() {
                    $mega_ul.find( ".swp_preview_item_img img" ).remove();
              }
        );

    });


}
