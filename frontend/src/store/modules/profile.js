import axios from 'axios'

export default {
    state: {
        profile: {
            id: '',
            email: '',
            name: '',
            roles: '',
            avatar:'',
            status:'',
            verified: ''

        }
    },
    mutations: {
        setProfile(state, payload) {
            state.profile.id = payload.id;
            state.profile.email = payload.email;
            state.profile.name = payload.name;
            state.roles = payload.role;
            state.avatar = payload.avatar;
            state.profile.status = payload.status;
            state.profile.verified = payload.verified;

        }

    },
    actions: {

        getMe({commit, state, rootState}) {
            commit('setLoading', true);
            axios.get('/auth/user')
                .then(response => {
                    const data = response.data.data;
                    commit('setProfile', {
                        'id': data.id,
                        'email': data.email,
                        'name': data.name,
                        'roles': data.roles[0],
                        'avatar':data.avatar,
                        'status':data.status,
                        'verified':data.verified

                    });

                    commit('setLoading',false)

                })
                .catch(error => {
                    console.log(error);
                    commit('setLoading',false);
                    commit('setAlert',{msg:error.response.data.message,type:'error'})
                })

        },
        saveMe({commit,state,rootState},payload){
            commit('setLoading',true);
            axios.post('/users/'+state.profile.id, state.profile)
                .then(response => {
                    commit('setLoading',false);
                    commit('setAlert',{msg:response.data.message,type:'success'})
                })
                .catch(error=> {
                commit('setLoading',false);
                commit('setAlert',{msg:error.response.data.errors,type:'error'})
            })
        },


    },
    getters: {
        getProfile:state =>{
            return state.profile
        }
    }
}
