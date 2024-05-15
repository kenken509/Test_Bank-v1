<template>
    <DashboardLayout>
        <div class="flex items-center sm:flex-col md:flex-row  lg:justify-between border-bot-only py-2 border border-gray-600   mb-4">
            <span class="text-[20px] font-bold text-gray-500">Departmens Page</span>  
        </div>
        <!--TABLE-->
        <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-200 uppercase  bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Department Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Divisions
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Department Head
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Faculties
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dep in data.departments" :key="dep.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ dep.name }}
                            </th>

                            <td v-if="dep.divisions.length"  v-for="division in dep.divisions" :key="division.id" class="flex px-6 py-2">
                                <span > {{ division.name }}</span>
                                
                            </td>
                            <td v-else class="flex px-6 py-4">--</td>


                            <td class="px-6 py-4">
                                {{ dep.department_heads }}
                            </td>


                            <td class="px-6 py-4">
                                {{ dep.faculty }}
                            </td>
                           
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
        <!--TABLE-->
    </DashboardLayout>

</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue'

const data = defineProps({
    departments:Array,
})
</script>