function imagePreview() {
    return {
        imageUrl: "",

        fileChosen(event) {
            this.fileToDataUrl(event, src => this.imageUrl = src)
        },

        fileToDataUrl(event, callback) {
            if (!event.target.files.length) return callback("")
            let file = event.target.files[0]
            this.convert(file, callback)
        },

        convert(file, callback) {
            const reader = new FileReader()

            reader.readAsDataURL(file)
            reader.onload = e => callback(e.target.result)
        },

        clearImage() {
            this.imageUrl = ""
            this.$refs.input.value = "";
        },

        setImage() {
            if (!this.$refs.input.files.length) return this.imageUrl = ""
            this.convert(this.$refs.input.files[0], src => this.imageUrl = src)
        }
    }
}