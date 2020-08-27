import { createApp } from "vue"
import App from "./App.vue"
import "./registerServiceWorker"
import router from "./router"
import store from "./store"
import VueAxios from "vue-axios"

createApp(App)
  .use(VueAxios)
  .use(store)
  .use(router)
  .mount("#app")
