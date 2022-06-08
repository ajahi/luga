import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import profile from './modules/profile'
import app from './modules/app'
import category from './modules/category'
import post from './modules/post'
import tag from './modules/tag'
import getters from './getters'

Vue.use(Vuex)

export const store = new Vuex.Store({
    modules: {
        auth,
        profile,
        app,
        category,
        post,
        tag
    },
    state: {
        appTitle: 'Mis for Divine Youth Club Nepal',
        //user: null,
        alertMsg: null,
        alertType: 'success',
        loading: false,
        layout: 'app-layout',
        /*serverUrl: 'http://localhost:8080',*/
        serverUrl: process.env.VUE_APP_SERVER_URL,
    },
    mutations: {
       /* setUser(state, payload) {
            state.user = payload
        },*/
       setAlert(state,payload){
         state.alertMsg = payload.msg;
         state.alertType = payload.type;
       },
        setAlertMsg(state, payload) {
            state.alertMsg = payload
        },
        setAlertType(state,payload){
            state.alertType = payload
        },
        setLoading(state, payload) {
            state.loading = payload
        },
        setLayout(state, payload) {
            state.layout = payload
        },

    },
    actions: {


    },
    getters
})
