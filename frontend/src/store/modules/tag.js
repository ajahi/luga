import axios from 'axios';

export default {
    state: {
        tags: [],
        tag: {},
    },
    mutations:{
        setTag(state,payload){
            state.tag = payload

        },
        setTags(state,tags){
            state.tags = tags;
        },
        setTagId(state,payload){
            state.tag.id = payload
        },

    },
    actions: {
        fetchTag({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.get('/tag/'+payload)
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setTag',response.data)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        fetchTags({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.get('/tag',{params:payload})
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setTags',response.data.data)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        saveTag({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {

                commit('setLoading',true);
                const app = this;
                if(payload.id){
                    axios.put('/tag/'+payload.id,payload)
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
                    axios.post('/tag',payload)
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

        deleteTag({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.delete('/tag/'+payload)
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
        setTag({commit,state},payload){
            commit('setTag',payload);
        },
        clearTag({commit}){
            commit('setTag',{})
        },

    },
    getters: {
        getTag:state => {
            return state.tag;
        },
        getTags:state => {
            return state.tags;
        }
    }
}
