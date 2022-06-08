<template>
    <!--<v-app>
      <component v-bind:is="layout"></component>

    </v-app>-->
    <app-layout></app-layout>
</template>

<script>
import AppLayout from './layouts/AppLayout'
import SimpleLayout from './layouts/SimpleLayout'

export default {
  computed: {
      layout(){
          return this.$store.getters.layout
      }
  },
    components: {
      'app-layout': AppLayout,
        'simple-layout': SimpleLayout
    }
}
</script>
