<template>
    <DashboardLayout>
        <div class="flex items-center justify-between border-bot-only py-2 mb-4">
            <span class="text-[20px] font-bold text-gray-500">Add Department Page</span> 
        </div>
        <span class="font-semibold text-2xl">New Department</span>
        <div class="flex flex-col w-full lg:w-1/2 bg-red-400">
            <label>Name</label>
            <input type="text" placeholder="Enter department name" required/>
        </div>
        

        <Button @click="toggleModal = !toggleModal" class=" text-white bg-blue-700 p-2 my-4 shadow-md hover:bg-blue-500">modal button</Button>
        <div
        class="fixed over-x-hidden overflow-y-auto inset-0 flex justify-center items-center z-50 "
        v-if="toggleModal"
        >
            <div
            class="relative mx-auto w-auto  max-w-2xl"
            >
                <div class="bg-white w-full border ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, </div>
            </div>
        </div>

        <div v-if="toggleModal"
            class="absolute z-40 inset-0 opacity-25 bg-black"
        >

        </div>
       
    </DashboardLayout>
</template>

<script setup>
import {ref} from 'vue'
import DashboardLayout from '../DashboardLayout.vue';

const toggleModal = ref(false)
</script>