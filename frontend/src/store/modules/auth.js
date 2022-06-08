import axios from 'axios'
import router from '@/router'


export default {
    state: {
        isLoggedIn: !!localStorage.getItem("token"),
        token: localStorage.getItem("token") || ''
    },
    mutations: {

        loginSuccess(state,payload){
            state.isLoggedIn = true;
            state.token = payload;
            localStorage.setItem('token',payload);
            // Add the following line:
            axios.defaults.headers.common['Authorization'] = 'Bearer ' +  payload

        },
        logout(state){
            state.isLoggedIn = false;
            state.token = null;
            localStorage.removeItem("token");
            // remove the axios default header
            delete axios.defaults.headers.common['Authorization']

        }

    },
    actions: {
        userSignUp({commit,state,rootState}, payload) {
            commit('setLoading', true);
            axios.post('/auth/register', {
                'username': payload.username,
                'email': payload.email,
                'password': payload.password,
                'rePassword': payload.password,
                'firstName': payload.firstName,
                'lastName': payload.lastName
            })
                .then(response => {
                    commit('setLoading', false)
                    router.push('/home')
                })
                .catch(error => {
                    commit('setAlert', {msg:error.response.data.message,type:'error'})
                    commit('setLoading', false)
                })
        },
        userSignIn({commit,state,rootState},payload){
            commit('setLoading', true)
            axios.post('/login', {
                'email': payload.email,
                'password': payload.password
            })
                .then(response => {
                    let token = response.data.access_token;
                    commit('loginSuccess',token);
                    commit('setLoading',false);
                    commit('setError',null);
                    router.push({name:'dashboard'})
                })
                .catch(error => {
                    commit('setAlert',{msg:error.response.data.message,type:'error'});
                    commit('setLoading',false);
                })

        },
        autoLogin({commit},payload){
            commit('loginSuccess',payload.token)
            router.push('/dashboard')
        },
        logout({commit}){
            commit('logout')
            router.push('/signin')
        },

        confirmEmailConfirmation({commit,state,rootState},payload){
            commit('setLoading', true);
            axios.get('/auth/confirm?token='+payload.token)
                .then(response => {
                    commit('setLoading',false);
                    commit('setAlert',{msg:response.data.message,type:'success'})
                })
                .catch(error => {
                    commit('setLoading',false);
                    commit('setAlert',{msg:error.response.data.message,type:'error'})
                })
        }


    },
    getters: {
        isLoggedIn: state => {
            return state.isLoggedIn
        },
        getToken:state=> {
            return state.token;
        }
    }
}
