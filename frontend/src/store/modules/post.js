import axios from 'axios';

export default {
    state: {
        posts: [],
        post: {},
    },
    mutations:{
        setPost(state,payload){
            state.post = payload

        },
        setPosts(state,posts){
            state.posts = posts;
        },
        setPostId(state,payload){
            state.post.id = payload
        },

    },
    actions: {
        fetchPost({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.get('/post/'+payload)
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setPost',response.data)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        fetchPosts({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.get('/post',{params:payload})
                    .then(response =>{
                        commit('setLoading',false)
                        commit('setPosts',response.data.data)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setLoading',false);
                        commit('setAlert',{msg:error.response.data.errors,type:'error'})
                        reject(error)
                    })

            }))

        },
        savePost({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {

                commit('setLoading',true);
                const app = this;
                if(payload.post.id){
                    axios.put('/post/'+payload.post.id,payload.data)
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
                    axios.post('/post',payload.post)
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

        deletePost({commit,state,rootState},payload){
            return new Promise(((resolve, reject) => {
                commit('setLoading',true);
                axios.delete('/post/'+payload)
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
        setPost({commit,state},payload){
            commit('setPost',payload);
        },
        clearPost({commit}){
            commit('setPost',{})
        },

    },
    getters: {
        getPost:state => {
            return state.post;
        },
        getPosts:state => {
            return state.posts;
        }
    }
}
