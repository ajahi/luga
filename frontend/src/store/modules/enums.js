import axios from 'axios';

export default {
    state: {
        enums: {
            genders: [
                {text: 'Male', value:"Male"},
                {text: 'Female', value:"Female"},
                {text:'Doesnot Specify',value:"DoesnotSpecify"}
                ],
            bloodGroups: [
                {text:'A(+ve)',value:"APOSITIVE"},
                {text:'A(-ve)',value:"ANEGATIVE"},
                {text:'B(+ve)',value:"BPOSITIVE"},
                {text:'B(-ve)',value:"BNEGATIVE"},
                {text:'O(+ve)',value:"OPOSITIVE"},
                {text:'O(-ve)',value:"ONEGATIVE"},
                {text:'AB(+ve)',value:"ABPOSITIVE"},
                {text:'AB(-ve)',value:"ABNEGATIVE"},
            ]
        }
    },
    mutations:{




    },
    actions: {},
    getters: {
        getEnums:state => {
            return state.enums;
        }

    }
}
