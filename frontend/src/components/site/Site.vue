<template>
    <v-container fluid>
        <v-layout row wrap align-center>
            <v-flex xs12 md4>
                <div class="text-xs-center">
                    <v-icon size="125px">text_format</v-icon>
                    <div class="headline"><span style="font-weight:bold">Afnopan</span></div>
                    <div class="subheading text-xs-center grey--text pt-1 pb-3">Afno manxe afnai nai hunxa</div>
                    <v-layout justify-space-between>
                        <router-link to="/" class="body-2">Home</router-link>
                        <router-link to="/signin" class="body-2">Login</router-link>
                        <router-link to="#" class="body-2">About us</router-link>
                        <router-link to="/business" class="body-2">Business</router-link>
                    </v-layout>
                </div>
            </v-flex>
            <v-flex xs12 md5 offset-md2>
                <div v-for="business in getBusinesses" :key="business.id">
                    <v-container>
                        <v-card class="my-3" hover>

                            <v-img v-if="business.imgUrl"
                                   class="white--text"
                                   height="170px"
                                   :src="business.imgUrl"
                            >

                            </v-img>


                            <v-carousel>
                                <v-carousel-item
                                        v-for="(item,i) in business.gallerySet"
                                        :key="i"
                                        :src="getServerUrl+'/downloadFile/'+item.imageUrl"

                                >

                                </v-carousel-item>
                            </v-carousel>

                            <v-card-title primary-title>

                                <div>
                                    <v-layout justify-space-between row>
                                        <h3 class="headline mb-0">{{ business.name}} </h3>
                                        <v-spacer></v-spacer>


                                    </v-layout>

                                    <div class="quillWrapper">
                                        <div class="ql-container ql-snow no-border" >
                                            <div class="ql-editor">
                                                <div v-html="business.description"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <vue-editor style="display: none;" :editorToolbar="noToolbar" v-model="business.description" :disabled="true"></vue-editor>


                                </div>
                            </v-card-title>
                            <v-card-actions>
                                <v-label> {{business.phone}}</v-label>
                                <v-spacer></v-spacer>
                                <a v-bind:href=" business.website"> {{ business.website}}</a>

                                <v-spacer></v-spacer>
                                <v-rating v-model="business.rating" ready-only></v-rating>
                                <!--<v-btn flat class="blue&#45;&#45;text">Read More</v-btn>-->
                            </v-card-actions>
                        </v-card>
                    </v-container>
                </div>
            </v-flex>
        </v-layout>

    </v-container>
</template>

<style scoped>
    .no-border{
        border: 0px !important;
    }

</style>

<script>
    import {mapGetters} from 'vuex';
    import {VueEditor} from 'vue2-editor'

    export default {
        components: {
            VueEditor
        },
        data() {
            return {
                dialog: false,
                name: 'Your Logo',
                noToolbar: [],
                items: [
                    {
                        src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg'
                    },
                    {
                        src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg'
                    },
                    {
                        src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg'
                    },
                    {
                        src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg'
                    }
                ]

            }
        },

        created: function () {
            console.log('created');
            this.$store.commit('setLayout', 'simple-layout')
            this.$store.dispatch('fetchBusinesses').then(response => {

            })

        },
        computed: {
            ...mapGetters([
                'getBusinesses','getServerUrl'
            ])
        }
    }
</script>