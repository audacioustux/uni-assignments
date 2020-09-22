<template>
  <div class="container">
    <textarea
      class="editor"
      v-model.trim="content"
      placeholder="Write Here..."
      minlength="255"
    />
    <section class="preview" v-html="compiledMarkdown"></section>
  </div>
  <teleport to="#navLeft">
    <div>
      <label for="title">Title:</label>
      <input
        name="title"
        class="title"
        size="32"
        v-model.trim="title"
        placeholder="title here"
        minlength="8"
        maxlength="80"
        required
      />
      <div
        title="Thumbnail"
        @click="handleThumb"
        style="margin-left: 15px; display: inline-block; cursor: pointer"
      >
        <svg
          fill="currentColor"
          class="inline mr-1"
          viewBox="0 0 24 24"
          width="28"
          height="28"
        >
          <path
            :d="require('@mdi/js').mdiImage"
            :class="{ fillRed: thumbnail }"
          />
        </svg>
      </div>
      <input
        type="file"
        ref="thumbnail-input"
        name="thumbnail"
        @change="onFileChange($event.target.name, $event.target.files)"
        style="display:none"
      />
    </div>
  </teleport>
  <teleport to="#navRight">
    <button
      class="publish"
      @click="publish"
      :class="{ 'bg-green-dunno': isValid() }"
      :disabled="!isValid()"
    >
      Publish
    </button>
  </teleport>
</template>

<script lang="ts">
import { defineComponent } from "vue"
import marked from "marked"
import { sanitize } from "dompurify"
import BlogDataService from "@/services/BlogDataService"
// import ImageInput from "@/components/ImageInput.vue"
// import { debounce } from "lodash"

interface Author {
  avatar: string | null
  username: string
}
interface Blog {
  content: string
  title: string
  thumbnail: string | undefined
}
export default defineComponent({
  // components: { ImageInput },
  data(): Blog {
    return {
      content: "",
      title: "",
      thumbnail: undefined
    }
  },
  methods: {
    handleThumb() {
      if (this.thumbnail) {
        this.thumbnail = undefined
      } else {
        ;(this.$refs?.["thumbnail-input"] as HTMLFormElement).click()
      }
    },
    publish() {
      const { content, title, thumbnail } = this
      BlogDataService.create({
        content,
        title,
        thumbnail,
        state: "l"
      })
        .then(({ data: blogId }) => {
          this.$router.push({ name: "Blog", params: { blogId } })
        })
        .catch(
          ({
            response: {
              data: { errors }
            }
          }) => {
            console.log(errors)
          }
        )
    },
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    onFileChange(fieldName: string, files: any) {
      const imageFile = files[0]
      // NOTE: for OBE
      if (files.length > 0) {
        const formData = new FormData()
        formData.append(fieldName, imageFile)
        const xhr = new XMLHttpRequest()
        xhr.responseType = "json"
        xhr.onload = () => {
          if (xhr.status === 200) this.thumbnail = xhr.response
          else console.log(xhr.response)
        }
        xhr.open("POST", "http://localhost:8080/blogs/upload-thumb")
        xhr.send(formData)
      }
    },
    isValid() {
      if (this.title.length < 8) return false
      if (this.content.length < 255) return false
      return true
    }
  },
  computed: {
    compiledMarkdown(): string {
      return sanitize(marked(this.content))
    }
  }
})
</script>

<style lang="scss" scoped>
.container {
  font-family: "Source Serif Pro", serif;
  columns: 2;
  column-gap: 0;
  height: calc(100vh - 48px);
  line-height: 2em;
  overflow: hidden;
}
input.title {
  background-color: #40444b;
  color: #b9bbbe;
  border-radius: 3px;
  padding: 0 15px;
  line-height: 32px;
  font-size: small;
  font-family: "IBM Plex Mono", monospace;
  font-weight: 500;
  margin-left: 16px;
}
section.preview,
textarea.editor {
  padding: 24px;
  overflow-y: scroll;
  width: 100%;
  scrollbar-width: thin;
  display: block;
  height: 100%;
  word-wrap: break-word;
}
textarea.editor {
  background: none;
  outline: 0;
  border: 0;
  resize: none;
  width: 100%;
  border-radius: 4px;
  background-color: #2f3136;
  scrollbar-color: #2f3136 #2f3136;
  &:hover {
    scrollbar-color: #202225 #2f3136;
  }
}
section.preview {
  scrollbar-color: #36393f #36393f;
  &:hover {
    scrollbar-color: #202225 #36393f;
  }
}
button.publish {
  line-height: 32px;
  padding: 0 24px;
  border-radius: 4px;
  transition: background-color 0.2s;
}
button[disabled] {
  background-color: #40444b;
}
</style>
