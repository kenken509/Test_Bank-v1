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
                <!-- DEPARTMENT MANAGEMENT -->
                <div>
                    <div class="flex items-center py-3 pl-3 space-x-2 hover:bg-blue-900" >
                        <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5.005 10.19a1 1 0 0 1 1 1v.233l5.998 3.464L18 11.423v-.232a1 1 0 1 1 2 0V12a1 1 0 0 1-.5.866l-6.997 4.042a1 1 0 0 1-1 0l-6.998-4.042a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1ZM5 15.15a1 1 0 0 1 1 1v.232l5.997 3.464 5.998-3.464v-.232a1 1 0 1 1 2 0v.81a1 1 0 0 1-.5.865l-6.998 4.042a1 1 0 0 1-1 0L4.5 17.824a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                            <path d="M12.503 2.134a1 1 0 0 0-1 0L4.501 6.17A1 1 0 0 0 4.5 7.902l7.002 4.047a1 1 0 0 0 1 0l6.998-4.04a1 1 0 0 0 0-1.732l-6.997-4.042Z"/>
                        </svg>

                        <div class="w-full">
                            <button @click="depMgmtToggleMenu" class="flex w-full items-center justify-between pr-8 ">
                             Department Mgmt
                                <svg v-if="showDepMgmtMenu" class="w-6 h-6  text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                                <svg v-else class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                </svg>
                            </button>
                            
                        </div>
                    </div>
                    <ul 
                        v-if="showDepMgmtMenu"
                        
                    >
                        <Link :href="route('departments.show')">
                            <li @click="toggleBackground('dep1')" :class="{'bg-blue-900':clickedItem == 'dep1'}" class="flex pl-10  items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            
                                <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M5.005 10.19a1 1 0 0 1 1 1v.233l5.998 3.464L18 11.423v-.232a1 1 0 1 1 2 0V12a1 1 0 0 1-.5.866l-6.997 4.042a1 1 0 0 1-1 0l-6.998-4.042a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1ZM5 15.15a1 1 0 0 1 1 1v.232l5.997 3.464 5.998-3.464v-.232a1 1 0 1 1 2 0v.81a1 1 0 0 1-.5.865l-6.998 4.042a1 1 0 0 1-1 0L4.5 17.824a1 1 0 0 1-.5-.866v-.81a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                                    <path d="M12.503 2.134a1 1 0 0 0-1 0L4.501 6.17A1 1 0 0 0 4.5 7.902l7.002 4.047a1 1 0 0 0 1 0l6.998-4.04a1 1 0 0 0 0-1.732l-6.997-4.042Z"/>
                                </svg>
                                Departments
                            </li>
                        </Link>
                        
                        <li @click="toggleBackground('dep2')" :class="{'bg-blue-900':clickedItem == 'dep2'}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                            </svg>

                            Add
                        </li>
                        <!-- <li @click="toggleBackground('dep3')" :class="{'bg-blue-900':clickedItem == 'dep3'}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z" clip-rule="evenodd"/>
                            </svg>
                            Delete
                        </li>
                        <li @click="toggleBackground('dep4')" :class="{'bg-blue-900':clickedItem == 'dep4'}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M5 8a4 4 0 1 1 7.796 1.263l-2.533 2.534A4 4 0 0 1 5 8Zm4.06 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h2.172a2.999 2.999 0 0 1-.114-1.588l.674-3.372a3 3 0 0 1 .82-1.533L9.06 13Zm9.032-5a2.907 2.907 0 0 0-2.056.852L9.967 14.92a1 1 0 0 0-.273.51l-.675 3.373a1 1 0 0 0 1.177 1.177l3.372-.675a1 1 0 0 0 .511-.273l6.07-6.07a2.91 2.91 0 0 0-.944-4.742A2.907 2.907 0 0 0 18.092 8Z" clip-rule="evenodd"/>
                            </svg>

                            Update
                        </li> -->
                    </ul>
                </div>
                <!-- DEPARTMENT MANAGEMENT -->

                <!-- USER MANAGEMENT MENU-->
                <div>
                    <div class="flex items-center py-3 pl-3 space-x-2 hover:bg-blue-900" >
                        <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                        </svg>
                        <div class="w-full">
                            <button @click="userManagementToggleMenu" class="flex w-full items-center justify-between pr-8 ">
                                Users Mgmt 
                                <svg v-if="showUserManagementMenu" class="w-6 h-6  text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                                <svg v-else class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <ul 
                        v-if="showUserManagementMenu"
                        
                    >
                        <li @click="toggleBackground('user1')" :class="{'bg-blue-900':clickedItem === 'user1'}" class="flex pl-10  items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                            </svg>
                            Users
                        </li>
                        <li @click="toggleBackground('user2')" :class="{'bg-blue-900':clickedItem === 'user2'}" class="flex pl-10 items-center gap-2 py-2 hover:bg-blue-900 hover:cursor-pointer">
                            <svg class="w-6 h-6 text-gray-300 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                            </svg>
                            Add
                        </li>
                        
                    </ul>
                </div>
                <!-- USER MANAGEMENT MENU-->


                
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

// DEPARTMENT MANAGEMENT LOGIC
const showDepMgmtMenu = ref(false)

const depMgmtToggleMenu = ()=>{
    showDepMgmtMenu.value = !showDepMgmtMenu.value
    clickedItem.value = 0
}

// USER MANAGEMENT LOGIC
const showUserManagementMenu = ref(false)

const userManagementToggleMenu = () => {
    showUserManagementMenu.value = !showUserManagementMenu.value
    clickedItem.value = 0
}

const toggleBackground = (index)=> {
    clickedItem.value = index;
} 

</script>
