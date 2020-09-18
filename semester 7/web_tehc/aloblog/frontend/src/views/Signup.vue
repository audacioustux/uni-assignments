<template>
  <section>
    <header>
      <h3>Create an account</h3>
    </header>
    <div class="input-group">
      <label for="username">Username</label>
      <input v-model.trim="username" name="username" required />
      <span v-for="(error, i) in errors['username']" :key="i">{{ error }}</span>
    </div>
    <div class="input-group">
      <label for="email">Email</label>
      <input v-model.trim="email" type="email" name="email" required />
      <span v-for="(error, i) in errors['email']" :key="i">{{ error }}</span>
    </div>
    <div class="input-group">
      <label for="password">Password</label>
      <input v-model="password" type="password" name="password" required />
      <span v-for="(error, i) in errors['password']" :key="i">{{ error }}</span>
    </div>
    <div class="input-group">
      <label for="pass_confirm">Password Confirmation</label>
      <input
        v-model="passwordConfirmation"
        type="password"
        name="password_confirmation"
        required
      />
      <span v-for="(error, i) in errors['passwordConfirmation']" :key="i">{{
        error
      }}</span>
    </div>
    <button class="submit" @click="submit">Sign Up</button>
  </section>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import UserDataService from "@/services/UserDataService"
import store from "@/store/reactiveStore.ts"

interface ErrorRes {
  property: keyof Data
  message: string
}
interface Data {
  username: string
  email: string
  password: string
  passwordConfirmation: string
  // eslint-disable-next-line
  sharedStore: any
}
export default defineComponent({
  name: "Signup",
  data(): Data & {
    errors: Partial<{ [k in keyof Data]: string[] }>
  } {
    return {
      errors: {},
      username: "",
      email: "",
      password: "",
      passwordConfirmation: "",
      sharedStore: store.state
    }
  },
  methods: {
    submit() {
      this.errors = {}
      const { username, email, password, passwordConfirmation } = this
      if (password !== passwordConfirmation) {
        if (!this.errors.passwordConfirmation)
          this.errors.passwordConfirmation = []
        this.errors.passwordConfirmation.push("Passwords didn't match")
        return
      }
      UserDataService.create({ username, email, password })
        .then(() => {
          UserDataService.login({ username, password }).then(() => {
            store.setLogged()
            this.$router.push("/")
          })
        })
        .catch(
          ({
            response: {
              data: { errors }
            }
          }) => {
            errors.forEach((error: ErrorRes) => {
              const prop = error.property
              if (!this.errors[prop]) {
                this.errors[prop] = []
              }
              ;(this.errors[prop] as string[]).push(error.message)
            })
          }
        )
    }
  }
})
</script>
<style lang="scss" scoped>
section {
  margin: 0 auto;
  padding: 32px;
  width: 480px;
}
header {
  font-size: 24px;
  text-align: center;
}
input {
  display: block;
  background-color: #40444b;
  margin: 5px auto;
  line-height: 30px;
  //   border: 1px solid #202225;
  padding: 5px 15px;
  width: 100%;
  transition: border 0.2s;
}
.input-group {
  margin-top: 32px;
}
.submit {
  display: block;
  line-height: 30px;
  width: 100%;
  margin-top: 32px;
  padding: 15px;
  background-color: #7a796a;
}
</style>
