<template>
  <input placeholder="[Search] press [/] to focus" />
</template>

<script lang="ts">
import { defineComponent } from "vue"
export default defineComponent({
  name: "SearchInput"
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
