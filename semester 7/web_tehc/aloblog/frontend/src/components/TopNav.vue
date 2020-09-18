<template>
  <header class="flex bg-white">
    <div class="left">
      <SearchInput type="text" size="32" />
    </div>
    <div class="middle">
      <router-link :to="{ name: 'Home' }">
        <Logo height="48" />
      </router-link>
    </div>
    <div class="right">
      <LoginButton v-if="!isLoggedIn" />
      <SignupButton v-if="!isLoggedIn" />
      <LogoutButton v-if="isLoggedIn" />
    </div>
  </header>
</template>
<script lang="ts">
import LoginButton from "@/components/LoginButton.vue"
import SignupButton from "@/components/SignupButton.vue"
import Logo from "@/components/Logo.vue"
import SearchInput from "@/components/SearchInput.vue"
import { defineComponent } from "vue"
// import UserDataService from "@/services/UserDataService"
import LogoutButton from "@/components/LogoutButton.vue"
import store from "@/store/reactiveStore"

export default defineComponent({
  name: "TopNav",
  components: { LogoutButton, LoginButton, Logo, SearchInput, SignupButton },
  data() {
    return store.state
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
  .right {
    flex: 1 0 40%;
  }
  .right {
    display: flex;
    justify-content: flex-end;
  }
}
</style>
