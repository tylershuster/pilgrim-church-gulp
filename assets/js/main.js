/*eslint-disable */
jQuery.fn.highlight = function(str, className) {
    var regex = new RegExp(str, "gi");
    return this.each(function() {
        jQuery(this).contents().filter(function() {
            return this.nodeType == 3 && regex.test(this.nodeValue);
        }).replaceWith(function() {
            return (this.nodeValue || "").replace(regex, function(match) {
                return "<span class=\"" + className + "\">" + match + "</span>";
            });
        });
    });
};

function findMenuChildren( target ) {

	var $target = jQuery(target),
			return_obj = [],
			children = $target.children('.menu-item');

	jQuery.each( children, function(i, el) {

		var grandchildren = jQuery(el).find('.menu-item'),
				el_obj = { el: el };

		if( 0 <= grandchildren.length ) {
			el_obj.children = findMenuChildren( jQuery(el).find('ul')[0] );
		}

		return_obj.push( el_obj );

	});

	return return_obj;
}

function createMenuItem( item, depth = 0 ) {

	var return_str = '',
			link = jQuery(item.el).children('a').attr('href'),
			text = jQuery(item.el).children('a').text(),
			i;

	for (i = 0; i < depth; i++) {

		text = '- ' + text;

	};

	return_str += '<option value="' + link + '">' + text + '</option>';

	if( item.children ) {

		jQuery.each(item.children, function(i, el){

			return_str += createMenuItem( el, depth + 1 );

		});
	}

	return return_str;

}

jQuery(document).ready(function($) {

	var mainMenuItems = findMenuChildren('#menu-main-navigation'),
			options = '<option>- select page -</option>',
			$footerMap = $('.site__map'),
			dayMap = "<iframe class='site__map' width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/tylershuster.ngi1n5il/zoompan.html?access_token=pk.eyJ1IjoidHlsZXJzaHVzdGVyIiwiYSI6IkVtQUNDR0kifQ.lmw4IoRwovnroo6vfHO9gQ'></iframe>",
			nightMap = "<iframe class='site__map' width='100%' height='500px' frameBorder='0' src='https://a.tiles.mapbox.com/v4/tylershuster.njmdgk54/zoompan.html?access_token=pk.eyJ1IjoidHlsZXJzaHVzdGVyIiwiYSI6IkVtQUNDR0kifQ.lmw4IoRwovnroo6vfHO9gQ'></iframe>";

	$.each(mainMenuItems, function(i, item) {

		options += createMenuItem( item );

	});

	$('.menu-main-navigation-container').append('<select id="menu-main-navigation--mobile">' + options + '</select>');

	$(document).on( 'change', '#menu-main-navigation--mobile', function(event) {

		window.location = event.target.value;

	});

	if( $('html').hasClass('nighttime') && false ) {
		$footerMap.replaceWith(nightMap);
	} else {
		$footerMap.replaceWith(dayMap);
	}

	$('.menu-item a').highlight('\&','ampersand');

	$('h1,h2,h3,h4,h5,h6').highlight('“','start-quote');

	// $('p:first-of-type').html(function (i, html) {
 //    return html.replace(/^[^a-zA-Z'"<]*([a-zA-Z])/g, '<span class="big-cap">$1</span>');
	// });

 //  var dropcaps = document.querySelectorAll(".big-cap");
 //  window.Dropcap.layout(dropcaps, 2);


});
