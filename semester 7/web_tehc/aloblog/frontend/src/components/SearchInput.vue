<template>
  <input placeholder="[Search] ..." @change="search" />
</template>

<script>
import { defineComponent } from "vue"
import sharedState from "@/store/reactiveStore"

export default defineComponent({
  name: "SearchInput",
  methods: {
    search(e) {
      sharedState.search(e.target.value)
    }
  }
})
</script>
<style lang="scss" scoped>
input {
  background-color: #40444b;
  color: #b9bbbe;
  border-radius: 3px;
  padding: 0 15px;
  line-height: 32px;
  font-size: small;
  font-family: "IBM Plex Mono", monospace;
  font-weight: 500;
}
</style>
