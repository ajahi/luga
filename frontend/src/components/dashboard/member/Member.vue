<template>
    <v-container  >
        <v-layout row wrap align-center>
            <v-flex xs12 md9>
                <router-view></router-view>
            </v-flex>
            <v-flex md3>
                <v-layout column>
                    <v-flex xs12 md3 v-if="getMember.id">
                        <div class="text-md-center text-sm-center">


                            <image-input  @input="onFileChanged" uploadFieldName="file">
                                <div slot="activator">
                                    <v-avatar size="150px" v-ripple v-if="!getMember.imageUrl" class="grey lighten-3 mb-3">
                                        <span>Click to add Logo</span>
                                    </v-avatar>
                                    <v-avatar size="150px" v-ripple v-else class="mb-3">
                                        <img :src="getMember.imageUrl | downloadUrl " alt="avatar">
                                    </v-avatar>
                                </div>
                            </image-input>

                            <div class="headline">{{getMember.firstName+ ' '+ getMember.lastName}} </div>
                            <div class="subheading">{{getMember.email}} </div>
                            <div class="headline" v-if="getClubDesignation.id"><v-chip>{{getClubDesignation.title}}</v-chip> </div>
                            <div class="headline" v-if="getMember.club"><v-chip>{{getMember.club.name}}</v-chip> </div>
                        </div>
                    </v-flex>
                    <v-flex md3 v-if="getMember.club">
                        <div class="text-md-center">
                            <v-btn :to="{name:'club-designation'}">Designation</v-btn>

                        </div>
                    </v-flex>
                </v-layout>

            </v-flex>


        </v-layout>

    </v-container>
</template>

<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../../shared/AlertBox';
    import ImageInput from '../../shared/ImageInput'

    export default {
        name: "Club",
        props: ['msg','id'],
        components: {
            'alert-box': AlertBox,
            ImageInput
        },
        data() {
            return {
                alert: false,
                valid: true,

            }
        },
        created: function(){
            this.fetchMember();


        },
        mounted(){

        },
        methods:{
            fetchMember(){
                if(this.id){
                    if(this.id ==='create'){
                        this.$store.dispatch('clearMember');

                    }
                    else {
                        this.$store.dispatch('fetchMember',this.id)
                            .then(response => {
                                this.$store.dispatch('fetchClubDesignation',this.getMember.id)
                                    .then(response => {
                                    })
                            })
                    }
                }
            },
            onFileChanged(data){
                this.axios.post('/users/'+this.getMember.id+'/image',data.formData)
                    .then(response=> {
                        this.$store.dispatch('setMemberImage',response.data.fileName);
                        this.$store.dispatch('showSuccessSnackbar','Image uploaded Successfully')
                    })
            }
        },
        computed: {
            ...mapGetters([
                'loading','getMember','getYears','getYear','getClubDesignation'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
        }
    }
</script>

<style scoped>

</style>
