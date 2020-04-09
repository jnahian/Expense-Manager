<template>
    <button :type="nativeType" :disabled="loading"
            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
            :class="{'w-full': block,'btn-lg': large}">
        <span v-if="loading" class="-ml-1 mr-2 h-5 w-5" :class="{'btn-loading': loading}"></span>
        <template v-if="loading">Wait..</template>
        <slot v-else/>
    </button>
</template>

<script>
    export default {
        name: 'SubmitButton',

        props: {
            type: {
                type: String,
                default: 'primary'
            },

            nativeType: {
                type: String,
                default: 'submit'
            },

            loading: {
                type: Boolean,
                default: false
            },

            block: {
                type: Boolean,
                default: true
            },

            large: {
                type: Boolean,
                default: false
            }
        }
    }
</script>
