import axios from 'axios';
import router from './router';
import { app } from './main'



function errorResponseHandler(error) {
    /*if(error.response.status === 403) {
        router.push({name:'AccessDenied'});
    }*/
    if(error.response.status === 404) {
        router.push({name:'NotFound'});
    }
    if(error.response.status === 422 || error.response.status === 400){
        for(let key in error.response.data){
            // we are fetching only first error
            app.$validator.errors.add({field: key, msg: error.response.data[key][0]})
        }

    }
    return Promise.reject(error);


}



export default errorResponseHandler;
