<template>
    <div class="flex min-h-screen">
        <!-- sidebar -->
        <div 
            class="
                bg-blue-950 
                text-blue-100 
                w-64 
                absolute 
                inset-y-0 
                left-0 
                transform 
                transition 
                duration-200 
                ease-in-out
                z-50
                "
            :class="{'-translate-x-full': !showSideBar, 'translate-x-0': showSideBar}"
        >
            <Link href="/" class="flex items-center py-3 pl-2 space-x-2">
                <img :src="logoUrl" class="w-10 h-10"></img>
                <span class="text-2xl font-extrabold text-white">Test Bank</span>
            </Link>
            <nav>
                <Link href="/" class="flex items-center py-3 pl-3 space-x-2 hover:bg-blue-900">
                    <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                    </svg>
                    <span>Dashboard</span>
                </Link>
                
                <div>
                    <div class="flex items-center py-3 pl-3 space-x-2 hover:bg-blue-900" >
                        <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                        </svg>
                        <div >
                            <button @click="testMenuToggle" class=" flex items-center gap-4">
                             Users Management 
                                <svg v-if="showTestMenu" class="w-6 h-6  text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                                <svg v-else class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                </svg>
                            </button>
                            
                        </div>
                    </div>
                    <ul 
                        v-if="showTestMenu"
                        
                    >
                        <li @click="toggleBackground(1)" :class="{'bg-blue-900':clickedItem == 1}" class="flex pl-10  items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                            </svg>
                            Users
                        </li>
                        <li @click="toggleBackground(2)" :class="{'bg-blue-900':clickedItem == 2}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                            </svg>
                            Add
                        </li>
                        <li @click="toggleBackground(3)" :class="{'bg-blue-900':clickedItem == 3}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd"/>
                            </svg>
                            Delete
                        </li>
                        <li @click="toggleBackground(4)" :class="{'bg-blue-900':clickedItem == 4}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd"/>
                            </svg>

                            Update
                        </li>
                    </ul>
                </div>
                
                
            </nav>
        </div>

        <!-- header and content -->
        <div class="flex-1 transition-all duration-200 ease-in-out" :class="{'ml-0': !showSideBar, 'ml-64': showSideBar}">
            <div class="flex items-center justify-between bg-white shadow px-2 py-4">
                <button @click="menuBtnClick">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
                    </svg>
                </button>
                Welcome back, {{ user.role }} {{ user.name }}
            </div>
            <div class="p-8 text-blue-700 font-extrabold">
               content ::
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const clickedItem = ref(null)
const showSideBar = ref(true);
const user = computed(() => usePage().props.user);
const logoUrl = ref('/storage/Images/ncstLogo.png');
const menuBtnClick = () => {
    showSideBar.value = !showSideBar.value;
};

const showTestMenu = ref(true)

const testMenuToggle = () => {
    showTestMenu.value = !showTestMenu.value
    clickedItem.value = 0
}

const toggleBackground = (index)=> {
    clickedItem.value = index;
} 

</script>
