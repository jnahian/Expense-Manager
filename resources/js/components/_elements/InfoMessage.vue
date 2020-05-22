<template>
    <div v-if="msg" class="mt-2 flex items-center text-teal-500 text-sm">
        <div class="py-1 mr-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
            </svg>
        </div>
        <p v-text="msg"></p>
    </div>
</template>

<script>
    export default {
        name: 'InfoMessage',

        props: {
            msg: {
                type: String,
                required: true
            }
        }
    }
</script>
