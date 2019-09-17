import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        username: ""
    },

    getters: {
        username: state => {
            return state.username;
        }
    },

    mutations: {
        setUsername(state, payload) {
            state.username = payload;
        }
    },
});
