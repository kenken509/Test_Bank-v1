<template>
    <DashboardLayout>
        <div class="flex items-center justify-between border-bot-only py-2 mb-4">
            <span class="text-[20px] font-bold text-gray-500">Divisions Page</span> 
            <div class="relative">
                <input v-model="searchField" type="text" placeholder="search" class="rounded-md">
                <svg class="absolute top-3 right-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div> 
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-200 uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Division Name</th>
                        <th scope="col" class="px-6 py-3">Department Name</th>
                        <th scope="col" class="px-6 py-3">Faculties</th>
                        <th scope="col" class="flex justify-center px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="div in data.division" :key="div.id">
                        <thead>

                        </thead>
                    </tr>
                </tbody>
            </table>
        </div>
        {{ data.division }}
    </DashboardLayout>

</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue';
import {ref} from 'vue'

const data = defineProps({
    division:Array,
})

const searchField = ref('')
</script>