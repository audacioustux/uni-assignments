<template>
  <svg
    viewBox="0 0 24 24"
    :fill="fill"
    :height="size"
    :width="size"
    class="icon"
  >
    <title v-if="title">{{ title }}</title>
    <path :d="icon"></path>
  </svg>
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
  name: "Icon",
  props: {
    name: String,
    title: String,
    size: {
      type: [String, Number],
      default: 24
    },
    fill: {
      type: String,
      default: "currentColor"
    }
  }
})
</script>
<style lang="scss" scoped></style>
