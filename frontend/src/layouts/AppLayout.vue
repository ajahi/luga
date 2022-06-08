<template>
    <div id="appRoot">
<template v-if="$route.meta.requiresAuth">
    <v-app id="inspire" >
        <v-navigation-drawer
                fixed
                :clipped="$vuetify.breakpoint.mdAndUp"
                app
                v-model="drawer"

        >
            <v-list dense>
                <template v-for="item in items">
                    <v-layout
                            row
                            v-if="item.heading"
                            align-center
                            :key="item.heading"
                    >
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-flex>
                        <v-flex xs6 class="text-xs-center">
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-flex>
                    </v-layout>
                    <v-list-group
                            v-else-if="item.children"
                            v-model="item.model"
                            :key="item.text"
                            :prepend-icon="item.model ? item.icon : item['icon-alt']"
                            append-icon=""
                    >
                        <v-list-tile slot="activator">
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ item.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile
                                v-for="(child, i) in item.children"
                                :key="i"
                                @click=""
                                :to="child.action"
                        >
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>{{ child.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    {{ child.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                    <v-list-tile v-else  :to="item.action" :key="item.text">
                        <v-list-tile-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar
                color="blue darken-3"
                dark
                app
                :clipped-left="$vuetify.breakpoint.mdAndUp"
                fixed

        >
            <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                <span class="hidden-sm-and-down">Divine MIS</span>
            </v-toolbar-title>
            <!--<v-text-field
                    flat
                    solo-inverted
                    prepend-icon="search"
                    label="Search"
                    class="hidden-sm-and-down"
            ></v-text-field>-->
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>apps</v-icon>
            </v-btn>
            <v-menu bottom left v-if="isAuthenticated">
                <v-btn
                        slot="activator"
                        dark
                        icon
                >
                    <v-avatar size="30px" v-if="getProfileImage"><img :src="getProfileImage | downloadUrl"></v-avatar>
                     <v-avatar v-if="!getProfileImage"> <v-icon>account_circle</v-icon></v-avatar>

                </v-btn>
                <v-card>
                    <v-list class="pa-0">
                        <v-list-tile avatar>
                            <v-list-tile-avatar v-if="getProfileImage">
                                <img :src="getProfileImage | downloadUrl">
                            </v-list-tile-avatar>

                            <v-list-tile-content>
                                <v-list-tile-title v-if="getProfile.name">{{ getProfile.name}}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ getProfile.email}}</v-list-tile-sub-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                    <v-divider></v-divider>
                    <v-list>
                        <v-list-tile @click="goToProfile">
                            Profile
                        </v-list-tile>

                    </v-list>
                    <v-divider></v-divider>
                    <v-list>
                        <v-list-tile @click="userLogout">
                            <v-icon>exit_to_app</v-icon>
                            Logout

                        </v-list-tile>
                    </v-list>


                </v-card>

            </v-menu>
            <v-tooltip v-else>
            <v-btn slot="activator"  icon @click="userLogin">
                <v-icon >exit_to_app</v-icon>
            </v-btn>
            <span>Log in</span>
            </v-tooltip>

        </v-toolbar>
        <v-content>
            <router-view></router-view>
        </v-content>

        <!--reusable-->
        <confirm ref="confirm"> </confirm>
    </v-app>
</template>

<template v-else>
    <transition>
        <keep-alive>
            <v-app>
            <router-view></router-view>
            </v-app>
        </keep-alive>
    </transition>

</template>
        <v-snackbar
                :timeout="3000"
                bottom
                right
                :color="getSnackbar.color"
                v-model="getSnackbar.show"
        >
            {{ getSnackbar.text }}
            <v-btn dark flat @click.native="getSnackbar.show = false" icon>
                <v-icon>close</v-icon>
            </v-btn>
        </v-snackbar>
    </div>
</template>

<script>

    import Confirm from "../components/shared/Confirm";
    import { mapGetters} from 'vuex';

    export default {
        name: 'App',
        components: {Confirm},
        data: () => ({

            drawer: null,
            items: [
                { icon: 'person', text: 'Profile',
                    action:'/dashboard/profile'
                    /*children: [
                        { icon: 'list', text: 'Coming soon'},

                    ]*/
                },
                {   icon: 'keyboard_arrow_up',
                    'icon-alt': 'keyboard_arrow_down',
                    text: 'Categories ',
                    children: [
                        {icon:'fa-plus', text:'Create a Category', action:'/dashboard/category/create'},
                        {icon:'fa-list-ul', text:'Categories', action:'/dashboard/categories'},
                    ]
                },{   icon: 'keyboard_arrow_up',
                    'icon-alt': 'keyboard_arrow_down',
                    text: 'Tags ',
                    children: [
                        {icon:'fa-plus', text:'Create a Tag', action:'/dashboard/tag/create'},
                        {icon:'fa-list-ul', text:'Tags', action:'/dashboard/tags'},
                    ]
                },
                {   icon: 'keyboard_arrow_up',
                    'icon-alt': 'keyboard_arrow_down',
                    text: 'Post ',
                    children: [
                        {icon:'fa-plus', text:'Create a Post', action:'/dashboard/post/create'},
                        {icon:'fa-list-ul', text:'Posts', action:'/dashboard/posts'},
                    ]
                },
                {   icon: 'keyboard_arrow_up',
                    'icon-alt': 'keyboard_arrow_down',
                    text: 'Calendar ',
                    children: [
                        {icon:'fa-plus', text:'Create a Calendar', action:'/dashboard/calendar/create'},
                        {icon:'fa-list-ul', text:'Calendar list', action:'/dashboard/calendars'},
                    ]
                },




            ],

        }),
        props: {
            source: String
        },
        created: function(){

        },
        mounted() {
            if(this.$route.meta.requiresAuth)
                this.$root.$confirm = this.$refs.confirm.open;
        },
        computed: {
            ...mapGetters([
                'getSnackbar'
            ]),
            appTitle(){
                return this.$store.state.appTitle
            },
            isAuthenticated(){
                return this.$store.getters.isLoggedIn;
            },
            getProfileImage(){
                return this.$store.state.profile.profile.avatar;
            },
            getProfile(){
                return this.$store.state.profile.profile;
            },


        },
        methods: {
            userLogout(){
                this.$store.dispatch('logout');
                this.$store.dispatch('showSuccessSnackbar',"Logout successfully")

            },
            userLogin(){
                this.$router.push('/signin');
            },
            goToProfile(){
                this.$router.push('/dashboard/profile');
            }
        }
    }
</script>
