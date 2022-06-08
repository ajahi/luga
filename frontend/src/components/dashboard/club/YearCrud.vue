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

                        <v-form ref="year" v-model="valid">
                            <v-container grid-list-md text-md-center>
                                <v-layout row wrap>

                                        <input type="hidden" v-model="getYear.id"/>
                                    <v-flex md12>
                                        <v-text-field
                                                name="title"
                                                label="Title of the Year *"
                                                type="text"
                                                v-model="getYear.title"
                                                :rules="[v => !!v || 'Title is required']"
                                                md12
                                        ></v-text-field>
                                    </v-flex>

                                    <v-flex md6 xs6>
                                        <v-menu
                                                v-model="startDate"
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
                                                    v-model="getYear.startDate"
                                                    label="Start Date"
                                                    readonly
                                            ></v-text-field>
                                            <v-date-picker v-model="getYear.startDate" @input="startDate = false"></v-date-picker>
                                        </v-menu>

                                    </v-flex>
                                    <v-flex md6 xs6>
                                        <v-menu
                                                v-model="endDate"
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
                                                    v-model="getYear.endDate"
                                                    label="End Date"
                                                    readonly
                                            ></v-text-field>
                                            <v-date-picker v-model="getYear.endDate" @input="endDate = false"></v-date-picker>
                                        </v-menu>
                                    </v-flex>
                                    <v-flex>
                                        <v-switch v-model="getYear.running" label="Running Year?"></v-switch>
                                    </v-flex>

                                </v-layout>
                            </v-container>

                        </v-form>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="primary" :disabled="!valid || loading" @click="saveYear">Save
                            <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                        </v-btn>
                        <v-btn    @click="$router.go(-1)">Cancel

                        </v-btn>

                    </v-card-actions>

                </v-card>
</template>

<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../../shared/AlertBox';
    import ImageInput from '../../shared/ImageInput'

    export default {
        name: "year-crud",
        props: ['msg','yearid'],
        components: {
            'alert-box': AlertBox,
        },
        data() {
            return {
                alert: false,
                valid: true,
                startDate: false,
                endDate: false,

            }
        },
        created: function(){
            this.fetchYear()
        },
        mounted(){

        },
        methods:{
            fetchYear(){
                if(this.yearid){
                  if(this.yearid ==='create'){
                      this.$store.dispatch('clearYear');
                  }
                  else {
                      this.$store.dispatch('fetchYear',this.yearid)
                          .then(response => {
                          })
                  }
              }
            },
            saveYear(){
                if(this.$refs.year.validate()){
                    this.$store.dispatch('saveYear',this.getYear).then(response => {
                        this.$router.push({name:'yearList'});
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
                'loading','getYears','getYear'
            ]),
            title(){
                if(this.getYear.id){
                    return "Edit "+ this.getYear.title
                }
                else
                    return "Create Year"

            },
            loading(){
                return this.$store.getters.loading;
            },
        }
    }
</script>

<style scoped>

</style>
