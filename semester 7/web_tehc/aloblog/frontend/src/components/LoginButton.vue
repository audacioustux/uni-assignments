<template>
  <button>
    <svg
      fill="currentColor"
      class="inline mr-1"
      viewBox="0 0 24 24"
      width="18"
      height="18"
    >
      <path :d="require('@mdi/js').mdiLogin" />
    </svg>
    <span class="text-sm">Sign In</span>
  </button>
</template>

<script lang="ts">
import { defineComponent } from "vue"
// import Icon from "@/components/Icon.vue"

export default defineComponent({
  name: "Button"
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
  text-transform: uppercase;
  background-image: linear-gradient(45deg, #3e5151, #a09379, #3e5151);
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
