<template>
  <router-link :to="{ name: 'Editor' }">
    <button>
      <span class="text-sm">Write ~!</span>
    </button>
  </router-link>
</template>

<script lang="ts">
import { defineComponent } from "vue"
// import Icon from "@/components/Icon.vue"

export default defineComponent({
  name: "WriteButton"
  // components: { Icon }
})
</script>
<style lang="scss" scoped>
button {
  border-radius: 4px;
  height: 32px;
  padding: 0 16px;
  color: #ffffff;
  font-weight: bold;
  font-family: "IBM Plex Mono", monospace;
  font-weight: 500;
  background-image: linear-gradient(45deg, #49bc79, #00e59b, #49bc79);
  background-size: 200%;
  background-position: 0 0;
  transition: background ease-in-out 0.2s;
  display: flex;
  align-items: center;
  &:hover {
    background-position: 100% 100%;
  }
}
</style>
