import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router"
import Home from "@/views/Home.vue"
import Blog from "@/views/Blog.vue"
import Signup from "@/views/Signup.vue"
import Login from "@/views/Login.vue"
import UserDataService from "@/services/UserDataService"
import store from "@/store/reactiveStore"

const routes: Array<RouteRecordRaw> = [
  { path: "/", name: "Home", component: Home },
  { path: "/blog/:blogId", name: "Blog", component: Blog },
  { path: "/signup", name: "Signup", component: Signup },
  { path: "/login", name: "Login", component: Login },
  {
    path: "/logout",
    name: "Logout",
    redirect: () => {
      UserDataService.logout()
      store.setLoggedOut()
      return "/"
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
