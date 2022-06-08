<template>
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

            <v-form ref="member" v-model="valid">
                <v-container grid-list-md text-md-center>
                    <v-layout row wrap>
                        <input type="hidden" v-model="getMember.id"/>
                        <v-text-field
                                prepend-icon="person"
                                name="firstName"
                                label="First Name *"
                                id="firstName"
                                type="text"
                                v-model="getMember.firstName"
                        ></v-text-field>
                        <v-text-field
                                prepend-icon="person"
                                name="lastName"
                                label="Last Name *"
                                id="lastName"
                                type="text"
                                v-model="getMember.lastName"
                        ></v-text-field>
                        <v-flex md12>
                            <v-text-field
                                    prepend-icon="email"
                                    name="email"
                                    label="Email "
                                    id="email"
                                    type="email"
                                    v-model="getMember.email"
                                    :rules="emailRules"
                                    required
                            ></v-text-field>
                        </v-flex>
                        <!--<v-flex>
                            <v-text-field
                                    prepend-icon="face"
                                    name="username"
                                    label="Username"
                                    id="username"
                                    type="text"
                                    v-model="getMember.username"
                                    :rules="usernameRules"
                                    disabled
                                    required></v-text-field>
                        </v-flex>-->


                        <v-flex md6>
                            <v-select
                                    prepend-icon="perm_identity"
                                    :items="getEnums.genders"
                                    label="Gender *"
                                    v-model="getMember.gender"
                                    required>
                            </v-select>
                        </v-flex>
                        <v-flex md6>
                            <v-select
                                    prepend-icon="perm_identity"
                                    :items="getEnums.bloodGroups"
                                    label="Blood Group *"
                                    v-model="getMember.bloodGroup"
                                    required>
                            </v-select>
                        </v-flex>
                        <v-flex md6>
                            <v-text-field
                                    prepend-icon="phone"
                                    label="Contact"
                                    type="number"
                                    v-model="getMember.mobileNumber"></v-text-field>
                        </v-flex>
                        <v-flex md6>
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
                                        v-model="getMember.dob"
                                        label="Birthday"
                                        prepend-icon="event"
                                        readonly
                                ></v-text-field>
                                <v-date-picker v-model="getMember.dob" @input="birthdayMenu = false"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex>
                            <v-select
                                    prepend-icon="perm_identity"
                                    :items="clubs"
                                    label="Club *"
                                    v-model="getMember.clubId"
                                    required>
                            </v-select>
                        </v-flex>
                    </v-layout>
                </v-container>

            </v-form>

        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="primary" :disabled="!valid || loading" @click="saveMember">Save
                <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
            </v-btn>
            <v-btn @click="$router.go(-1)">Cancel

            </v-btn>

        </v-card-actions>

    </v-card>
</template>

<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../../shared/AlertBox';
    import ImageInput from '../../shared/ImageInput'

    export default {
        name: "member",
        props: ['msg','id'],
        components: {
            'alert-box': AlertBox,
        },
        data() {
            return {
                alert: false,
                valid: true,
                birthdayMenu: false,
                member:{},
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
            this.fetchMember()
            this.$store.dispatch('fetchClubs');

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
                          })
                  }
              }
            },
            saveMember(){
                if(this.$refs.member.validate()){
                    this.$store.dispatch('saveMember',this.getMember).then(response => {
                        this.$store.dispatch('showSuccessSnackbar',response.data.message);
                        if(response.data.created_id){
                            this.$router.push({name:'club-designation',params: {designationid: 'create'}});
                        }

                    })
                        .catch(error => {
                            console.log("error"+error);
                            this.$store.dispatch('showErrorSnackbar',error);


                        })
                }
            }
        },
        computed: {
            ...mapGetters([
                'getMember','loading','getEnums','getClubs'
            ]),
            title(){
                if(this.getMember.id){
                    return "Edit "+ this.getMember.email
                }
                else
                    return "Create Member"

            },
            loading(){
                return this.$store.getters.loading;
            },
            clubs() {
                return this.getClubs.map(club => {
                    return {
                        text: club.name,
                        value: club.id
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
