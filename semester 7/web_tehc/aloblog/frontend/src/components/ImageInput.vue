<template>
  <div>
    <div @click="launchFilePicker()">
      <slot name="activator"></slot>
    </div>

    <v-dialog v-model="errorDialog" max-width="300">
      <v-card>
        <v-card-text class="subheading">{{ errorText }}</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="errorDialog = false" flat>Got it!</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  name: "image-input",
  data: () => ({
    errorDialog: null,
    errorText: "",
    uploadFieldName: "file",
    maxSize: 1024
  }),
  props: {
    value: Object
  },
  methods: {
    launchFilePicker() {
      this.$refs.file.click()
    },
    onFileChange(fieldName, file) {
      const { maxSize } = this
      const imageFile = file[0]
      if (file.length > 0) {
        const size = imageFile.size / maxSize / maxSize
        if (!imageFile.type.match("image.*")) {
          this.errorDialog = true
          this.errorText = "Please choose an image file"
        } else if (size > 1) {
          this.errorDialog = true
          this.errorText =
            "Your file is too big! Please select an image under 1MB"
        } else {
          const formData = new FormData()
          const imageURL = URL.createObjectURL(imageFile)
          formData.append(fieldName, imageFile)
          this.$emit("input", { formData, imageURL })
        }
      }
    }
  }
}
</script>
