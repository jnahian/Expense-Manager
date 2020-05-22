<template>
    <div class="h-screen flex overflow-hidden bg-gray-200" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
        <mobile-menu @sideBarOpen="toggleSidebar" :open="sidebarOpen"/>

        <side-menu/>
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <top-bar @sideBarOpen="toggleSidebar" :open="sidebarOpen"/>

            <main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none" tabindex="0" x-data x-init="$el.focus()">
                <child/>
                <vue-confirm-dialog></vue-confirm-dialog>
            </main>

        </div>
    </div>
</template>

<script>
    import TwNavbar from '~/components/TwNavbar'
    import LocaleSwitcher from '~/components/LocaleSwitcher'
    import MobileMenu from "../components/_partials/MobileMenu";
    import SideMenu from "../components/_partials/SideMenu";
    import TopBar from "../components/_partials/TopBar";

    export default {
        name: 'MainLayout',

        components: {
            TopBar,
            SideMenu,
            MobileMenu,
            TwNavbar,
            LocaleSwitcher
        },
        data: () => ({
            appName: window.config.appName,
            sidebarOpen: false,
            open: false,
        }),
        methods: {
            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen
            }
        }
    }
</script>
