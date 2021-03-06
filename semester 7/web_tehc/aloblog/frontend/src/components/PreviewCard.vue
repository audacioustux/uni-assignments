<template>
  <router-link :to="link">
    <article>
      <header :style="thumbnailStyle">
        <h3 class="white">
          {{ title }}
        </h3>
      </header>
      <section class="content">
        <time class="text-sm">{{ date }}</time>
        <p class="text-sm">
          {{ content }}
        </p>
      </section>
      <footer class="white text-sm">
        <section class="author">
          <img
            class="avatar inline"
            :src="`https://picsum.photos/seed/${id}/200`"
          />
          <span class="green-500">u/</span>{{ author.username }}
        </section>
        <section class="state">
          <ul>
            <li v-if="numComments > 0">
              <span>{{ numComments }}</span>
              <svg
                fill="currentColor"
                class="inline"
                viewBox="0 0 24 24"
                width="18"
                height="18"
              >
                <path :d="require('@mdi/js').mdiMessageSettingsOutline" />
              </svg>
            </li>
          </ul>
        </section>
      </footer>
    </article>
  </router-link>
</template>

<script lang="ts">
import { defineComponent, PropType } from "vue"

interface Author {
  avatar: string | null
  username: string
}

export default defineComponent({
  name: "PreviewCard",
  props: {
    id: { type: Number, required: true },
    thumbnail: { type: String },
    title: { type: String, required: true },
    content: { type: String, required: true },
    author: { type: Object as PropType<Author>, required: true },
    numComments: { type: Number, required: true }
    // numReacts: Number
  },
  computed: {
    thumbnailStyle(): { backgroundImage: string } | null {
      if (this.thumbnail) {
        return {
          backgroundImage: `url('http://localhost:8080/uploads/img/thumbnails/${this.thumbnail}')`
        }
      }
      return null
    },
    link(): { name: string; params: { blogId: number } } {
      return { name: "Blog", params: { blogId: this.id } }
    }
  },
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
  transition: box-shadow 0.2s;
  &:hover {
    box-shadow: 0 0 0 2px #a09379aa;
  }
}
header {
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 0 1rem;
  height: 175px;
  letter-spacing: 0.3px;
  line-height: 28px;
  display: flex;
  flex-direction: column;
  background-size: cover;
  &::before {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    background-image: linear-gradient(180deg, rgba(22, 26, 31, 0), #292b2f);
  }
  h3 {
    overflow: hidden;
    font-size: 21px;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    position: relative;
  }
}
time {
  margin: 1rem 0;
  display: block;
}
section.content {
  padding: 0 1rem;
  overflow-wrap: anywhere;
}
section.author {
  .avatar {
    margin-right: 1rem;
    width: 24px;
    height: 24px;
  }
}
section.state {
  position: absolute;
  right: 15px;
  bottom: 15px;
  li {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    line-height: 24px;
    margin-top: 8px;
    transition: color ease 0.2s;
    &:hover {
      color: #00e59b;
    }
  }
  svg {
    margin-left: 5px;
  }
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

  &::before {
    content: "";
    position: absolute;
    bottom: 100%;
    width: 100%;
    height: 48px;
    margin: 0 -15px;
    background-image: linear-gradient(180deg, rgba(22, 26, 31, 0), #292b2f);
  }
}
</style>
