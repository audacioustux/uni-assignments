// import { createStore } from "vuex"
// import Cookies from "js-cookie"
// import UserDataService from "@/services/UserDataService"

// export default createStore({
//   state: {
//     sid: Cookies.get("sid"),
//     user: null
//   },
//   mutations: {},
//   actions: {
//     async getUser(ctx) {
//       const { data: user } = await UserDataService.whoami()
//       ctx.state.user = user
//     }
//   },
//   modules: {},
//   getters: {
//     isLoggedIn: state => !!state.sid,
//     currentUser(state) {
//       return state.user
//     }
//   }
// })
