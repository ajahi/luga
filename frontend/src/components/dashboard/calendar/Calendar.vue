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

                    <v-form ref="calendar" v-model="valid">
                        <v-container grid-list-md text-md-center>
                            <v-layout row wrap>
                                <input type="hidden" v-model="calendar.id"/>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="title"
                                            label="Title *"
                                            type="text"
                                            v-model="calendar.title"
                                            :rules="requiredRules"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="url"
                                            label="Calendar Url *"
                                            type="url"
                                            v-model="calendar.url"
                                            :rules="requiredRules"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex>
                                    <v-switch v-model="calendar.running" label="Running Year Calendar?"></v-switch>
                                </v-flex>

                            </v-layout>
                        </v-container>

                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" :disabled="!valid || loading" @click="saveCalendar">Save
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
                calendar:{
                    title:'',
                    url:'',
                    running:false
                },
            }
        },
        created: function(){
            this.fetchCalendar()


        },
        mounted(){

        },
        methods:{
            fetchCalendar(){
                if(this.id){
                  if(this.id ==='create'){
                      this.$store.dispatch('clearCalendar');

                  }
                  else {
                      this.$store.dispatch('fetchCalendar',this.id)
                          .then(response => {
                              this.calendar = response.data;
                          })
                  }
              }
            },
            saveCalendar(){
                if(this.$refs.calendar.validate()){
                    this.$store.dispatch('saveCalendar',this.calendar).then(response => {
                        if(response.data.created_id){
                            this.calendar.id = response.data.created_id;
                        }
                            this.$store.dispatch('showSuccessSnackbar',response.data.message);
                            this.$router.push({name:'calendars'});
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
                'loading','getCalendar'
            ]),
            title(){
                if(this.calendar.id){
                    return "Edit "+ this.calendar.title
                }
                else
                    return "Create Calendar"

            },
            loading(){
                return this.$store.getters.loading;
            }
        }
    }
</script>

<style scoped>

</style>
