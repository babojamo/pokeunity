window.Vue = require('vue');
window.axios = require('axios');

Vue.component('community', require('./components/community/list').default);

new Vue({
    el: '#community',
});
