/*eslint-disable */
/** Responsive Images Polyfill */
import 'picturefill';

/** Lazyload Images */
import '../../node_modules/lazysizes/plugins/bgset/ls.bgset.js';
import 'lazysizes';

/** Object-fit/Object-position Polyfill */
import objectFit from 'object-fit';

// import 'dropcap.js';

window.objectFit = objectFit;

let addEvent = () => window.addEventListener || window.attachEvent;
let event = ( window.addEventListener ? '' : 'on' ) + 'DOMContentLoaded';

addEvent()(event, () => {
	objectFit.polyfill({
		selector: '[data-object-fit="cover"]',
		fittype: 'cover',
		disableCrossDomain: true
	});

	objectFit.polyfill({
		selector: '[data-object-fit="contain"]',
		fittype: 'contain',
		disableCrossDomain: true
	});
});
