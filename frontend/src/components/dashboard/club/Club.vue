<template>
    <v-container  >
        <v-layout row wrap align-center>
            <v-flex xs12 md9>
                <!--<v-card class="elevation-12">
                    <v-card-title>
                        <div>
                            <h3 class="headline">{{title}}</h3>

                        </div>
                    </v-card-title>
                    &lt;!&ndash;<v-flex>
                        <v-alert :type="alertType" dismissible v-model="alert">
                            {{ alertMsg }}
                        </v-alert>
                    </v-flex>&ndash;&gt;
                    <alert-box/>
                    <v-card-text>

                        <v-form ref="club" v-model="valid">
                            <v-container grid-list-md text-md-center>
                                <v-layout row wrap>

                                        <input type="hidden" v-model="club.id"/>
                                    <v-flex md12>
                                        <v-text-field
                                                name="name"
                                                label="Name of the club *"
                                                type="text"
                                                v-model="club.name"
                                                :rules="[v => !!v || 'Name is required']"
                                                md12
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex md12>
                                        <v-textarea
                                                name="description"
                                                label="Description of club"
                                                type="text"
                                                v-model="club.description"
                                        ></v-textarea>

                                    </v-flex>




                                    <v-flex md6 xs6>
                                        <v-text-field
                                                label="Contact N0"
                                                type="number"
                                                v-model="club.contactNo"
                                                :rules="[v => !!v || 'Contact is required']"
                                        >

                                        </v-text-field>
                                    </v-flex>
                                    <v-flex md6 xs6>
                                        <v-menu
                                                v-model="establishDateMenu"
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
                                                    v-model="club.establishDate"
                                                    label="Establishment Date"
                                                    readonly
                                            ></v-text-field>
                                            <v-date-picker v-model="club.establishDate" @input="establishDateMenu = false"></v-date-picker>
                                        </v-menu>
                                    </v-flex>
                                </v-layout>
                            </v-container>

                        </v-form>

                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>

                        <v-btn color="primary" :disabled="!valid || loading" @click="saveClub">Save
                            <v-icon v-if="loading">fas fa-circle-notch fa-spin</v-icon>
                        </v-btn>
                        <v-btn    @click="$router.go(-1)">Cancel

                        </v-btn>

                    </v-card-actions>

                </v-card>-->

                <router-view></router-view>
            </v-flex>
            <v-flex md3>
                <v-layout column>
                    <v-flex xs12 md3 v-if="getClub.id">
                        <div class="text-md-center">


                            <image-input  @input="onFileChanged" uploadFieldName="file">
                                <div slot="activator">
                                    <v-avatar size="150px" v-ripple v-if="!getClub.logo" class="grey lighten-3 mb-3">
                                        <span>Click to add Logo</span>
                                    </v-avatar>
                                    <v-avatar size="150px" v-ripple v-else class="mb-3">
                                        <img :src="getClub.logo | downloadUrl " alt="avatar">
                                    </v-avatar>
                                </div>
                            </image-input>

                            <div class="headline">{{getClub.name}} </div>
                            <div class="headline" v-if="getClub.year"><v-chip>{{getClub.year.title}}</v-chip> </div>
                        </div>
                    </v-flex>
                    <v-flex md3 >
                        <div class="text-md-center">
                            <v-btn :to="{name: 'yearList'}">Year List</v-btn>

                        </div>
                    </v-flex>
                </v-layout>

            </v-flex>


        </v-layout>

    </v-container>
</template>

<script>
    import { mapGetters} from 'vuex';
    import AlertBox from '../../shared/AlertBox';
    import ImageInput from '../../shared/ImageInput'

    export default {
        name: "Club",
        props: ['msg','id'],
        components: {
            'alert-box': AlertBox,
            ImageInput
        },
        data() {
            return {
                alert: false,
                valid: true,
                establishDateMenu: false,
                club: {
                    id: '',
                    name: '',
                    establishDate: '',
                    logo: '',
                    contactNo: '',
                    fbUrl: ''
                }
            }
        },
        created: function(){

        },
        mounted(){

        },
        methods:{
            onFileChanged(data){
                this.axios.post('/club/'+this.getClub.id+'/image',data.formData)
                    .then(response=> {
                        this.club.logo = response.data.fileName;
                        this.$store.dispatch('setClubLogo',response.data.fileName);
                        this.$store.dispatch('showSuccessSnackbar','Logo uploaded Successfully')
                    })
            }
        },
        computed: {
            ...mapGetters([
                'loading','getClub','getYears','getYear'
            ]),
            loading(){
                return this.$store.getters.loading;
            },
        }
    }
</script>

<style scoped>

</style>
