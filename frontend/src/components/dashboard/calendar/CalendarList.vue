<template>
    <v-container >
        <v-card class="elevation-12">
            <v-toolbar color="white">
                <v-toolbar-title>Create/Edit/Delete Calendars</v-toolbar-title>
                <v-spacer></v-spacer>

                <v-toolbar-items>
                    <v-btn flat to="/dashboard/calendar/create">Create a Calendar</v-btn>
                </v-toolbar-items>
                <v-toolbar-items>

                </v-toolbar-items>

            </v-toolbar>
            <alert-box  />
            <v-data-table
                    :items="getCalendars"
                    :headers="headers">
                <template slot="items" slot-scope="props">
                    <td>{{ props.index + 1  }}</td>
                    <td><a :href="props.item.url">{{props.item.title}}</a></td>
                    <td><v-chip v-if="props.item.running" color="green">running</v-chip></td>
                    <td class="justify-center">
                        <router-link :to="{name: 'calendar',params: {id: props.item.id}}">
                        <v-icon small class="mr-2" @click="" >
                            edit
                        </v-icon>
                        </router-link>
                        <v-icon @click="deleteCalendar(props.item)" small>
                            delete
                        </v-icon>
                    </td>
                </template>

                <template slot="no-data">
                    <v-alert :value="true" color="error" icon="warning">
                        Sorry, No Calendars Yet.
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
        name: "calendars",
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
                    {text: 'Running', sortable: true, value:'month'},
                    {text: 'Actions', sortable: false},
                ],
                selectedClub:{},
                snackbar:false,
                snackbarMsg:'',

            }
        },
        created: function(){
            var app = this;
            this.$store.dispatch('fetchCalendars').then(response => {
            });

        },
        mounted(){

        },
        computed: {
            ...mapGetters([
                'loading','getCalendars','getAlertMsg','getAlertType'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
            queryStatus(){
                return this.$route.query.status;
            },
            excelFileName(){
                return 'Calendarlist '+ new Date().toDateString()+'.xlsx'
            }
        },
        watch: {


        },
        methods:{

            deleteCalendar(item){
                this.$root.$confirm('Delete '+item.title,'Are you sure?',{color:'red'})
                    .then((confirm) => {
                        if(confirm){
                            //if true, call delete end point
                            this.$store.dispatch('deleteCalendar',item.id)
                                .then(response =>{
                                    this.$store.dispatch('showSuccessSnackbar',response.data.message);
                                    this.$store.dispatch('fetchCalendars');

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
