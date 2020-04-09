<template>
    <div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- Replace with your content -->
            <div class="py-4">
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
                        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-no-wrap">
                            <div class="ml-4 mt-2">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Job Postings
                                </h3>
                            </div>
                            <div class="ml-4 mt-2 flex-shrink-0">
              <span class="inline-flex rounded-md shadow-sm">
                <button type="button"
                        class="relative inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-700 active:bg-indigo-700">
                  Create new job
                </button>
              </span>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Content goes here -->
                    </div>
                    <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                        <!-- Content goes here -->
                        <!-- We use less vertical padding on card footers at all sizes than on headers or body sections -->
                    </div>
                </div>
            </div>
            <!-- /End replace -->
        </div>
    </div>
</template>

<script>
    export default {
        middleware: 'auth',

        metaInfo() {
            return {title: this.$t('home')}
        }
    }
</script>
