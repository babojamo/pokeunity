window.Vue = require('vue');
window.axios = require('axios');

Vue.component('pokemons', require('./components/pokemons/list').default);

new Vue({
    el: '#pokemons',
});
