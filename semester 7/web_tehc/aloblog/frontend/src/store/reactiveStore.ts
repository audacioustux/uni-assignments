import { reactive } from "vue"
import Cookies from "js-cookie"

import BlogDataService from "@/services/BlogDataService"
import UserDataService from "@/services/UserDataService"

interface User {
  username: string
  author: string
}

interface BlogRes {
  id: number
  title: string
  content: string
  user_id: number
  thumbnail: string | null
  numComments: number
  author: User
}

const store = {
  state: reactive({
    isLoggedIn: !!Cookies.get("sid"),
    routeName: "/",
    blogs: [] as Array<BlogRes>,
    cursor: null as number | null,
    q: null as string | null
  }),

  setLogged() {
    this.state.isLoggedIn = true
  },

  setLoggedOut() {
    this.state.isLoggedIn = false
  },

  retriveBlogs() {
    BlogDataService.getAll(
      this.state.cursor,
      this.state.q ? this.state.q : undefined
    ).then(async ({ data: blogs }: { data: Array<BlogRes> }) => {
      await Promise.all(
        blogs.map(async (blog: BlogRes) => {
          const userId = blog.user_id
          const { data: author } = await UserDataService.get(userId)
          const { data: numComments } = await BlogDataService.commentCount(
            blog.id
          )
          blog.author = author
          blog.numComments = numComments
        })
      )
      this.state.blogs = [...this.state.blogs, ...blogs]
      if (blogs[blogs.length - 1]) {
        this.state.cursor = blogs[blogs.length - 1].id
      }
    })
  },

  search(q: string) {
    this.state.blogs = []
    this.state.cursor = null
    this.state.q = q
    this.retriveBlogs()
  }
}

export default store
