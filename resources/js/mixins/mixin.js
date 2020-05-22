export default {
    methods: {
        showErrorMessage(error) {
            let {status, statusText, data: {message}} = error.response;
            if (status === 400) {
                if (message) {
                    this.$toast.error(this.$t(message));
                } else {
                    this.$toast.error(this.$t(statusText));
                }
            }
        }
    }
}
