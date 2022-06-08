import axios from 'axios';

export default {
    state: {
        snackbar: {
            show:false,
            text: '',
            color: ''
        },
        pageSize : [10,25,50,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}],
        app: {
            title: 'DreamSYS CMS',
            description: 'DreamSYS CMS is a user friendly Content Management System from Dreamsys.'
        }
    },
    mutations:{
        setSnackbar(state,payload){
            state.snackbar.show = payload.show;
            state.snackbar.text = payload.text;
            state.snackbar.color = payload.color;

        },
        setPageSize(state,payload){
            state.pageSize  = payload
        }



    },
    actions: {
            setSnackbar({commit,state},payload){
                commit('setSnackbar',payload)
            },
            showSuccessSnackbar({commit,state},payload){
                commit('setSnackbar',{ show: 'true', text: payload, color:'green'})

            },
            showErrorSnackbar({commit,state},payload){
                commit('setSnackbar',{ show: 'true', text: payload, color:'red'})


            },
        setPageSize({commit},payload){
                commit('setPageSize',payload)
        }
            },
    getters: {
        getSnackbar:state => {
            return state.snackbar;
        },
        getPageSize:state => {
            return state.pageSize;
        }

    }
}
