<template>
    <v-container>
        <v-card class="elevation-12">
            <v-card-title>
                <div>
                    <h3 class="headline">Edit Profile</h3>
                    <div>Profile</div>
                </div>
            </v-card-title>
            <!--<v-flex>
                <v-alert :type="alertType" dismissible v-model="alert">
                    {{ alertMsg }}
                </v-alert>
            </v-flex>-->
            <alert-box/>
            <v-card-text>

                <v-form ref="profile" v-model="valid">
                    <v-container grid-list-md text-md-center>
                        <v-layout row wrap>
                                <v-flex>
                                    <v-text-field
                                            prepend-icon="email"
                                            name="email"
                                            label="Email "
                                            id="email"
                                            type="email"
                                            v-model="getProfile.email"
                                            :rules="emailRules"
                                            required
                                            disabled></v-text-field>
                                </v-flex>
                                <!--<v-flex>
                                    <v-text-field
                                            prepend-icon="face"
                                            name="username"
                                            label="Profilename"
                                            id="username"
                                            type="text"
                                            v-model="getProfile.username"
                                            :rules="usernameRules"
                                            disabled
                                            required></v-text-field>
                                </v-flex>-->


                            <v-layout justify-space-between row>
                                <input type="hidden" v-model="getProfile.id"/>
                                <v-text-field
                                        prepend-icon="person"
                                        name="firstName"
                                        label="First Name *"
                                        id="firstName"
                                        type="text"
                                        v-model="getProfile.firstName"
                                ></v-text-field>
                                <v-spacer></v-spacer>
                                <v-text-field
                                        prepend-icon="person"
                                        name="lastName"
                                        label="Last Name *"
                                        id="lastName"
                                        type="text"
                                        v-model="getProfile.lastName"
                                ></v-text-field>
                            </v-layout>

                            <v-flex md6>
                                <v-select
                                        prepend-icon="perm_identity"
                                        :items="getEnums.genders"
                                        label="Gender *"
                                        v-model="getProfile.gender"
                                        required>
                                </v-select>
                            </v-flex>
                            <v-flex md6>
                                <v-select
                                        prepend-icon="perm_identity"
                                        :items="getEnums.bloodGroups"
                                        label="Blood Group *"
                                        v-model="getProfile.bloodGroup"
                                        required>
                                </v-select>
                            </v-flex>
                            <v-flex md6 xs6>
                                <v-text-field
                                        prepend-icon="phone"
                                        label="Contact"
                                        type="number"
                                        v-model="getProfile.mobileNumber"></v-text-field>
                            </v-flex>
                            <v-flex md6 xs6>
                                <v-menu
                                        v-model="birthdayMenu"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        min-width="290px"
                                >
                                    <v-text-field
                                            slot="activator"
                                            v-model="getProfile.dob"
                                            label="Birthday"
                                            prepend-icon="event"
                                            readonly
                                    ></v-text-field>
                                    <v-date-picker v-model="getProfile.dob" @input="birthdayMenu = false"></v-date-picker>
                                </v-menu>
                            </v-flex>
                        </v-layout>
                    </v-container>

                </v-form>

            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" :disabled="!valid || loading" @click="saveProfile">Save
                    <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                </v-btn>
                <v-btn    @click="$router.go(-1)">Cancel

                </v-btn>

            </v-card-actions>

        </v-card>
    </v-container>
</template>


<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../shared/AlertBox';

    export default {
        name: 'Profile',
        props: {
            msg: String
        },
        components: {
           'alert-box': AlertBox
        },
        data() {
            return {
                alert: false,
                valid:true,
                birthdayMenu: false,
                genders: [{text:'Male',value:"Male"},
                    {text:'Female',value:"Female"},
                    {text:'Doesnot Specify',value:"DoesnotSpecify"}],
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                usernameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length >= 6) || 'Profilename can\'t be less than 6 characters'
                ],
                genderRules: [
                    v => !!v || 'Gender is required'
                ]
            }
        },
        created: function(){

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'getProfile','loading','getEnums'
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
            saveProfile(){
                if(this.$refs.profile.validate()){
                    this.$store.dispatch('saveMe',{})
                }
            }
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
</style>
