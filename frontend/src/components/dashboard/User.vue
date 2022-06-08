<template>
    <v-container  >
        <v-layout row wrap align-center>
            <v-flex xs12 md9>
                <router-view></router-view>
            </v-flex>

            <v-flex xs12 md3>
                <div class="text-xs-center">


                    <image-input  @input="onFileChanged" uploadFieldName="file">
                        <div slot="activator">
                            <v-avatar size="150px" v-ripple v-if="!getProfile.imageUrl" class="grey lighten-3 mb-3">
                                <span>Click to add avatar</span>
                            </v-avatar>
                            <v-avatar size="150px" v-ripple v-else class="mb-3">
                                <img :src="getProfile.imageUrl | downloadUrl " alt="avatar">
                            </v-avatar>
                        </div>
                    </image-input>


                    <div class="headline">{{getProfile.firstName}} <span style="font-weight:bold">{{getProfile.lastName}}</span></div>
                    <div class="subheading text-xs-center grey--text pt-1 pb-3">{{getProfile.email}}</div>
                </div>
            </v-flex>
        </v-layout>

    </v-container>

</template>


<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../shared/AlertBox';
    import ImageInput from '../shared/ImageInput'
    export default {
        name: 'Profile',
        props: {
            msg: String
        },
        components: {
           'alert-box': AlertBox,
            ImageInput
        },
        data() {
            return {
                alert: false,
                valid:true,


            }
        },
        created: function(){
            this.$store.commit('setLayout','app-layout')
        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'getProfile','loading'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            fbUrl(){
                return this.$store.getters.fbLoginUrl
            },
            googleUrl(){
                return this.$store.getters.googleLoginUrl;
            }
        },
        watch: {
            /*alertMsg(value) {
                if (value) {
                    this.alert = true;
                }
            },*/
           /* alert(value) {
                if (!value) {
                    this.$store.commit('setAlertMsg', null)
                }
            }*/

        },
        methods: {
            onFileChanged(data){
                this.axios.post('/users/'+this.getProfile.id+'/image',data.formData)
                    .then(response=> {
                        this.getProfile.imageUrl = response.data.fileName;
                        this.$store.dispatch('showSuccessSnackbar','Image uploaded Successfully')
                    })
            }
        },
        filters: {

        }
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h3 {
        margin: 40px 0 0;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
    .dz-preview{
        display: none;
    }
</style>
