// Import the Axios library, which provides a simple way to make HTTP requests in JavaScript.
import axios from 'axios';

// Set the default headers for all Axios requests to include 'X-Requested-With' with a value of 'XMLHttpRequest'.
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// If the user has requested that Axios be added to the global window object (for use in the browser), do so here.
// The 'any' type is used to bypass TypeScript's strict type checking.
(window as any).axios = axios;
