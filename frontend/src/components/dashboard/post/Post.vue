<template>
    <v-container>
            <v-card class="elevation-12">
                <v-card-title>
                    <div>
                        <h3 class="headline">{{title}}</h3>

                    </div>
                </v-card-title>
                <v-card-text>

                    <v-form ref="post" v-model="valid">
                        <v-container grid-list-md text-md-center>
                            <v-layout row wrap align-center>
                                <input type="hidden" v-model="post.id"/>
                                <v-flex md12 sm12>
                                    <v-text-field
                                            name="post"
                                            label="Post *"
                                            type="text"
                                            v-model="post.title"
                                            :rules="requiredRules"
                                            v-validate
                                            data-vv-name="title"
                                            :error-messages="errors.first('title')"
                                    ></v-text-field>
                                </v-flex><v-flex md12 sm12>
                                    <v-text-field
                                            name="slug"
                                            label="Slug"
                                            type="text"
                                            disabled
                                            v-model="post.slug"
                                            :rules="requiredRules"
                                            v-validate
                                            data-vv-name="slug"
                                            :error-messages="errors.first('slug')"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex md12 sm12>
                                   <!-- <v-textarea
                                            name="description"
                                            label="Description *"
                                            type="text"
                                            v-model="post.description"
                                            :rules="requiredRules"
                                            data-vv-name="description"
                                            :error-messages="errors.first('description')"
                                    ></v-textarea>-->
                                   <!-- <v-textarea
                                        v-model="post.description">
                                    </v-textarea>-->

                                    <vue-editor
                                            :customModules="customModulesForEditor"
                                            :editorOptions="editorSettings"
                                            v-model="post.description"></vue-editor>

                                </v-flex>
                                <v-flex md6 sm12 >
                                    <v-select
                                            name="status"
                                            :items="statusOptions"
                                            label="Status *"
                                            v-model="post.status"
                                            :rules="requiredRules"
                                    ></v-select>
                                </v-flex>
                                <v-flex md6 sm12 >
                                    <v-select
                                            name="category"
                                            :items="getCategories"
                                            label="Category *"
                                            v-model="post.category_id"
                                            item-text="title"
                                            item-value="id"
                                            :rules="requiredRules"
                                    ></v-select>
                                </v-flex>

                                <v-flex>
                                    <v-autocomplete
                                    label="Tags "
                                    ref="tags"
                                    v-model="post.tags_id"
                                    :items="tags"
                                    item-text="title"
                                    item-value="id"
                                    multiple
                                    >
                                        <template slot="no-data">
                                            <v-flex>
                                                <v-expansion-panel>
                                                    <v-expansion-panel-content
                                                            v-for="i in 1" :key="i">
                                                        <div slot="header"><v-btn flat block color="primary"> Create new Tag & Add</v-btn></div>
                                                        <tag
                                                                reuse="true"
                                                                @created-tag="createTagAndUpdateModel"
                                                        ></tag>

                                                    </v-expansion-panel-content>
                                                </v-expansion-panel>

                                            </v-flex>
                                        </template>


                                    </v-autocomplete>
                                </v-flex>
                                <v-flex md6 sm12 >
                                    <v-label
                                    >Feature Image:</v-label>
                                    <img style="max-width: 100%;height: auto" :src="post.featured" height="200px" v-if="post.featured">

                                    <input
                                            name="featured"
                                            label="Featured Image "
                                            type="file"
                                            @change="handleFileUpload"
                                    />
                                </v-flex>



                            </v-layout>
                        </v-container>

                    </v-form>

                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" :disabled="!valid || loading" @click="savePost">Save
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
    import AlertBox from '../../shared/AlertBox';

    import { VueEditor,Quill } from 'vue2-editor'
    import { ImageDrop } from "quill-image-drop-module";
    import ImageResize from "quill-image-resize-module";
    import slugify from 'slugify'
    import Tag from "../tag/Tag";

    export default {
        name: "post",
        props: ['msg','id'],
        components: {
            Tag,
            'alert-box': AlertBox,
            'vue-editor': VueEditor
        },
        inject: ['$validator'],
        data() {
            return {
                customModulesForEditor: [
                    { alias: "imageDrop", module: ImageDrop },
                    { alias: "imageResize", module: ImageResize }
                ],
                editorSettings: {
                    modules: {
                        imageResize: {}
                    }
                },
                alert: false,
                valid: true,
                requiredRules: [
                    v => !!v || 'Required field'
                ],
                post:{
                    tags_id: []
                },
                featured: null,
                monthMenu: false,
                formData:null,
                tags:[],
                search:'',
                statusOptions: [{text: 'Published', value: 'published'}, {text: 'Draft', value: 'draft'}],
            }
        },
        created: function(){
            this.fetchPost()
            this.$store.dispatch('fetchCategories')
            this.$store.dispatch('fetchTags').then(response => {
                this.tags = response.data.data
            })

        },
        mounted(){

        },
        methods:{
            fetchPost(){
                if(this.id){
                  if(this.id ==='create'){
                      this.$store.dispatch('clearPost');

                  }
                  else {
                      this.$store.dispatch('fetchPost',this.id)
                          .then(response => {
                              this.post = response.data.data;
                          })
                  }
              }
            },
            savePost(){
                if(this.$refs.post.validate()){
                    this.$store.commit('setLoading',true);
                    this.post.attributes = JSON.stringify(this.post.attributes)
                    //for image converting all to formdata
                    var formData = new FormData();
                    formData.append('id',this.post.id);
                    formData.append('title',this.post.title);
                    formData.append('slug',this.post.slug);
                    formData.append('description',this.post.description);
                    formData.append('category_id',this.post.category_id);
                    formData.append('status',this.post.status);
                    formData.append('attributes', this.post.attributes);
                    //quick fix since for author user_id need to be send
                    formData.append('user_id',this.$store.getters.userid);
                    if (this.featured) {
                        formData.append('featured', this.featured);
                    }
                    formData.append('tags_id',this.post.tags_id);
                    if(this.post.id){
                        formData.append('_method', "put");
                        this.axios.post('/post/'+this.post.id,formData)
                            .then(response => {
                                this.$store.commit('setLoading',false);
                                this.$store.dispatch('showSuccessSnackbar','Post was edited successfully');
                                this.$router.push({name:'posts'});
                            })
                            .catch(error => {
                                this.$store.commit('setLoading',false);
                            });
                    }
                    else{
                        this.axios.post('/post',formData)
                            .then(response => {
                                this.$store.commit('setLoading',false);
                                this.$store.dispatch('showSuccessSnackbar','Post was created successfully');
                                this.$router.push({name:'posts'});
                            })
                            .catch(error => {
                                this.$store.commit('setLoading',false);
                            });
                    }
                }
            },
            handleFileUpload(event) {
                this.featured = event.target.files[0]
            },
            createTagAndUpdateModel(e){
                this.tags.push(e.data);
                setTimeout(()=>{
                    this.$refs.tags.isMenuActive= false;
                    this.post.tags_id.push(e.data.id)

                },50);
            }

        },
        computed: {
            ...mapGetters([
                'loading','getPost','getCategories','getTags'
            ]),
            title(){
                if(this.post.id){
                    return "Edit "+ this.post.title
                }
                else
                    return "Create Post"

            },
            postTitle(){
              return this.post.title
            },
            loading(){
                return this.$store.getters.loading;
            }
        },
        watch: {
            postTitle: function(val) {
                this.post.slug= slugify(val,{lower:true});
            }
        }
    }
</script>

<style scoped>

</style>
