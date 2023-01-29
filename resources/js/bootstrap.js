import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

// Font Awesome
import '@fortawesome/fontawesome-free/js/fontawesome';
import '@fortawesome/fontawesome-free/js/regular';
import '@fortawesome/fontawesome-free/js/solid';

// AlpineJS
import Alpine from 'alpinejs';
import initAlpine from './dashboard/init-alpine';

// Dashboard employee
import modalEmployee from './dashboard/modal-employee';
import deleteEmployee from './dashboard/delete-employee';
import modalIngredient from './dashboard/modal-ingredient';
import modalMeasurement from './dashboard/modal-measurement';
import deleteMeasurement from './dashboard/delete-measurement';
import deleteIngredient from './dashboard/delete-ingredient';
import modalRestock from './dashboard/modal-restock';
import numberControl from './dashboard/number-control';
import modalMenu from './dashboard/modal-menu';
import modalBahanMenu from './dashboard/modal-bahan-menu';
import deleteBahanMenu from './dashboard/delete-bahan-menu';
import updateMenu from './dashboard/update-menu';
import deleteMenu from './dashboard/delete-menu';
import kasir from './dashboard/kasir';

// Start alpine
window.Alpine = Alpine;

// Current page first path
let urlPaths = location.pathname.replace(/\/+$/, '').split('/');

Alpine.data('data', initAlpine);

if (urlPaths[urlPaths.length - 1] == 'employee') {
    Alpine.store('modalEmployee', modalEmployee());
    Alpine.store('deleteEmployee', deleteEmployee);
}

if (urlPaths[urlPaths.length - 1] == 'ingredient') {
    Alpine.store('modalIngredient', modalIngredient());
    Alpine.store('deleteIngredient', deleteIngredient);
    Alpine.store('modalMeasurement', modalMeasurement());
    Alpine.store('deleteMeasurement', deleteMeasurement);
}

if (urlPaths[urlPaths.length - 1] == 'restock') {
    Alpine.store('modalRestock', modalRestock());
    Alpine.store('stockControl', numberControl('added'));
}

if (urlPaths[urlPaths.length - 1] == 'menu') {
    Alpine.store('modalMenu', modalMenu());
    Alpine.store('deleteMenu', deleteMenu);
}

if (urlPaths[urlPaths.length - 2] == 'menu') {
    Alpine.store('modalBahanMenu', modalBahanMenu());
    Alpine.store('deleteBahanMenu', deleteBahanMenu);
    Alpine.store('updateMenu', updateMenu());
}

if (urlPaths[urlPaths.length - 1] == 'kasir') {
    Alpine.store('kasir', kasir());
}
// Alpine.data('modalEmployee', modal);

Alpine.start();

// console.log('lmao');
