<template>
  <header class="flex bg-white">
    <div class="left">
      <SearchInput type="text" size="32" />
    </div>
    <div class="middle">
      <Logo height="48" />
    </div>
    <div class="right">
      <LoginButton />
    </div>
  </header>
  <section>
    <div class="grid">
      <PreviewCard />
      <PreviewCard />
      <PreviewCard />
      <PreviewCard />
      <PreviewCard />
    </div>
  </section>
</template>
<script lang="ts">
import LoginButton from "@/components/LoginButton.vue"
import Logo from "@/components/Logo.vue"
import SearchInput from "@/components/SearchInput.vue"
import PreviewCard from "@/components/PreviewCard.vue"

import { defineComponent } from "vue"

export default defineComponent({
  name: "Home",
  components: { LoginButton, Logo, SearchInput, PreviewCard }
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
  .middle {
    flex: 1;
  }
}

section {
  --num-cards: 4;
  --cards-margin: 24px;
  padding: 30px 30px;
  display: grid;
  .grid {
    display: grid;
    grid-template-columns: repeat(var(--num-cards), 1fr);
    grid-gap: var(--cards-margin);
    justify-content: center;
  }
}
</style>
