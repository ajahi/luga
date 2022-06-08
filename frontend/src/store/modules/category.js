import axios from 'axios';

export default {
    state: {
        categories: [],
        category: {},
    },
    mutations:{
        setCategory(state,payload){
            state.category = payload

        },
        setCategories(state,categories){
            state.categories = categories;
        },
        setCategoryId(state,payload){
            state.category.id = payload
        },

    },
    actions: {
        fetchCategory({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.get('/category/'+payload)
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setCategory',response.data)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        fetchCategories({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.get('/category',{params:payload})
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setCategories',response.data.data)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        saveCategory({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {

                commit('setLoading',true);
                const app = this;
                if(payload.id){
                    axios.put('/category/'+payload.id,payload)
                        .then(response => {
                            commit('setLoading',false);
                            resolve(response);
                        })
                        .catch(error => {
                            commit('setLoading',false);
                            reject(error);
                        });
                }
                else{
                    axios.post('/category',payload)
                        .then(response => {
                            commit('setLoading',false);
                            resolve(response);
                        })
                        .catch(error => {
                            commit('setLoading',false);
                            reject(error);
                        });
                }

            }))


        },

        deleteCategory({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.delete('/category/'+payload)
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setAlert',{msg:response.data.message,type:'success'});
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        setCategory({commit,state},payload){
            commit('setCategory',payload);
        },
        clearCategory({commit}){
            commit('setCategory',{})
        },

    },
    getters: {
        getCategory:state => {
            return state.category;
        },
        getCategories:state => {
            return state.categories;
        }
    }
}
