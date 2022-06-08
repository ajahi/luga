<template>
    <v-container fluid>
        <v-slide-y-transition mode="out-in">
            <v-layout column align-center>
                <v-avatar
                        size="250">
                    <img src="@/assets/logo.png" alt="Logo " class="mb-5">
                </v-avatar>

            </v-layout>
        </v-slide-y-transition>
    </v-container>
</template>

<script>
    export default {
        name: "Home",
        data: () => ({
           quote: '',
           author: ''
        }),
        methods: {
            getTodayQuotes(){
                var app = this;
                this.axios.get("http://dreamsys.com.np/divinequotes/index.php/site/get_quotes/",{
                    'Access-Control-Allow-Origin':'*'
                })
                    .then(response => {
                        let quotes = response.data;
                        const idx = Math.floor(Math.random() *quotes.length);
                        app.quote = quotes[idx].quote;
                        app.author = quotes[idx].author;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        mounted(){
            // this.getTodayQuotes();
        }
    }
</script>

<style scoped>

</style>
