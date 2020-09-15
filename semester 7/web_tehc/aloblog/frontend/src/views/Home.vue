<template>
  <header class="flex bg-white">
    <div class="left">
      <SearchInput type="text" size="32" />
    </div>
    <div class="middle">
      <Logo height="48" />
    </div>
    <div class="right">
      <LoginButton />
    </div>
  </header>
  <section>
    <div class="grid">
      <PreviewCard
        v-for="blog in blogs"
        :key="blog.id"
        :title="blog.title"
        :content="blog.content"
        :author="blog.author"
        :numComments="blog.numComments"
      />
    </div>
  </section>
</template>
<script lang="ts">
import LoginButton from "@/components/LoginButton.vue"
import Logo from "@/components/Logo.vue"
import SearchInput from "@/components/SearchInput.vue"
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
  components: { LoginButton, Logo, SearchInput, PreviewCard },
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
    window.onscroll = () => {
      const bottomOfWindow =
        document.documentElement.scrollTop + window.innerHeight ===
        document.documentElement.offsetHeight

      if (bottomOfWindow) {
        this.retriveBlogs()
      }
    }
  }
})
</script>
<style lang="scss" scoped>
header {
  height: 48px;
  border: 1px solid bottom;
  background-color: #2f3136;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 15px;

  margin-bottom: 24px;
  .left,
  .middle {
    flex: 1;
  }
}

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
