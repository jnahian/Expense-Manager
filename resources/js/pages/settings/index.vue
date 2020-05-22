<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <transition name="fade" mode="out-in">
            <router-view/>
        </transition>
    </div>
</template>

<script>
    export default {
        middleware: 'auth',

        components: {},

        computed: {}
    }
</script>
