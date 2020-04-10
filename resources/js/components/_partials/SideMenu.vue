<template>
    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:flex-shrink-0">
        <div class="flex flex-col w-64">
            <div class="flex items-center h-16 flex-shrink-0 px-4 bg-blue-900 justify-center">
                <h1 class="text-white text-xl">{{appName}}</h1>
            </div>
            <div class="h-0 flex-1 flex flex-col overflow-y-auto">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <nav class="flex-1 px-2 py-4 bg-blue-800">
                    <router-link :to="{name: 'home'}" exact exact-active-class="bg-gray-900"
                                 class="group flex items-center px-2 py-2 text-sm leading-5 font-medium text-white rounded-md hover:text-white hover:bg-gray-900 focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-300 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"/>
                        </svg>
                        Dashboard
                    </router-link>
                    <a href="#"
                       class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Team
                    </a>
                    <a href="#"
                       class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        Projects
                    </a>
                    <a href="#"
                       class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Calendar
                    </a>
                    <a href="#"
                       class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor"
                             fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        Documents
                    </a>
                    <a href="#"
                       class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-300 rounded-md hover:text-white hover:bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="mr-3 h-6 w-6 text-gray-400 group-hover:text-gray-300 group-focus:text-gray-300 transition ease-in-out duration-150" stroke="currentColor"
                             width="24px" height="24px" viewBox="0 0 475.085 475.085">
                            <g>
                                <g>
                                    <path d="M237.545,255.816c9.899,0,18.468-3.609,25.696-10.848c7.23-7.229,10.854-15.799,10.854-25.694V36.547
                                        c0-9.9-3.62-18.464-10.854-25.693C256.014,3.617,247.444,0,237.545,0c-9.9,0-18.464,3.621-25.697,10.854
                                        c-7.233,7.229-10.85,15.797-10.85,25.693v182.728c0,9.895,3.617,18.464,10.85,25.694
                                        C219.081,252.207,227.648,255.816,237.545,255.816z"/>
                                    <path d="M433.836,157.887c-15.325-30.642-36.878-56.339-64.666-77.084c-7.994-6.09-17.035-8.47-27.123-7.139
                                        c-10.089,1.333-18.083,6.091-23.983,14.273c-6.091,7.993-8.418,16.986-6.994,26.979c1.423,9.998,6.139,18.037,14.133,24.128
                                        c18.645,14.084,33.072,31.312,43.25,51.678c10.184,20.364,15.27,42.065,15.27,65.091c0,19.801-3.854,38.688-11.561,56.678
                                        c-7.706,17.987-18.13,33.544-31.265,46.679c-13.135,13.131-28.688,23.551-46.678,31.261c-17.987,7.71-36.878,11.57-56.673,11.57
                                        c-19.792,0-38.684-3.86-56.671-11.57c-17.989-7.71-33.547-18.13-46.682-31.261c-13.129-13.135-23.551-28.691-31.261-46.679
                                        c-7.708-17.99-11.563-36.877-11.563-56.678c0-23.026,5.092-44.724,15.274-65.091c10.183-20.364,24.601-37.591,43.253-51.678
                                        c7.994-6.095,12.703-14.133,14.133-24.128c1.427-9.989-0.903-18.986-6.995-26.979c-5.901-8.182-13.844-12.941-23.839-14.273
                                        c-9.994-1.332-19.085,1.049-27.268,7.139c-27.792,20.745-49.344,46.442-64.669,77.084c-15.324,30.646-22.983,63.288-22.983,97.927
                                        c0,29.697,5.806,58.054,17.415,85.082c11.613,27.028,27.218,50.34,46.826,69.948c19.602,19.603,42.919,35.215,69.949,46.815
                                        c27.028,11.615,55.388,17.426,85.08,17.426c29.693,0,58.052-5.811,85.081-17.426c27.031-11.604,50.347-27.213,69.952-46.815
                                        c19.602-19.602,35.207-42.92,46.818-69.948s17.412-55.392,17.412-85.082C456.809,221.174,449.16,188.532,433.836,157.887z"/>
                                </g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                                                        <g>
                            </g>
                            </svg>
                        Reports
                    </a>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SideMenu",
        props: ['open'],
        data: () => ({
            appName: window.config.appName,
        })
    }
</script>

<style scoped>

</style>
