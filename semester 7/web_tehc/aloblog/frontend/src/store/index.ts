import { createStore } from "vuex"

export default createStore({
  state: {
    sid: "583f72dd-52ce-454a-afd4-738873086dee",
    user: null
  },
  mutations: {},
  actions: {
    login() {}
  },
  modules: {},
  getters: {
    isLoggedIn: state => !!state.sid,
    currentUser(state) {
      return state.user
    }
  }
})
