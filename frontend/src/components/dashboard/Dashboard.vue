<template>
  <v-container fluid>
    <v-slide-y-transition mode="out-in">
      <v-layout column align-center>
        <v-avatar
         size="250">
        <img src="@/assets/smj_intro_pic.jpg" alt="Swamji and Maharajji" class="mb-5">
        </v-avatar>
        <blockquote>
          &#8220;{{ quote }}&#8221;
          <footer>
            <small>
              <em>&mdash;{{ author}}</em>
            </small>
          </footer>
        </blockquote>
      </v-layout>
    </v-slide-y-transition>
  </v-container>
</template>


<script>
export default {
  name: 'dashboard',
  props: {
    msg: String
  },
    data() {
      return {
          quote: "Remember God  Constantly, don't forget  Him even for a moment.",
          author: "Jagadguru Kripalu Ji Maharaj"
      }
    },
    created: function(){
    },
    mounted(){
      this.getTodayQuotes();
    },
    methods: {
      getTodayQuotes(){
          var app = this;
          this.axios.get("http://backend.sushilgc.com.np/quotes")
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
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
