<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Tags</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat to="/dashboard/tag/create">Create a Tag</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>
                    <v-text-field
                            v-model="search"
                            light
                            prepend-icon="search"
                            placeholder="Type keyword...">
                    </v-text-field>
                </v-toolbar-items>

            </v-toolbar>
            <v-data-table
                    :items="tags"
                    :headers="headers"
                    :pagination.sync="pagination"
                    :total-items="total"
                    :rows-per-page-items="getPageSize"
                    :loading="loading">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index +1 + ((pagination.page-1) * pagination.rowsPerPage) }}</td>
                    <!--<td>
                        <router-link :to="{name: 'tag',params: {id: props.item.id}}">
                            {{props.item.id}}
                        </router-link>
                    </td>-->
                    <td>{{ props.item.title }}</td>
                    <td>{{ props.item.description }}</td>
                    <td class="justify-center">
                        <router-link :to="{name: 'tag',params: {id: props.item.id}}">
                        <v-icon color="primary" small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <v-icon color="red" @click="deleteTag(props.item)" small >
                            delete
                        </v-icon>
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Tags Yet.
                    </v-alert>
                </template>
            </v-data-table>



        </v-card>
    </v-container>
</template>

<script>
    import { mapGetters, mapActions} from 'vuex';

    export default {
        name: "tags",
        props:{
            msg:String
        },
        components: {
        },
        data(){
            return {
                headers: [
                    {text: 'SN',sortable: false,value:'sn'},
                    {text: 'Title', sortable: true, value:'title'},
                    {text: 'Description', sortable: true, value:'description'},
                    {text: 'Actions', sortable: false},
                ],
                tags:[],
                total:0,
                search:null,
                pagination: {},
                loading: true

            }
        },
        created: function(){


        },
        mounted(){
            this.getTagsByPagination();

        },
        computed: {
            ...mapGetters([
                'getTags','getPageSize'
            ]),
            excelFileName(){
                return 'Taglist '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {
            pagination() {
                    this.getTagsByPagination();
            },
            search(){
                this.getTagsByPagination();
            }

        },
        methods:{
            getTagsByPagination(){
              this.loading = true;
              return new Promise((resolve,reject) => {
                  const { sortBy, descending, page, rowsPerPage } = this.pagination
                  this.pagination.limit = rowsPerPage;
                  if(this.search){
                      this.pagination.title = this.search;
                  }
                  this.$store.dispatch('fetchTags',this.pagination)
                      .then(response => {
                          this.loading = false;
                          this.tags = response.data.data;
                          this.total = response.data.meta.total;
                      })

              })
            },

            deleteTag(item){
                this.$root.$confirm('Delete '+item.title,'Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteTag',item.id)
                                .then(response =>{
                                    this.$store.dispatch('showSuccessSnackbar',response.data.message);
                                    this.$store.dispatch('fetchTags');

                                })
                        }
                        else{

                        }
                    })
            }

        }
    }
</script>

<style scoped>
    .height-inherit{
        height: inherit;
    }
</style>
