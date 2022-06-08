<template>
    <v-container>
        <v-layout row wrap align-center >
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

                    <v-form ref="quote" v-model="valid">
                        <v-container grid-list-md text-md-center>
                            <v-layout row wrap>
                                <input type="hidden" v-model="quote.id"/>
                                <v-flex md12 sm12>
                                    <v-textarea
                                            prepend-icon="person"
                                            name="quote"
                                            label="Quote *"
                                            type="text"
                                            v-model="quote.quote"
                                            :rules="requiredRules"
                                    ></v-textarea>
                                </v-flex>

                                <v-flex md6>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="author"
                                            label="Author *"
                                            type="text"
                                            v-model="quote.author"
                                            :rules="requiredRules"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex md6>
                                    <v-text-field
                                            prepend-icon="email"
                                            name="year"
                                            label="Year "
                                            v-model="quote.year"

                                    ></v-text-field>
                                </v-flex>

                            </v-layout>
                        </v-container>

                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" :disabled="!valid || loading" @click="saveQuote">Save
                        <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                    </v-btn>
                    <v-btn @click="$router.go(-1)">Cancel

                    </v-btn>

                </v-card-actions>

            </v-card>
        </v-layout>
    </v-container>

</template>

<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../../shared/AlertBox';

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
                requiredRules: [
                    v => !!v || 'Required field'
                ],
                quote:{
                    author: 'Jagadguru 1008  Shree Kripalu ji  Maharaj',
                    year:'2075'
                }
            }
        },
        created: function(){
            this.fetchQuote()
            this.$store.dispatch('fetchClubs');

        },
        mounted(){

        },
        methods:{
            fetchQuote(){
                if(this.id){
                  if(this.id ==='create'){
                      this.$store.dispatch('clearQuote');

                  }
                  else {
                      this.$store.dispatch('fetchQuote',this.id)
                          .then(response => {
                              this.quote = response.data;
                          })
                  }
              }
            },
            saveQuote(){
                if(this.$refs.quote.validate()){
                    this.$store.dispatch('saveQuote',this.quote).then(response => {
                        this.$store.dispatch('showSuccessSnackbar',response.data.message);
                        this.$router.push({name:'quotes'});

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
                'loading','getQuote'
            ]),
            title(){
                if(this.quote.id){
                    return "Edit "+ this.quote.quote
                }
                else
                    return "Create Quote"

            },
            loading(){
                return this.$store.getters.loading;
            }
        }
    }
</script>

<style scoped>

</style>
