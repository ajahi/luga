<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Years</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat :to="{name:'year',params: {yearid:'create'}}">Create a Year</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>

                        <download-excel
                                :data="getYears"
                                :fields="exportFields"
                                :name="excelFileName"
                        class="height-inherit">
                            <v-btn flat>Download as Excel  &nbsp; <v-icon>fa-file-excel</v-icon></v-btn>
                        </download-excel>


                </v-toolbar-items>

            </v-toolbar>
            <alert-box  />
            <v-data-table
                    :items="getYears"
                    :headers="headers">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index + 1  }}</td>
                    <td>{{ props.item.title }}</td>
                    <td>{{ props.item.startDate+ '-'+props.item.endDate }}</td>
                    <td><v-chip v-if="props.item.running" color="green">running</v-chip></td>
                    <td class="justify-center">
                        <router-link :to="{name: 'year',params: {yearid: props.item.id}}">
                        <v-icon small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <v-icon @click="deleteClub(props.item)" small>
                            delete
                        </v-icon>
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Year Yet.
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
        name: "years",
        props:['id'],
        components: {
            'alert-box':AlertBox
        },
        data(){
            return {
                alert:false,
                valid:true,
                years:[],
                headers: [
                    {text: 'SN',value:'sn'},
                    {text: 'Title', sortable: false, value:'title'},
                    {text: 'Date', sortable: true, value:'startDate'},
                    {text: 'Running', sortable: false, value:'running'},
                    {text: 'Actions', sortable: false},
                ],
                selectedClub:{},
                snackbar:false,
                snackbarMsg:'',
                exportFields: {
                    'ID': 'id',
                    'Title': 'title',
                    'Date': 'startDate',
                    'Running': 'running',
                }
            }
        },
        created: function(){
            var app = this;
            this.$store.dispatch('fetchYears',this.id).then(response => {
                this.years = this.$store.getters.getYears
            });

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'loading','getYears','getAlertMsg','getAlertType'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            queryStatus(){
                return this.$route.query.status;
            },
            excelFileName(){
                return 'Year list '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {


        },
        methods:{
            editClub(item){

            },
            deleteClub(item){
                this.$root.$confirm('Delete ' +item.title,'Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteYear',item.id)
                                .then(response =>{
                                    this.$store.dispatch('showSuccessSnackbar',response.data.message);
                                    this.$store.dispatch('fetchYears');

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
