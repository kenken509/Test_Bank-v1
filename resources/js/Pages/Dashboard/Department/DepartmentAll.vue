<template>
    <DashboardLayout>
        <div class="flex items-center justify-between border-bot-only py-2 mb-4">
            <span class="text-[20px] font-bold text-gray-500">Departments Page</span> 
            <div class="relative">
                <input v-model="searchField" type="text" placeholder="search" class="rounded-md">
                <svg class="absolute top-3 right-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div> 
        </div>
        <div v-if="$page.props.flash.success" >{{ successMessage($page.props.flash.success) }} </div>
        <div v-if="$page.props.flash.error" >{{ errorMessage($page.props.flash.error) }} </div>
        <!--TABLE-->
        <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-200 uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Department Name</th>
                            <th scope="col" class="px-6 py-3">Divisions</th>
                            <th scope="col" class="px-6 py-3">Department Head</th>
                            <th scope="col" class="px-6 py-3">Faculties</th>
                            <th scope="col" class="flex justify-center px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="dep in paginatedData" :key="dep.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ dep.name }}
                            </th>
                            <td v-if="dep.divisions.length" class="flex flex-col px-6 ">
                                <span v-for="division in dep.divisions" :key="division.id" class="py-2">{{ division.name }}</span>
                            </td>
                            <td v-if="!dep.divisions.length" class="flex px-6 py-4">--</td>
                            <td v-if="dep.department_heads.length" class="flex flex-col px-6">
                                <span v-for="depHead in dep.department_heads" :key="depHead.id" class="py-2">{{ depHead.name }}</span>
                            </td>
                            <td v-if="!dep.department_heads.length" class="px-6 py-4">--</td>
                            <td v-if="dep.faculty.length" class="px-6 py-4">
                                <span v-for="faculty in dep.faculty" :key="faculty.id" class="py-2">{{ faculty.name }}</span>
                            </td>
                            <td v-if="!dep.faculty.length" class="px-6 py-4">--</td>
                            <td class="px-6 py-4 text-center ">
                                <div  class="flex flex-col   lg:flex-row lg:justify-center  lg:space-x-4">
                                    <button @click="deleteConfirmation(dep.id)" class=" btn-warning my-2">Delete</button>
                                    <Link href='' class="btn-success my-2">
                                        Update
                                    </Link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--TABLE-->

        <!--PAGINATION CONTROLS-->
        <div class="flex  justify-center items-center mt-4">
            <button @click="prevPage" :disabled="currentPage === 1" class="px-4 py-2 mx-1 bg-blue-800 text-white rounded-md disabled:opacity-50">Previous</button>
            <span class="px-4 py-2">{{ currentPage }} / {{ totalPages }}</span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="px-4 py-2 mx-1 bg-blue-800 text-white rounded-md disabled:opacity-50">Next</button>
        </div>
        <!--PAGINATION CONTROLS-->
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue'
import { computed, ref } from 'vue'
import { Link, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2/dist/sweetalert2.js'

const data = defineProps({
    departments: Array,
})

const searchField = ref('')
const itemsPerPage = 10 // Number of items to display per page
const currentPage = ref(1)

const filteredData = computed(() => {
    const searchTerm = searchField.value.toLowerCase().trim()
    if (!searchTerm) {
        return data.departments
    }
    return data.departments.filter(dep => dep.name.toLowerCase().includes(searchTerm))
})

const totalPages = computed(() => Math.ceil(filteredData.value.length / itemsPerPage))

const paginatedData = computed(() => {
    const startIndex = (currentPage.value - 1) * itemsPerPage
    const endIndex = startIndex + itemsPerPage
    return filteredData.value.slice(startIndex, endIndex)
})

function nextPage() {
    if (currentPage.value < totalPages.value) {
        currentPage.value++
    }
}

function prevPage() {
    if (currentPage.value > 1) {
        currentPage.value--
    }
}


    const deleteConfirmation = (depId)=> 
    { 
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            allowOutsideClick:false,
            allowEscapeKey:false,
            }).then((result) => {
                if(result.isConfirmed)
                {
                    const deleteUrl = route('department.delete',{id: depId })

                    router.delete(deleteUrl);
                }

                if(result.isDismissed)
                {
                    Swal.fire({
                        title:'Canceled',
                        text:'Your action was canceled!',
                        icon:'error',
                        confirmButtonColor: '#3085d6',
                    })
                }
        });
    }  

    function successMessage(message)
    {
        Swal.fire({
            title:'Success',
            text:message,
            icon:'success',
            allowOutsideClick:false,
            allowEscapeKey:false,
        }).then((result)=>{
            if(result.isConfirmed)
            {
                location.reload();
            }
        })
    }
    
    function errorMessage(message) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: message + '!',
            allowOutsideClick:false,
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        })
    }
</script>
