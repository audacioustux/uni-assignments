<template>
  <Home />
</template>

<script lang="ts">
import "@/assets/scss/index.scss"
import Home from "@/views/Home.vue"
import { defineComponent } from "vue"

export default defineComponent({
  name: "App",
  components: { Home }
})
</script>
<style>
body {
  background-color: #36393f;
}
@import url("https://unpkg.com/tailwindcss@1.7.5/dist/base.css");
@import url("https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@500&display=swap");
</style>
