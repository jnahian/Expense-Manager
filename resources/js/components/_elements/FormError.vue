<template>
    <div v-if="form.errors.has(field)" class="help-block text-red-500 font-light text-sm" v-html="form.errors.get(field)"/>
</template>

<script>
    export default {
        name: 'FormError',

        props: {
            form: {
                type: Object,
                required: true
            },

            field: {
                type: String,
                required: true
            }
        }
    }
</script>
