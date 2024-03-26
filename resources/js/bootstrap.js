import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// If you still want to add axios to the global window object, you can do it like this:
(window as any).axios = axios;
