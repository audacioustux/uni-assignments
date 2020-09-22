<template>
  <svg version="1.1" viewBox="0 0 220 220" xmlns="http://www.w3.org/2000/svg">
    <g transform="translate(10 52)" stroke-width="1">
      <path
        transform="scale(1,-1)"
        d="m133.3-29.157h-33.304l16.652-28.843z"
        fill="#f56565"
      />
      <path d="m100 86.843h-33.305l16.652-28.843z" fill="#48bb78" />
      <path d="m133.3 86.843h-33.304l16.652-28.843z" fill="#4d4d4d" />
      <path
        transform="scale(1,-1)"
        d="m183.26-58h-33.305l16.652-28.843z"
        fill="#333"
      />
      <path
        transform="scale(1,-1)"
        d="m116.65-58h-33.305l16.652-28.843z"
        fill="#1a1a1a"
      />
      <path
        transform="scale(1,-1)"
        d="m133.3-86.843h-33.304l16.652-28.843z"
        fill="#333"
      />
      <path
        transform="scale(1,-1)"
        d="m149.96-58h-33.304l16.652-28.843z"
        fill="#4d4d4d"
      />
      <path d="m166.61 86.843h-33.305l16.652-28.843z" fill="#333" />
      <path
        transform="scale(1,-1)"
        d="m166.61-86.843h-33.305l16.652-28.843z"
        fill="#333"
      />
      <path d="m149.96 115.69h-33.304l16.652-28.843z" fill="#1a1a1a" />
      <path d="m100 29.157h-33.305l16.652-28.843z" fill="#4d4d4d" />
      <path
        transform="scale(1,-1)"
        d="m83.348-.31494-33.305-1.5e-7 16.652-28.843z"
        fill="#333"
      />
      <path
        transform="scale(1,-1)"
        d="m66.696-29.157h-33.305l16.652-28.843z"
        fill="#333"
      />
      <path
        transform="scale(1,-1)"
        d="m100-29.157h-33.305l16.652-28.843z"
        fill="#4d4d4d"
      />
      <path d="m83.348 58h-33.305l16.652-28.843z" fill="#4d4d4d" />
      <path d="m199.91 29.157h-33.305l16.652-28.843z" fill="#333" />
      <path d="m166.61 29.157h-33.305l16.652-28.843z" fill="#4d4d4d" />
      <path d="m149.96 58h-33.305l16.652-28.843z" fill="#4d4d4d" />
      <path d="m116.65 58h-33.304l16.652-28.843z" fill="#1a1a1a" />
      <path d="m50.043 58h-33.305l16.652-28.843z" fill="#333" />
      <path
        transform="scale(1,-1)"
        d="m183.26-.31494-33.305-1.5e-7 16.652-28.843z"
        fill="#4d4d4d"
      />
      <path d="m66.696 29.157h-33.305l16.652-28.843z" fill="#333" />
      <path d="m183.26 58h-33.305l16.652-28.843z" fill="#333" />
      <path
        transform="scale(1,-1)"
        d="m166.61-29.157h-33.305l16.652-28.843z"
        fill="#4d4d4d"
      />
      <path
        transform="scale(1,-1)"
        d="m199.91-29.157h-33.305l16.652-28.843z"
        fill="#333"
      />
      <path
        transform="scale(1,-1)"
        d="m83.348-58h-33.305l16.652-28.843z"
        fill="#4d4d4d"
      />
      <path d="m66.696 86.843h-33.305l16.652-28.843z" fill="#4d4d4d" />
      <path
        transform="scale(1,-1)"
        d="m50.043-58h-33.305l16.652-28.843z"
        fill="#333"
      />
      <path
        transform="scale(1,-1)"
        d="m33.391-86.843h-33.305l16.652-28.843z"
        fill="#1a1a1a"
      />
      <path
        transform="scale(1,-1)"
        d="m66.696-86.843h-33.305l16.652-28.843z"
        fill="#4d4d4d"
      />
      <path d="m50.043 115.69h-33.305l16.652-28.843z" fill="#333" />
      <path d="m33.391 86.843h-33.305l16.652-28.843z" fill="#333" />
    </g>
  </svg>
</template>

<script lang="ts">
import { defineComponent } from "vue"
export default defineComponent({
  name: "Logo"
})
</script>

<style lang="scss" scoped>
svg {
  cursor: pointer;
  border-radius: 100%;
  background-color: #202225;
  padding: 5px;
  transform: translateY(24px);
  transition: border 0.2s;
  box-shadow: 0 20px 25px -5px #292b2f0a, 0 10px 10px -5px #292b2faa;
  transition: box-shadow 0.2s;
  &:hover {
    box-shadow: 0 0 0 2px #a09379aa;
  }
}
g {
  stroke: white;
  animation: hueStrokeTransition 2s cubic-bezier(0.6, -0.28, 0.735, 0.045)
    infinite alternate;
  animation-delay: 1s;
  stroke-linejoin: bevel;
}
@keyframes hueStrokeTransition {
  0% {
    stroke: transparent;
  }
  100% {
    stroke: #fff;
  }
}
</style>
