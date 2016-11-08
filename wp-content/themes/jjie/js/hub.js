(function() {
    jQuery('.tabby').find('.content').each( function () {
        var $parentTabby = jQuery(this).parent('.tabby');
        jQuery(this).slideUp( function () {
            $parentTabby.toggleClass('open');
            $parentTabby.attr('style',' ');
        });
    });

    jQuery(document).ready( function () {
        jQuery('.tabby p').each( function () {
            if(jQuery(this).is(':empty')) {
                jQuery(this).remove();
            }
        });

        if(window.location.hash){
            var $hash = window.location.hash.replace( /^#/, '' );
            // Try this with id first, otherwise try it with the name attribute.
            if ( jQuery('#' + $hash).length ) {
                console.log("There's something with that id");
                jQuery('#' + $hash + ' > .tabby').toggleClass('open');
                jQuery('#' + $hash + ' > .tabby > .content').slideDown();
            } else if ( jQuery('[name=' + $hash + ']' ).length ) {
                /**
                 * Find the nameed element by hash, find its sibling .tabby, open the tabby
                 *
                 * They said that the name tag is always outside the .tabby, so this works on that assumption.
                 * @see YT-36, YT-50
                 */
                var $selector = jQuery('[name=' + $hash + ']');
                // In the likely occasion that the hash-referenced element is in a paragraph tag, use that paragraph tag to find the tabby to open instead.
                if ( $selector.parent().is("p") ) {
                    $selector = $selector.parent();
                }
                $selector.next('.tabby').toggleClass('open');
                $selector.next('.tabby').find('> .content').slideDown();
                // But if the $selector is the child of a .tabby, that won't do anything. So we do this.
                $selector.parent('.content').parent('.tabby').toggleClass('open');
                $selector.parent('.content').slideDown();
                // If $selector was initially inside a <p>, $selector is that <p> at this point, so we don't need to .parent() out of the <p>
                // parent 1: .content
                // parent 2: .tabby
            }
        }

        jQuery('.entry-content').on('click', '.tabby h5', function () {
            var $parentTabby = jQuery(this).parent('.tabby');
            if(!$parentTabby.hasClass('open')) {
                $parentTabby.find('.content').slideDown( function () {
                    $parentTabby.toggleClass('open');
                    $parentTabby.attr('style',' ');
                });
            } else {
                $parentTabby.find('.content').slideUp( function () {
                    $parentTabby.toggleClass('open');
                    $parentTabby.attr('style',' ');
                });
            }
        });
    });
})();
