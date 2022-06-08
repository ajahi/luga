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

                    <v-form ref="ebook" v-model="valid">
                        <v-container grid-list-md text-md-center>
                            <v-layout row wrap>
                                <input type="hidden" v-model="ebook.id"/>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="ebook"
                                            label="Ebook *"
                                            type="text"
                                            v-model="ebook.title"
                                            :rules="requiredRules"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="url"
                                            label="Ebook Url *"
                                            type="url"
                                            v-model="ebook.url"
                                            :rules="requiredRules"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex md6>

                                        <img height="200px" width="150px" :src="ebook.image | downloadUrl " alt="avatar" v-if="ebook.image">
                                    <input type="file"
                                           ref="file"
                                           name="file"
                                           required
                                           @change="onFileChange(
          $event.target.name, $event.target.files)"
                                          >
                                    <br />
                                </v-flex>


                                <v-flex md6>
                                    <v-menu
                                            v-model="monthMenu"
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
                                                v-model="ebook.month"
                                                label="Establishment Date"
                                                readonly
                                        ></v-text-field>
                                        <v-date-picker v-model="ebook.month" @input="monthMenu = false"></v-date-picker>
                                    </v-menu>
                                </v-flex>

                            </v-layout>
                        </v-container>

                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" :disabled="!valid || loading" @click="saveEbook">Save
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
                ebook:{
                    title:'',
                    month:'',
                    url:''
                },
                monthMenu: false,
                formData:null
            }
        },
        created: function(){
            this.fetchEbook()

        },
        mounted(){

        },
        methods:{
            fetchEbook(){
                if(this.id){
                  if(this.id ==='create'){
                      this.$store.dispatch('clearEbook');

                  }
                  else {
                      this.$store.dispatch('fetchEbook',this.id)
                          .then(response => {
                              this.ebook = response.data;
                          })
                  }
              }
            },
            saveEbook(){
                if(this.$refs.ebook.validate()){
                    this.$store.dispatch('saveEbook',this.ebook).then(response => {
                        if(response.data.created_id){
                            this.ebook.id = response.data.created_id;
                        }
                        if(this.formData){
                            this.axios.post('/ebook/'+this.ebook.id+'/image',this.formData)
                                .then(res => {
                                    this.$store.dispatch('showSuccessSnackbar',response.data.message);
                                    this.$router.push({name:'ebooks'});
                                });

                        }else{
                            this.$store.dispatch('showSuccessSnackbar',response.data.message);
                            this.$router.push({name:'ebooks'});
                        }


                    })
                        .catch(error => {
                            console.log("error"+error);
                            this.$store.dispatch('showErrorSnackbar',error);


                        })
                }
            },
            onFileChange(fieldName, file) {
                const { maxSize } = this
                let ebookFile = file[0]
                if (file.length>0) {
                    // let size = ebookFile.size / maxSize / maxSize
                        // Append file into FormData and turn file into image URL
                        this.formData = new FormData()
                        let imageURL = URL.createObjectURL(ebookFile)
                        this.formData.append(fieldName, ebookFile)
                        // Emit the FormData and image URL to the parent component
                }
            }
        },
        computed: {
            ...mapGetters([
                'loading','getEbook'
            ]),
            title(){
                if(this.ebook.id){
                    return "Edit "+ this.ebook.title
                }
                else
                    return "Create Ebook"

            },
            loading(){
                return this.$store.getters.loading;
            }
        }
    }
</script>

<style scoped>

</style>
