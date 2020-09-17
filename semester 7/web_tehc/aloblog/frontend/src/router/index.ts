import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router"
import Home from "@/views/Home.vue"
import Blog from "@/views/Blog.vue"
import Signup from "@/views/Signup.vue"
import Login from "@/views/Login.vue"

const routes: Array<RouteRecordRaw> = [
  { path: "/", name: "Home", component: Home },
  { path: "/blog/:blogId", name: "Blog", component: Blog },
  { path: "/signup", name: "Signup", component: Signup },
  { path: "/login", name: "Login", component: Login }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
