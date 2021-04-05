require('./bootstrap');

import router from './routes/web';
import store from './store';
import App from './views/App';

const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App)
});

// Add a response interceptor
window.axios.interceptors.response.use(function (response) {
    // Any status code that lie within the range of 2xx cause this function to trigger
    // Do something with response data
    return response;
}, function (error) {
    // Any status codes that falls outside the range of 2xx cause this function to trigger
    // Do something with response error
    if(error.response.status === 404) {
        router.push('/404');
    }

    if(error.response.status === 401 || error.response.status === 419) {
        // redirect to login page
        // window.location.href = "/login";
        store.commit('logUserOut');
        router.push('/login');
    }
    return Promise.reject(error);
});

export default app;