<template>
  <section>
    <header>
      <h3 class="title">{{ blog.title }}</h3>
      <ul class="meta">
        <li class="date">{{ blog.created_at }}</li>
        <li v-if="blog.read_time">{{ blog.read_time }} minute read</li>
        <!-- <li>#rust</li>
        <li>#c</li> -->
      </ul>
    </header>
    <img
      v-if="blog.thumbnail"
      class="featured"
      :src="`http://localhost:8080/uploads/img/thumbnails/${blog.thumbnail}`"
    />
    <div class="content" v-html="compiledMarkdown"></div>
  </section>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import marked from "marked"
import BlogDataService from "@/services/BlogDataService"

interface Author {
  avatar: string | null
  username: string
}
interface Blog {
  content: string
}
export default defineComponent({
  data(): {
    blog: Blog
  } {
    return {
      blog: { content: "" }
    }
  },
  created() {
    this.fetchData()
  },
  watch: {
    $route: "fetchData"
  },
  computed: {
    compiledMarkdown(): string {
      if (this.blog) {
        return marked(this.blog.content)
      }
      return ""
    }
  },
  methods: {
    async fetchData() {
      const fetchedId = parseInt(this.$route.params.blogId as string)
      const { data: blog } = await BlogDataService.get(fetchedId)
      this.blog = blog
    }
  }
})
</script>

<style lang="scss" scoped>
section {
  padding: 64px 32px;
  margin: 15px auto;
  width: 768px;
}
header {
  margin-bottom: 32px;
  .title {
    font-size: 2rem;
  }
  .meta {
    li {
      display: inline list-item;
      color: #b3b3b3;
      &:not(:first-child)::before {
        margin-left: 5px;
        margin-right: 5px;
        color: #a09379;
        content: "·";
      }
    }
  }
}
img.featured {
  max-width: 680px;
  max-height: 382.5px;
  border-radius: 5px;
  border: 2px solid #a09379;
  margin: 64px auto;
  box-shadow: 0 20px 25px -5px #292b2f0a, 0 10px 10px -5px #292b2faa;
}
.content {
  font-family: "Source Serif Pro", serif;
  line-height: 1.7;
  font-size: 1.2rem;

  & > ul {
    list-style: disc;
    margin-left: 12px;
    padding: 15px;
    color: black;
  }
}
</style>
