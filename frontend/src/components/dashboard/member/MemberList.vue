<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Members</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat to="/dashboard/member/create">Create a Members</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>

                        <download-excel
                                :data="getMembers"
                                :fields="exportFields"
                                :name="excelFileName"
                        class="height-inherit">
                            <v-btn flat>Download as Excel  &nbsp; <v-icon>fa-file-excel</v-icon></v-btn>
                        </download-excel>


                </v-toolbar-items>

            </v-toolbar>
            <alert-box  />
            <v-data-table
                    :items="getMembers"
                    :headers="headers">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index + 1  }}</td>
                    <td>{{ props.item.firstName || ''}} {{ props.item.lastName || '' }}</td>
                    <td>{{ props.item.email }}</td>
                    <td>{{ props.item.mobileNumber }}</td>
                    <td><span v-if="props.item.role">{{ props.item.role.id + '|'+ props.item.role.title}}</span></td>
                    <td><span v-if="props.item.club">{{ props.item.club.name}}</span></td>
                    <td class="justify-center layout px-0">
                        <router-link :to="{name: 'member',params: {id: props.item.id}}">
                        <v-icon small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <!--<v-icon @click="deleteMember(props.item)" small>
                            delete
                        </v-icon>-->
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Member Yet.
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
                    {text: 'Name', sortable: true, value:'name'},
                    {text: 'Email', sortable: true, value:'email'},
                    {text: 'Mobile Number', sortable: false, value:'mobileNumber'},
                    {text: 'Role', sortable: true, value:'role'},
                    {text: 'Club', sortable: true, value:'club'},
                    {text: 'Actions', sortable: false}
                ],
                selectedMember:{},
                snackbar:false,
                snackbarMsg:'',
                exportFields: {
                    'ID': 'id',
                    'Name': 'name',
                    'Email': 'email',
                    'Mobile Number': 'mobileNumber',
                    'Role': {
                        field:'role',
                        callback:(value) => value!=null?value.id+ '|'+value.title:''
                    }
                }
            }
        },
        created: function(){
            var app = this;
            this.$store.dispatch('fetchMembers').then(response => {
                this.clubs = this.$store.getters.getMembers
            });

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'loading','getMembers','getAlertMsg','getAlertType'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            queryStatus(){
                return this.$route.query.status;
            },
            excelFileName(){
                return 'Memberlist '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {


        },
        methods:{
            editMember(item){

            },
            deleteMember(item){
                this.$root.$confirm('Delete ' +item.name,'Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteMember',item.id)
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
