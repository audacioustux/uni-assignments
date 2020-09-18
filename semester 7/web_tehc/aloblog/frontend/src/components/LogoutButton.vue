<template>
  <router-link :to="{ name: 'Logout' }">
    <button>
      <svg
        fill="currentColor"
        class="inline mr-1"
        viewBox="0 0 24 24"
        width="18"
        height="18"
      >
        <path :d="require('@mdi/js').mdiLogout" />
      </svg>
      <span class="text-sm">Log Out</span>
    </button>
  </router-link>
</template>

<script lang="ts">
import { defineComponent } from "vue"
// import Icon from "@/components/Icon.vue"

export default defineComponent({
  name: "LogoutButton"
  // components: { Icon }
})
</script>
<style lang="scss" scoped>
button {
  border-radius: 4px;
  height: 32px;
  padding: 0 16px;
  color: #a09379;
  font-weight: bold;
  font-family: "IBM Plex Mono", monospace;
  font-weight: 500;
  display: flex;
  align-items: center;
  transition: color 0.2s;
  &:hover {
    color: #ffffff;
  }
}
</style>
