<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Clubs</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat to="/dashboard/club/create">Create a Club</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>

                        <download-excel
                                :data="getClubs"
                                :fields="exportFields"
                                :name="excelFileName"
                        class="height-inherit">
                            <v-btn flat>Download as Excel  &nbsp; <v-icon>fa-file-excel</v-icon></v-btn>
                        </download-excel>


                </v-toolbar-items>

            </v-toolbar>
            <alert-box  />
            <v-data-table
                    :items="getClubs"
                    :headers="headers">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index + 1  }}</td>
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.establishDate }}</td>
                    <td>{{ props.item.contactNo }}</td>
                    <td class="justify-center layout px-0">
                        <router-link :to="{name: 'club',params: {id: props.item.id}}">
                        <v-icon small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <!--<v-icon @click="deleteClub(props.item)" small>
                            delete
                        </v-icon>-->
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Club Yet.
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
        name: "clubs",
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
                    {text: 'Name', sortable: false, value:'name'},
                    {text: 'Establish Date', sortable: true, value:'establishDate'},
                    {text: 'Contact Number', sortable: false, value:'contactNo'},
                    {text: 'Actions', sortable: false},
                ],
                selectedClub:{},
                snackbar:false,
                snackbarMsg:'',
                exportFields: {
                    'ID': 'id',
                    'Name': 'name',
                    'Establish Date': 'establishDate',
                    'Contact Number': 'contactNO',
                }
            }
        },
        created: function(){
            var app = this;
            this.$store.dispatch('fetchClubs').then(response => {
                this.clubs = this.$store.getters.getClubs
            });

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'loading','getClubs','getAlertMsg','getAlertType'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            queryStatus(){
                return this.$route.query.status;
            },
            excelFileName(){
                return 'Clublist '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {


        },
        methods:{
            editClub(item){

            },
            deleteClub(item){
                this.$root.$confirm('Delete ' +item.name,'Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteClub',item.id)
                                .then(response =>{

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
