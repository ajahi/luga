<template>
    <v-card class="elevation-12">
                    <v-card-title>
                        <div>
                            <h3 class="headline">{{title}}</h3>

                        </div>
                    </v-card-title>

                    <alert-box/>
                    <v-card-text>

                        <v-form ref="club" v-model="valid">
                            <v-container grid-list-md text-md-center>
                                <v-layout row wrap>

                                        <input type="hidden" v-model="club.id"/>
                                    <v-flex md12>
                                        <v-text-field
                                                name="name"
                                                label="Name of the club *"
                                                type="text"
                                                v-model="club.name"
                                                :rules="[v => !!v || 'Name is required']"
                                                md12
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                        <v-textarea
                                                name="description"
                                                label="Description of club"
                                                type="text"
                                                v-model="club.description"
                                        ></v-textarea>

                                    </v-flex>




                                    <v-flex md6 xs6>
                                        <v-text-field
                                                label="Contact N0"
                                                type="number"
                                                v-model="club.contactNo"
                                                :rules="[v => !!v || 'Contact is required']"
                                        >

                                        </v-text-field>
                                    </v-flex>
                                    <v-flex md6 xs6>
                                        <v-menu
                                                v-model="establishDateMenu"
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
                                                    v-model="club.establishDate"
                                                    label="Establishment Date"
                                                    readonly
                                            ></v-text-field>
                                            <v-date-picker v-model="club.establishDate" @input="establishDateMenu = false"></v-date-picker>
                                        </v-menu>
                                    </v-flex>
                                </v-layout>
                            </v-container>

                        </v-form>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="primary" :disabled="!valid || loading" @click="saveClub">Save
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
        name: "club-crud",
        props: ['msg','id'],
        components: {
            'alert-box': AlertBox,
        },
        data() {
            return {
                alert: false,
                valid: true,
                establishDateMenu: false,
                club: {
                    id: '',
                    name: '',
                    establishDate: '',
                    logo: '',
                    contactNo: '',
                    fbUrl: ''
                }
            }
        },
        created: function(){
            this.fetchClub()
        },
        mounted(){

        },
        methods:{
            fetchClub(){
                if(this.id){
                  if(this.id ==='create'){
                      this.$store.dispatch('clearClub');
                  }
                  else {
                      this.$store.dispatch('fetchClub',this.id)
                          .then(response => {
                              this.club.id = response.data.id
                              this.club.name =response.data.name
                              this.club.description= response.data.description
                              this.club.establishDate= response.data.establishDate
                              this.club.contactNo = response.data.contactNo
                              this.club.logo= response.data.logo
                              this.$store.dispatch('fetchDefaultYear',response.data.id);
                          })
                  }
              }
            },
            saveClub(){
                if(this.$refs.club.validate()){
                    this.$store.dispatch('saveClub',this.club).then(response => {
                        if(response.data.created_id){
                            this.club.id = response.data.created_id;

                        }
                        this.$store.dispatch('fetchClub',this.club.id);
                        this.$store.dispatch('showSuccessSnackbar',response.data.message);
                    })
                        .catch(error => {
                            this.$store.dispatch('showErrorSnackbar',error.response.data.errors);
                        })

                }
            }
        },
        computed: {
            title(){
                if(this.club.id){
                    return "Edit "+ this.club.name
                }
                else
                    return "Create Club"

            },
            loading(){
                return this.$store.getters.loading;
            },
        }
    }
</script>

<style scoped>

</style>
