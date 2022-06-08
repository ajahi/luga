<template>
    <v-app id="login" class="primary">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md7>
                        <v-card class="elevation-12">
                            <v-toolbar  >
                                <v-toolbar-title>Register| Sign up Divine MIS</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-tooltip bottom>
                                    <v-btn
                                            slot="activator"
                                            :href="fbUrl"
                                            icon
                                            target="_blank"
                                    >
                                        <v-icon color="blue">fab fa-facebook-f</v-icon>
                                    </v-btn>
                                    <span>Signup using facebook</span>
                                </v-tooltip>
                                <v-tooltip right>
                                    <v-btn slot="activator" icon :href="googleUrl"
                                           target="_blank">
                                        <v-icon color="red">fab fa-google</v-icon>
                                    </v-btn>
                                    <span>Sigup using google</span>
                                </v-tooltip>
                            </v-toolbar>

                            <alert-box/>

                            <v-card-text>
                                <v-form ref="form" v-model="valid">
                                    <v-layout justify-space-between row>
                                        <v-text-field
                                                prepend-icon="person"
                                                name="firstName"
                                                label="First Name *"
                                                id="firstName"
                                                type="text"
                                                v-model="firstName"
                                        ></v-text-field>
                                        <v-spacer></v-spacer>
                                        <v-text-field
                                                prepend-icon="person"
                                                name="lastName"
                                                label="Last Name *"
                                                id="lastName"
                                                type="text"
                                                v-model="lastName"
                                        ></v-text-field>
                                    </v-layout>
                                    <v-flex>
                                        <v-text-field
                                                prepend-icon="email"
                                                name="email"
                                                label="Email *"
                                                id="email"
                                                type="email"
                                                v-model="email"
                                                :rules="emailRules"
                                                required></v-text-field>
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                                prepend-icon="face"
                                                name="username"
                                                label="Username *"
                                                id="username"
                                                type="text"
                                                v-model="username"
                                                :rules="usernameRules"
                                                required></v-text-field>
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                                prepend-icon="lock"
                                                name="password"
                                                label="Password *"
                                                id="password"
                                                type="password"
                                                v-model="password"
                                                required></v-text-field>
                                    </v-flex>
                                    <v-flex>
                                        <v-text-field
                                                prepend-icon="lock"
                                                name="confirmPassword"
                                                label="Confirm Password *"
                                                id="confirmPassword"
                                                type="password"
                                                v-model="passwordConfirm"
                                                :rules="[comparePasswords]"
                                                required
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex>
                                        <v-select
                                                prepend-icon="perm_identity"
                                                :items="genders"
                                                label="Gender *"
                                                v-model="gender"
                                                required
                                                :rules="[v => !!v || 'Gender is required']"></v-select>
                                    </v-flex>


                                </v-form>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" :disabled="!valid || loading" @click="userSignUp">Register
                                    <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                                </v-btn>

                            </v-card-actions>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>

</template>


<script>
    import AlertBox from '../shared/AlertBox'
    export default {
        components: {
            'alert-box': AlertBox
        },
        data() {
            return {
                firstName: '',
                lastName: '',
                email: '',
                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                username: '',
                usernameRules: [
                    v => !!v || 'Name is required',
                    v => (v && v.length >= 6) || 'Username can\'t be less than 6 characters'
                ],
                password: '',
                passwordConfirm: '',
                gender: '',
                genders: ['Male', 'Female', 'Other'],
                genderRules: [
                    v => !!v || 'Gender is required'
                ],
                valid: true,
            }
        },
        computed: {
            comparePasswords() {
                return this.password === this.passwordConfirm ? true : 'Passwords don\'t match'
            },
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
        methods: {
            userSignUp() {
                if (this.$refs.form.validate()) {
                    /*if(this.comparePasswords !== true){
                        return
                    }*/
                    this.$store.dispatch('userSignUp', {
                        email: this.email,
                        password: this.password,
                        firstName: this.firstName,
                        lastName: this.lastName,
                        rePassword: this.password,
                        username: this.username
                    })
                }
            }
        },
        created: function(){
            this.$store.commit('setLayout','simple-layout')
        },
        props: {
            source: String
        }
    }
</script>

<style scoped lang="css">
    #login {
        height: 50%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        content: "";
        z-index: 0;
    }
</style>
