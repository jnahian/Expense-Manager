<template>
    <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <button @click.stop="toggleMobileMenu" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden"
                aria-label="Open sidebar">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
            </svg>
        </button>
        <div class="flex-1 px-4 flex justify-between">
            <div class="flex-1 flex">
                <div class="w-full flex md:ml-0">
                    <label for="search_field" class="sr-only">Search</label>
                    <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                        <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"/>
                            </svg>
                        </div>
                        <input id="search_field"
                               class="block w-full h-full pl-8 pr-3 py-2 rounded-md text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 sm:text-sm"
                               placeholder="Search" type="search"/>
                    </div>
                </div>
            </div>
            <div class="ml-4 flex items-center md:ml-6">
                <button class="p-1 text-gray-400 rounded-full hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:shadow-outline focus:text-gray-500"
                        aria-label="Notifications">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>
                <div class="ml-3 relative">
                    <div>
                        <button @click="showUserMenu = !showUserMenu" class="max-w-xs flex items-center text-sm rounded-full focus:outline-none" id="user-menu"
                                aria-label="User menu" aria-haspopup="true" :aria-expanded="showUserMenu" v-click-outside="hideUserMenu">
                            <img class="h-8 w-8 rounded-full"
                                 :src="user.photo_url"
                                 alt=""/>
                            <span class="ml-2 text-purple-900 font-bold">{{user.name}}</span>
                        </button>
                    </div>
                    <transition
                            enter-active-class="transition ease-out duration-100"
                            enter-class="opacity-0 scale-95"
                            enter-to-class="opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-class="opacity-100 scale-100"
                            leave-to-class="opacity-0 scale-95">
                        <div v-show="showUserMenu" class="transform origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                            <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                <router-link :to="{ name: 'settings.profile' }" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                                             role="menuitem">
                                    <fa icon="user" fixed-width class="mr-2"/>
                                    {{$t('profile')}}
                                </router-link>
                                <router-link :to="{name: 'settings.password'}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                                             role="menuitem">
                                    <fa icon="lock" fixed-width class="mr-2"/>
                                    {{$t('password')}}
                                </router-link>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150" role="menuitem"
                                   @click.prevent="logout">
                                    <fa icon="power-off" fixed-width class="mr-2"/>
                                    {{$t('Sign out') }}
                                </a>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "TopBar",
        props: ['open'],
        data: () => ({
            sidebarOpen: false,
            showUserMenu: false
        }),
        computed: mapGetters({
            user: 'auth/user'
        }),
        methods: {
            hideUserMenu() {
                this.showUserMenu = false
            },
            async logout() {
                // Log out the user.
                await this.$store.dispatch('auth/logout');

                // Redirect to login.
                this.$router.push({name: 'login'})
            },

            toggleMobileMenu() {
                this.$emit('sideBarOpen')
            }
        },
        created() {
        }
    }
</script>

<style scoped>

</style>
