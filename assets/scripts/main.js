/* eslint-disable @wordpress/no-global-event-listener */
import { listen } from '../../node_modules/quicklink/dist/quicklink';

window.addEventListener( 'load', () => {
	listen();
} );
