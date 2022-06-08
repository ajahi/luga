<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Quotes</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat to="/dashboard/quote/create">Create a Quote</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>

                        <download-excel
                                :data="getQuotes"
                                :fields="exportFields"
                                :name="excelFileName"
                        class="height-inherit">
                            <v-btn flat>Download as Excel  &nbsp; <v-icon>fa-file-excel</v-icon></v-btn>
                        </download-excel>


                </v-toolbar-items>

            </v-toolbar>
            <alert-box  />
            <v-data-table
                    :items="getQuotes"
                    :headers="headers">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index + 1  }}</td>
                    <td>{{ props.item.quote }}</td>
                    <td>{{ props.item.author }}</td>
                    <td>{{ props.item.year }}</td>
                    <td class="justify-center">
                        <router-link :to="{name: 'quote',params: {id: props.item.id}}">
                        <v-icon small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <v-icon @click="deleteQuote(props.item)" small>
                            delete
                        </v-icon>
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Quotes Yet.
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
        name: "quotes",
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
                    {text: 'Quote', sortable: false, value:'quote'},
                    {text: 'Author', sortable: true, value:'Author'},
                    {text: 'Year', sortable: false, value:'year'},
                    {text: 'Actions', sortable: false},
                ],
                selectedClub:{},
                snackbar:false,
                snackbarMsg:'',
                exportFields: {
                    'ID': 'id',
                    'Quote': 'quote',
                    'Author': 'author',
                    'Year': 'year',
                }
            }
        },
        created: function(){
            var app = this;
            this.$store.dispatch('fetchQuotes').then(response => {
            });

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'loading','getQuotes','getAlertMsg','getAlertType'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            queryStatus(){
                return this.$route.query.status;
            },
            excelFileName(){
                return 'Quotelist '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {


        },
        methods:{

            deleteQuote(item){
                this.$root.$confirm('Delete Quote','Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteQuote',item.id)
                                .then(response =>{
                                    this.$store.dispatch('showSuccessSnackbar',response.data.message);
                                    this.$store.dispatch('fetchQuotes');

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
