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
      />
    </div>
  </section>
</template>
<script lang="ts">
import PreviewCard from "@/components/PreviewCard.vue"
import BlogDataService from "@/services/BlogDataService"
import UserDataService from "@/services/UserDataService"

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
  numComments: number
  author: User
}

export default defineComponent({
  name: "Home",
  components: { PreviewCard },
  methods: {
    retriveBlogs() {
      BlogDataService.getAll(this.cursor).then(
        async ({ data: blogs }: { data: Array<BlogRes> }) => {
          await Promise.all(
            blogs.map(async (blog: BlogRes) => {
              const userId = blog.user_id
              const { data: author } = await UserDataService.get(userId)
              const { data: numComments } = await BlogDataService.commentCount(
                userId
              )
              blog.author = author
              blog.numComments = numComments
            })
          )
          this.blogs = [...this.blogs, ...blogs]
          this.cursor = blogs[blogs.length - 1].id
          console.log(this.cursor)
        }
      )
    },
    scroll() {
      const bottomOfWindow =
        document.documentElement.scrollTop + window.innerHeight ===
        document.documentElement.offsetHeight

      if (bottomOfWindow) {
        this.retriveBlogs()
      }
    }
  },
  data(): { cursor: number | null; blogs: Array<BlogRes> } {
    return {
      cursor: null,
      blogs: []
    }
  },
  mounted() {
    this.retriveBlogs()
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
  padding: 30px 30px;
  display: grid;
  .grid {
    display: grid;
    grid-template-columns: repeat(var(--num-cards), 1fr);
    grid-gap: var(--cards-margin);
    justify-content: center;
  }
}
</style>
