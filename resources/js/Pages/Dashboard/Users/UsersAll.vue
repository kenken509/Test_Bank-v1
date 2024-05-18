<template>
    <DashboardLayout>
        <div class="flex items-center justify-end border-bot-only py-2 mb-4">
           
           <div class="relative">
               <input v-model="searchField" type="text" placeholder="search" class="rounded-md">
               <svg class="absolute top-3 right-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                   <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
               </svg>
           </div> 
       </div>
       <div class="flex justify-between items-center">
            <span class="text-[20px] font-bold text-gray-500">Users </span> 
            <div >
                
                <button @click="addUserModalVisible=true" class="btn-primary px-4 flex gap-2 items-center "> 
                    <svg class=" w-4 h-4 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z" clip-rule="evenodd"/>
                    </svg>                 
                    NEW
                </button>
            </div>
        </div>

        
         <!--TABLE-->
          
         <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-200 uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3">Department</th>
                            <th scope="col" class="px-6 py-3">Division</th>
                            <th scope="col" class="flex justify-center px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in data.users" :key="user.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ user.email }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ user.name }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ user.role }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <span v-if="user.department">
                                    {{ user.department.name }}
                                </span>
                                <span v-else>--</span>
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <span v-if="user.division">
                                    {{ user.division.name }}
                                </span>
                                <span v-else>--</span>
                            </th>
                            
                            <td class="px-6 py-4 text-center ">
                                <div  class="flex flex-col   lg:flex-row lg:justify-center  lg:space-x-4">
                                    <button @click="deleteConfirmation(dep.id)" class=" btn-warning my-2">Delete</button>
                                    <button @click="showUpdateModal(dep)" type="button" class="btn-success my-2">
                                        Update
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--TABLE-->


        

        <!--add user modal-->
        <Dialog v-model:visible="addUserModalVisible" modal header="New User" :style="{ width: '60rem' }">
            <form>
                <div class="border mb-4">
                    
                </div>
                 
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col align-items-center gap-3 mb-3 col-span-2 md:col-span-1 relative">
                        <label for="username" class="font-semibold w-6rem">Email </label>
                        <input v-model="addNewUserForm.email" type="email" placeholder="Enter email" class="flex-auto border border-gray-500 rounded " required/>
                        <span v-if="addNewUserValidatorEmail" class="absolute inset-y-20 text-red-500" >{{ addNewUserValidatorEmail }} </span> 
                    </div>
                    
                    <div class="flex flex-col align-items-center gap-3 mb-3 col-span-2 md:col-span-1 relative">
                        <label for="username" class="font-semibold w-6rem">Name</label>
                        <input v-model="addNewUserForm.name" type="text" placeholder="Enter name" class="flex-auto border border-gray-500 rounded " required/>
                        <span v-if="addNewUserValidatorName" class="absolute inset-y-20 text-red-500" >{{ addNewUserValidatorName }} </span> 
                    </div>
                    
                    <div class="flex flex-col align-items-center gap-3 mb-3 col-span-2 md:col-span-1 relative">
                        <label for="role" class="font-semibold w-6rem">Role</label>
                        <select @change="checkRol" v-model="addNewUserForm.role" id="role" class="w-full rounded border-gray-500" required>
                            <option value="" selected hidden>Select a role</option>
                            <option v-for="(role, index) in roles" :key="index">{{ role }}</option>
                        </select>
                        <span v-if="addNewUserValidatorRole" class="absolute inset-y-20 text-red-500 absolute" >{{ addNewUserValidatorRole }} </span> 
                    </div>

                    <div  class="flex flex-col align-items-center gap-3 mb-3 col-span-2 md:col-span-1 relative  "  >
                        <label for="departmentName" class="font-semibold w-6rem">Department</label>
                        <select v-model="addNewUserForm.department"  id="departmentName" class="w-full rounded border-gray-500" required :class="{'pointer-events-none':isAdmin, ' opacity-40':isAdmin, 'bg-gray-300':isAdmin}"  >
                            <option value="" selected hidden>Select a department</option>
                            <option v-for="dep in data.departments" :key="dep.id" :value="dep">{{ dep.name }}</option>
                        </select>
                        <span v-if="addNewUserValidatorDep" class="absolute inset-y-20 text-red-500 absolute" >{{ addNewUserValidatorDep }} </span> 
                    </div>
                    
                    <div v-if="addNewUserForm.department && addNewUserForm.department.divisions.length" class="flex flex-col align-items-center gap-3 mb-3 col-span-2 relative">
                        <label for="departmentName" class="font-semibold w-6rem">Division</label>
                        <select  v-model="addNewUserForm.division_id"  id="departmentName" class="w-full rounded border-gray-500" required>
                            <option value="" selected hidden>Select a division</option>
                            <option v-for="div in addNewUserForm.department.divisions" :key="div.id">{{ div.name }}</option>
                        </select>
                        <span v-if="addNewUserValidatorDiv" class="absolute inset-y-20 text-red-500 absolute" >{{ addNewUserValidatorDiv }} </span> 
                    </div>

                    
                </div>
                
            </form>
            
            <div class="mt-4">
                <button @click="submitNewUser" type="button" class="w-full btn-primary " >Save</button>
            </div>
            
        </Dialog>
         <!--add user modal-->

        
    </DashboardLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import DashboardLayout from '../DashboardLayout.vue'
import { computed, ref, watch } from 'vue'



const searchField = ref('')
const data = defineProps({
    users:Array,
    departments:Array,
})
//$table->enum('role', ['admin','co-admin','department head','faculty'])->nullable();
const roles = ref([
    'admin',
    'co-admin',
    'department head',
    'faculty',
])



//add user logic

const addUserModalVisible = ref(false);
const addNewUserForm = useForm({
    email:'',
    name:'',
    role:'',
    department:'',
    division_id:'',
})

const isAdmin = ref(false)
const checkRol = ()=>{
    if(addNewUserForm.role === 'admin' || addNewUserForm.role ==='co-admin')
    {
        isAdmin.value = true
    }
    else
    {
        isAdmin.value = false
    }
}

const addNewUserValidator = ref({
    email:'',
    name:'',
    role:'',
    department:'',
    division_id:'',
})
const addNewUserValidatorEmail = ref('')
const addNewUserValidatorName = ref('')
const addNewUserValidatorRole = ref('')
const addNewUserValidatorDep = ref('')
const addNewUserValidatorDiv = ref('')

// Function to validate email format
const isValidEmail = (email) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return emailRegex.test(email)
}
const submitNewUser = ()=> {


    addNewUserValidatorEmail.value = !addNewUserForm.email ? 'Email is required': !isValidEmail(addNewUserForm.email) ? 'Invalid email format' : ''
    addNewUserValidatorName.value = !addNewUserForm.name ? 'Name is required': ''
    addNewUserValidatorRole.value = !addNewUserForm.role ? 'Role is required': ''
   

    if(!addNewUserForm.department)
    {
        if(addNewUserForm.role === 'admin' || addNewUserForm.role === 'co-admin')
        {
            addNewUserValidatorDep.value = ''
        }
        else
        {
            addNewUserValidatorDep.value =  'Department is required.'
        }
        
    }
    
    if(addNewUserForm.department)
    {
        const divisions = addNewUserForm.department.divisions;
        if(divisions.length > 1 && !addNewUserForm.division_id)
        {
            addNewUserValidatorDiv.value = 'Division is required.'
        }
        else
        {
            addNewUserValidatorDiv.value = '';
        }
    }
    console.log(addNewUserValidator.email);
    if(addNewUserValidatorEmail.value === '' && addNewUserValidatorName.value === '' &&  addNewUserValidatorRole.value === '' && addNewUserValidatorDep.value === '' && addNewUserValidatorDiv.value === '')
    {
        addNewUserForm.post(route('user.store'));
        //addNewUserForm.post('');
    }
    
    
}

</script>