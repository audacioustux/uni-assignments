import { reactive } from "vue"
import Cookies from "js-cookie"

// export default reactive({
//   isLoggedIn: !!Cookies.get("sid")
// })
const store = {
  state: reactive({
    isLoggedIn: !!Cookies.get("sid")
  }),

  setLogged() {
    this.state.isLoggedIn = true
  },

  setLoggedOut() {
    this.state.isLoggedIn = false
  }
}

export default store
