<template>
    <v-container  >
        <v-layout row wrap align-center>
            <v-flex xs12 md9>
                <v-card class="elevation-12">
                    <v-card-title>
                        <div>
                            <h3 class="headline">{{title}}</h3>

                        </div>
                    </v-card-title>
                    <!--<v-flex>
                        <v-alert :type="alertType" dismissible v-model="alert">
                            {{ alertMsg }}
                        </v-alert>
                    </v-flex>-->
                    <alert-box/>
                    <v-card-text>

                        <v-form ref="designation" v-model="valid">
                            <v-container grid-list-md text-md-center>
                                <v-layout row wrap>
                                    <input type="hidden" v-model="designation.id"/>
                                    <v-flex md12>
                                        <v-select
                                                prepend-icon="perm_identity"
                                                :items="designations"
                                                label="Designation *"
                                                v-model="designation.designationId"
                                                required>
                                        </v-select>
                                    </v-flex>
                                    <v-chip v-if="getMember.club">{{getMember.club.name}}</v-chip>
                                    <v-flex>
                                        <v-select
                                                prepend-icon="perm_identity"
                                                :items="years"
                                                label="Years *"
                                                v-model="designation.yearId"
                                                required>
                                        </v-select>
                                    </v-flex>


                                </v-layout>
                            </v-container>

                        </v-form>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="primary" :disabled="!valid || loading" @click="saveDesignation">Save
                            <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                        </v-btn>
                        <v-btn    @click="$router.go(-1)">Cancel

                        </v-btn>

                    </v-card-actions>

                </v-card>
            </v-flex>
            <v-flex md3>
                <v-layout column>
                    <v-flex xs12 md3 v-if="getMember.id">
                        <div class="text-md-center text-sm-center">
                                    <v-avatar size="150px" v-ripple  class="mb-3" v-if="getMember.imageUrl">
                                        <img :src="getMember.imageUrl | downloadUrl " alt="avatar">
                                    </v-avatar>

                            <div class="headline">{{getMember.firstName+ ' '+ getMember.lastName}} </div>
                            <div class="subheading">{{getMember.email}} </div>
                            <div class="headline" v-if="designation.id"><v-chip>{{designation.title}}</v-chip> </div>
                            <div class="headline" v-if="getMember.club"><router-link :to="{name:'club',params: {id:getMember.club.id}}"><v-chip >{{getMember.club.name}}</v-chip> </router-link></div>
                        </div>
                    </v-flex>
                    <v-flex md3 >
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
        name: "club-designation-crud",
        props: ['msg','id'],
        components: {
            'alert-box': AlertBox,
        },
        data() {
            return {
                alert: false,
                valid: true,
                designation:{}

            }
        },
        created: function(){
            this.$store.dispatch('fetchMember',this.id).then(response => {
                this.fetchClubDesignation()
                this.$store.dispatch('fetchYears',this.getMember.club.id)
                    .then(response => {
                    })
                this.$store.dispatch('fetchDesignations').then();
            })

        },
        mounted(){

        },
        methods:{
            fetchClubDesignation(){
                this.$store.dispatch('fetchClubDesignation',this.getMember.id)
                    .then(response => {
                        console.log(response.data);
                        if(response.data !== null){
                            this.designation = response.data;
                            this.designation.userId = response.data.user.id;
                            this.designation.clubId = response.data.club.id;
                            this.designation.yearId= response.data.year.id;
                            this.designation.designationId = response.data.designation.id;
                        }
                    })
            },
            saveDesignation(){
                if(this.$refs.designation.validate()){
                    this.designation.userId = this.getMember.id;
                    this.designation.clubId = this.getMember.club.id;
                    this.$store.dispatch('saveClubDesignation',this.designation).then(response => {
                        this.$store.dispatch('showSuccessSnackbar',response.data.message);

                    })
                        .catch(error => {
                            this.$store.dispatch('showErrorSnackbar',error.response.data.errors);
                        })

                }
            }
        },
        computed: {
            ...mapGetters([
                'loading','getYears','getMember','fetchDesignations','getDesignations'
            ]),
            title(){
                if(this.designation.id){
                    return "Edit "+ this.designation.designation.title;
                }
                else
                    return "Assign Designation"

            },
            loading(){
                return this.$store.getters.loading;
            },
            years(){
                return this.getYears.map(year => {
                    return {
                        text: year.title,
                        value:year.id
                    }
                })
            },
            designations(){
                return this.getDesignations.map(designation => {
                    return {
                        text: designation.title,
                        value: designation.id
                    }
                })
            }

        }
    }
</script>

<style scoped>

</style>
