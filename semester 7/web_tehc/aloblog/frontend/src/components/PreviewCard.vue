<template>
  <article>
    <header>
      <h3 class="text-2xl white">
        একগাদা লার্নিং রিসোর্স, কিছু র‍্যান্ডম, তিক্ত এবং সোলাইমানী কথাবার্তা
      </h3>
    </header>
    <section class="content">
      <time class="text-sm">{{ date }}</time>
      <p class="text-sm">
        ফার্স্ট সেমিস্টার থেকে ক্লাসমেট বা জুনিয়রদের ভার্সিটি সিলেবাসের বাইরে
        কিছু শিখার জন্যে ঘুতাইতেছি। দুয়েকজন শুনতেছে যারা তাদের যতদূর সম্ভব হেল্প
        করার চেষ্টা করি। ৮ বছর ধরে নিজে যে সেক্টরে কাজ করে আসতেছি সেখানে অন্যদের
        আগ্রহ দেখতে ভালো লাগে আরকি।
      </p>
    </section>
    <footer class="white text-sm">
      <img
        class="avatar"
        src="https://a.deviantart.net/avatars-big/f/e/felizias.png?4"
      />
      <span class="green-500">u/</span>audacioustux
    </footer>
  </article>
</template>

<script lang="ts">
import { defineComponent } from "vue"
export default defineComponent({
  name: "PreviewCard",
  data() {
    return {
      date: new Date(Date.now()).toDateString()
    }
  }
})
</script>

<style lang="scss" scoped>
article {
  color: #b9bbbe;
  height: 350px;
  background-color: #292b2f;
  border-radius: 4px;
  overflow: hidden;
  cursor: pointer;
  box-shadow: 0 20px 25px -5px #292b2f0a, 0 10px 10px -5px #292b2faa;
  position: relative;
}
header {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: end;
  padding: 0 1rem;
  height: 175px;
  letter-spacing: 0.3px;
  line-height: 28px;
  display: flex;
  flex-direction: column;
  background-size: cover;
  background-image: linear-gradient(180deg, rgba(22, 26, 31, 0), #292b2f),
    url("https://audacioustux.com/img/map-of-computer-science.jpg");
}
time {
  margin: 1rem 0;
  display: block;
}
section.content {
  padding: 0 1rem;
}
footer {
  position: absolute;
  bottom: 0;
  left: 0;
  display: flex;
  align-items: center;
  width: 100%;
  padding: 15px 15px;
  background-color: #292b2fee;
  font-family: "IBM Plex Mono", monospace;
  font-weight: 500;

  .avatar {
    margin-right: 1rem;
    width: 24px;
    height: 24px;
  }
  &::before {
    content: "";
    position: absolute;
    bottom: 100%;
    width: 100%;
    height: 40px;
    margin: 0 -15px;
    background-image: linear-gradient(180deg, rgba(22, 26, 31, 0), #292b2f);
  }
}
</style>
