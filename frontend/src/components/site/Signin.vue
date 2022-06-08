<template>
    <v-app id="login" class="primary">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4 lg4>
                        <v-card class="elevation-1 pa-3">
                            <v-card-text>

                                <div class="layout column align-center">
                                    <v-avatar
                                            size="250">
                                        <img src="@/assets/logo.png" alt="Company Logo" class="mb-5">
                                    </v-avatar>
                                    <h1 class="flex my-2 secondary--text"> {{app.title}}</h1>
                                </div>
                                <!--<v-layout align-space-between justify-center column fill-height>
                                    <h3 class="text-xs-center green&#45;&#45;text text&#45;&#45;lighten-1" >Login with ease</h3>
                                    <v-flex >
                                        <v-btn block flat slot="activator" :href="fbUrl"  >
                                            <span class="text&#45;&#45;lighten-5" >Login with facebook</span> <v-spacer></v-spacer><v-icon color="blue">fab fa-facebook</v-icon>
                                        </v-btn>
                                        <v-btn block flat slot="activator" :href="googleUrl">
                                            <span > Login with Google </span> <v-spacer></v-spacer> <v-icon color="red">fab fa-google </v-icon>
                                        </v-btn>
                                        <p class="text-xs-center">OR</p>

                                    </v-flex>

                                </v-layout>-->
                                <alert-box />
                                <v-form ref="form" v-on:submit.prevent>
                                    <v-text-field append-icon="person" name="login" label="Login" type="text" v-model="email"></v-text-field>
                                    <v-text-field append-icon="lock" name="password" label="Password" id="password" type="password" v-model="password"></v-text-field>

                                </v-form>
                            </v-card-text>
                            <v-card-actions column>
                                <v-spacer></v-spacer>
                                <v-btn block color="primary" @click="userLogin" :loading="loading">Login</v-btn>

                            </v-card-actions>
                            <!--<p class="flex text-xs-right mr-3">New User? <router-link to="/signup">Register</router-link></p>-->

                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>

        <v-snackbar
                :timeout="snackbar.time"
                bottom
                right
                :color="snackbar.color"
                v-model="snackbar.show"
        >
            {{ snackbar.text }}
            <v-btn dark flat @click.native="snackbar.show = false" icon>
                <v-icon>close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-app>

</template>
<style>

</style>

<script>
    import AlertBox from '../shared/AlertBox';
    import {mapGetters} from "vuex";
    export default {
        components: {
            'alert-box': AlertBox
        },
        data: () => ({
            drawer: null,
            email: '',
            password: '',
            valid: true,
            alert: false,
            confirmToken :'',
            snackbar: {
                show:'',
                color: '',
                text:'',
                time:3600
            }
        }),
        props: {
            source: String,
            error: String

        },
        computed: {
            ...mapGetters([
                'app'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            fbUrl() {
                return this.$store.getters.fbLoginUrl
            },
            googleUrl() {
                return this.$store.getters.googleLoginUrl;
            }
        },
        methods: {
            userLogin() {
                if (this.$refs.form.validate()) {
                    this.$store.dispatch('userSignIn', {
                        email: this.email,
                        password: this.password
                    })
                }

            },
            emailConfirm(){

            }
        },
        created: function(){
            //this.$store.commit('setLayout','simple-layout')
            //for routing with success full token from signup
            const token = this.$route.query.token;
            if(token){
                this.$store.dispatch('autoLogin', {
                    token: token
                })
            }
            // when confirm token for email verification
            this.confirmToken = this.$route.query.confirmToken;
            if(this.confirmToken){
                this.$store.dispatch('confirmEmailConfirmation',{token: this.confirmToken});
            }

            if(this.$route.query.error){
                this.snackbar.show = true;
                this.snackbar.color = 'red';
                this.snackbar.text = this.$route.query.error;
            }

        },
        mounted(){


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
