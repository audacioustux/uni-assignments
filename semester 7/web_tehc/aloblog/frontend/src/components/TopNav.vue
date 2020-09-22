<template>
  <header class="flex bg-white">
    <div class="left" id="navLeft">
      <SearchInput type="text" size="32" v-if="routeName !== 'Editor'" />
    </div>
    <div class="middle">
      <Logo height="48" @click="goHome()" />
    </div>
    <div class="right" id="navRight">
      <LoginButton v-if="!isLoggedIn" />
      <SignupButton v-if="!isLoggedIn" />
      <WriteButton v-if="isLoggedIn && routeName !== 'Editor'" />
      <LogoutButton v-if="isLoggedIn && routeName !== 'Editor'" />
    </div>
  </header>
</template>
<script lang="ts">
import LoginButton from "@/components/LoginButton.vue"
import SignupButton from "@/components/SignupButton.vue"
import WriteButton from "@/components/WriteButton.vue"
import Logo from "@/components/Logo.vue"
import SearchInput from "@/components/SearchInput.vue"
import { defineComponent } from "vue"
// import UserDataService from "@/services/UserDataService"
import LogoutButton from "@/components/LogoutButton.vue"
import store from "@/store/reactiveStore"

export default defineComponent({
  name: "TopNav",
  components: {
    WriteButton,
    LogoutButton,
    LoginButton,
    Logo,
    SearchInput,
    SignupButton
  },
  watch: {
    $route: "updateRoute"
  },
  data() {
    return store.state
  },
  methods: {
    updateRoute() {
      this.routeName = this.$route.name as string
    },
    goHome() {
      this.$router.push("/")
      if (this.$route.name === "Home") this.$router.go(0)
    }
  }
})
</script>
<style lang="scss" scoped>
header {
  z-index: 99999999;
  height: 48px;
  border: 1px solid bottom;
  background-color: #2f3136;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 15px;
  position: sticky;
  top: 0;

  .left,
  .right {
    flex: 1 0 40%;
  }
  .right {
    display: flex;
    justify-content: flex-end;
  }
}
</style>
