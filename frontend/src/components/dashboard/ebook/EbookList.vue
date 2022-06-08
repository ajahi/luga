<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Ebooks</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat to="/dashboard/ebook/create">Create a Ebook</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>

                </v-toolbar-items>

            </v-toolbar>
            <alert-box  />
            <v-data-table
                    :items="getEbooks"
                    :headers="headers">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index + 1  }}</td>
                    <td>{{ props.item.title }}</td>
                    <td><p v-if="props.item.image"><img height="100px" width="60px" :src="props.item.image | downloadUrl " alt="avatar" ></p></td>
                    <td>{{ props.item.month }}</td>
                    <td class="justify-center">
                        <router-link :to="{name: 'ebook',params: {id: props.item.id}}">
                        <v-icon small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <v-icon @click="deleteEbook(props.item)" small>
                            delete
                        </v-icon>
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Ebooks Yet.
                    </v-alert>
                </template>
            </v-data-table>



        </v-card>
    </v-container>
</template>

<script>
    import { mapGetters, mapActions} from 'vuex';
    import AlertBox from '../../shared/AlertBox';

    export default {
        name: "ebooks",
        props:{
            msg:String
        },
        components: {
            'alert-box':AlertBox
        },
        data(){
            return {
                alert:false,
                valid:true,
                clubs:[],
                headers: [
                    {text: 'SN',value:'sn'},
                    {text: 'Title', sortable: false, value:'title'},
                    {text: 'Image', sortable: true, value:'month'},
                    {text: 'Month', sortable: true, value:'month'},
                    {text: 'Actions', sortable: false},
                ],
                selectedClub:{},
                snackbar:false,
                snackbarMsg:'',

            }
        },
        created: function(){
            var app = this;
            this.$store.dispatch('fetchEbooks').then(response => {
            });

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'loading','getEbooks','getAlertMsg','getAlertType'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            queryStatus(){
                return this.$route.query.status;
            },
            excelFileName(){
                return 'Ebooklist '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {


        },
        methods:{

            deleteEbook(item){
                this.$root.$confirm('Delete '+item.title,'Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteEbook',item.id)
                                .then(response =>{
                                    this.$store.dispatch('showSuccessSnackbar',response.data.message);
                                    this.$store.dispatch('fetchEbooks');

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
