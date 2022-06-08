<template>
    <v-flex>
        <v-alert :type="alertType" dismissible v-model="localAlert" >
            {{ alertMsg }}
        </v-alert>
    </v-flex>
</template>

<script>

    export default {
        data() {
            return {
                localAlert : false
            }
        },
        computed: {
            alertMsg() {
                return this.$store.state.alertMsg
            },
            alertType(){
                return this.$store.state.alertType
            },

        },
        watch: {
            alertMsg(value) {
                //if there is value, localalert will be true
                this.localAlert = !!value;
            },
            localAlert(value){
                if(!value){
                    this.$store.commit('setAlertMsg',null);
                }
            },


        },
        props: ['alert']
    }
</script>
