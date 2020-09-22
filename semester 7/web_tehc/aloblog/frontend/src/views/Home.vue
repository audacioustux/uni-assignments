<template>
  <section>
    <div class="grid">
      <PreviewCard
        v-for="blog in blogs"
        :key="blog.id"
        :id="parseInt(blog.id)"
        :title="blog.title"
        :content="blog.content"
        :author="blog.author"
        :numComments="blog.numComments"
        :thumbnail="blog.thumbnail"
      />
    </div>
  </section>
</template>
<script lang="ts">
import PreviewCard from "@/components/PreviewCard.vue"
import sharedState from "@/store/reactiveStore"

import { defineComponent } from "vue"

interface User {
  username: string
  author: string
}
// TODO: should be in service
interface BlogRes {
  id: number
  title: string
  content: string
  user_id: number
  thumbnail: string | null
  numComments: number
  author: User
}

export default defineComponent({
  name: "Home",
  components: { PreviewCard },
  methods: {
    scroll() {
      const bottomOfWindow =
        document.documentElement.scrollTop + window.innerHeight ===
        document.documentElement.offsetHeight

      if (bottomOfWindow) {
        sharedState.retriveBlogs()
      }
      console.log("paginate")
    }
  },
  data() {
    return sharedState.state
  },
  mounted() {
    sharedState.retriveBlogs()
    window.addEventListener("scroll", this.scroll)
  },
  unmounted() {
    window.removeEventListener("scroll", this.scroll)
  }
})
</script>
<style lang="scss" scoped>
section {
  --num-cards: 4;
  --cards-margin: 24px;
  padding: 54px 30px;
  display: grid;
  .grid {
    display: grid;
    grid-template-columns: repeat(var(--num-cards), 1fr);
    grid-gap: var(--cards-margin);
    justify-content: center;
  }
}
</style>
