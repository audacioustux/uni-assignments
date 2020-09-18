<template>
  <TopNav />
  <router-view></router-view>
</template>

<script lang="ts">
import "@/assets/scss/index.scss"
import TopNav from "@/components/TopNav.vue"
import { defineComponent } from "vue"

export default defineComponent({
  name: "App",
  components: { TopNav }
})
</script>

<style>
body {
  background-color: #36393f;
  font-family: "IBM Plex Mono", monospace;
  color: #fafafa;
}
button:focus {
  outline: 0;
}
@import url("https://unpkg.com/tailwindcss@1.7.5/dist/base.css");
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&display=swap");
@import url("https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,400;0,600;1,400&display=swap");
</style>
