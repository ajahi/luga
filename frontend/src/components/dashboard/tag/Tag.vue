<template>
    <v-container>
            <v-card class="elevation-12">
                <v-card-title  v-if="!reuse">
                    <div>
                        <h3 class="headline">{{title}}</h3>

                    </div>
                </v-card-title>
                <v-card-text>

                    <v-form ref="tag" v-model="valid">
                        <v-container grid-list-md text-md-center>
                            <v-layout row wrap align-center>
                                <input type="hidden" v-model="tag.id"/>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="tag"
                                            label="Tag *"
                                            type="text"
                                            v-model="tag.title"
                                            :rules="requiredRules"
                                            v-validate
                                            data-vv-name="title"
                                            :error-messages="errors.first('title')"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            prepend-icon="person"
                                            name="description"
                                            label="Description"
                                            type="text"
                                            v-model="tag.description"
                                            v-validate
                                            data-vv-name="description"
                                            :error-messages="errors.first('description')"
                                    ></v-text-field>
                                </v-flex>


                            </v-layout>
                        </v-container>

                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" :disabled="!valid || loading" @click="saveTag">Save
                        <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                    </v-btn>
                    <v-btn @click="$router.go(-1)">Cancel

                    </v-btn>

                </v-card-actions>

            </v-card>
    </v-container>

</template>

<script>
    import { mapGetters} from 'vuex';

    export default {
        name: "tag",
        props: ['msg','id','reuse'],
        inject: ['$validator'],
        data() {
            return {
                alert: false,
                valid: true,
                requiredRules: [
                    v => !!v || 'Required field'
                ],
                tag:{},
                monthMenu: false,
                formData:null
            }
        },
        created: function(){
            this.fetchTag()

        },
        mounted(){

        },
        methods:{
            fetchTag(){
                if(this.id){
                  if(this.id ==='create'){
                      this.$store.dispatch('clearTag');

                  }
                  else {
                      this.$store.dispatch('fetchTag',this.id)
                          .then(response => {
                              this.tag = response.data.data;
                          })
                  }
              }
            },
            saveTag(){
                if(this.$refs.tag.validate()){
                    this.$store.dispatch('saveTag',this.tag).then(response => {
                        if(response.status === 201){
                            if(this.reuse){
                                this.$store.dispatch('showSuccessSnackbar','Tag was created successfully');
                                this.$emit('created-tag',response.data);

                            }else{
                                this.$store.dispatch('showSuccessSnackbar','Tag was created successfully');
                                this.$router.push({name:'tags'});
                            }
                        }else{
                            this.$store.dispatch('showSuccessSnackbar','Tag was edited successfully');
                            this.$router.push({name:'tags'});
                        }


                    })
                        .catch(error => {
                            this.$store.dispatch('showErrorSnackbar',error);


                        })
                }
            },
            onFileChange(fieldName, file) {
                const { maxSize } = this
                let tagFile = file[0]
                if (file.length>0) {
                    // let size = tagFile.size / maxSize / maxSize
                        // Append file into FormData and turn file into image URL
                        this.formData = new FormData()
                        let imageURL = URL.createObjectURL(tagFile)
                        this.formData.append(fieldName, tagFile)
                        // Emit the FormData and image URL to the parent component
                }
            }
        },
        computed: {
            ...mapGetters([
                'loading','getTag'
            ]),
            title(){
                if(this.tag.id){
                    return "Edit "+ this.tag.title
                }
                else
                    return "Create Tag"

            },
            loading(){
                return this.$store.getters.loading;
            }
        }
    }
</script>

<style scoped>

</style>
