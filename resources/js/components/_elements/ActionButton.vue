<template>
    <router-link v-if="action" :to="action" class="action-button" :class="type">
        <span class="icon" v-if="icon"><fa :icon="icon" class="fa-xs"></fa></span>
        <span>{{$t(title)}}</span>
    </router-link>
    <a v-else href="#" class="action-button" :class="type" @click.prevent="clickButton">
        <span class="icon" v-if="icon"><fa :icon="icon" class="fa-xs"></fa></span>
        <span>{{$t(title)}}</span>
    </a>
</template>

<script>
    export default {
        name: "ActionButton",
        props: {
            title: {
                type: String,
                required: true,
            },
            action: {
                type: [String, Object],
                default: ''
            },
            icon: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'info'
            }
        },
        methods: {
            clickButton() {
                this.$emit('click');
            }
        }
    }
</script>

<style scoped>

</style>
