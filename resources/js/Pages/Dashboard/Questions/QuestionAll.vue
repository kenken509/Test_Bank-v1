<template>
    <DashboardLayout>
        <div class="flex items-center justify-between border-bot-only py-2 mb-4">
            <span class="text-[20px] font-bold text-gray-500">Questions Page </span> 
            <div class="relative">
                <input v-model="searchField" type="text" placeholder="search" class="rounded-md">
                <svg class="absolute top-3 right-2 w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </div> 
        </div>
        current codes:  {{ selectedSubjectCode.name }}
        <span class="text-red-700">{{ subjectCodeQuestions }}</span>

         <div class="flex items-center justify-between">
            <select  v-model="selectedSubjectCode" class="border-blue-500 rounded-md ">
                <option value="" selected hidden>
                    Subject Code
                </option>sdf
                <option v-for="code in data.subjectCodes" :value="code">
                    {{ code.name }}
                </option>
            </select>
           
            <div class="flex gap-4 " > 
                
                <div class="flex items-center gap-4 hover:cursor-pointer  " :class="{'pointer-events-none ': allTermsSelected}">
                    <input v-model="prelim" type="checkbox" id="prelim" class="hover:cursor-pointer "  />
                    <label for="prelim" class="hover:cursor-pointer" >Prelim</label>
                </div>
                <div class="flex items-center gap-4 hover:cursor-pointer" :class="{'pointer-events-none ': allTermsSelected}">
                    <input v-model="midTerm" type="checkbox" id="midterm" class="hover:cursor-pointer" />
                    <label for="midterm" class="hover:cursor-pointer">Midterm</label>
                </div>
                <div class="flex items-center gap-4 hover:cursor-pointer" :class="{'pointer-events-none ': allTermsSelected}">
                    <input v-model="prefinal" type="checkbox" id="prefinal" class="hover:cursor-pointer" />
                    <label for="prefinal" class="hover:cursor-pointer">Prefinal</label>
                </div>
                <div class="flex items-center gap-4 hover:cursor-pointer" :class="{'pointer-events-none ': allTermsSelected}">
                    <input v-model="final" type="checkbox" id="final" class="hover:cursor-pointer" />
                    <label for="final" class="hover:cursor-pointer">Final</label>
                </div>
               
                
                <div class="flex items-center gap-4 hover:cursor-pointer">
                    <input v-model="allTerm" type="checkbox" id="final" class="hover:cursor-pointer" />
                    <label for="final" class="hover:cursor-pointer">All</label>
                </div> 
            </div>
            <div class="flex items-center gap-2">
                <span>
                    Total Count: 
                </span>
                <span>
                    {{ questionTotalCoumt }}
                </span>
            </div>
        </div>
        
        
        
        <!--TABLE--> 
        <div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-200 uppercase bg-blue-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No.</th>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Question</th>
                            <th scope="col" class="px-6 py-3">Term</th>
                            <th scope="col" class="px-6 py-3">Type</th>
                            <th scope="col" class="px-6 py-3">Author</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            
                           

                            
                            <th  v-if="isAdmin" scope="col" class="flex justify-center px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr v-for="(question ,index ) in subjectCodeQuestions" :key="index" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            {{ getQuestionTotalCount(subjectCodeQuestions.length) }} 
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ index+1 }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{ question.id }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{ question.question }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                               {{ question.term }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ question.type }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ question.author.name }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            
                            </th>
                           
                          
                            <td  v-if="$page.props.user.role === 'admin'" class="px-6 py-4 text-center ">
                                <div  class="flex flex-col   lg:flex-row lg:justify-center  lg:space-x-4">
                                    <button @click="showQuestionInfoModal(question)" class="btn-primary p-2">Info</button>
                                    <button  @click="deleteConfirmation(question.id)" class=" btn-warning my-2">Delete </button>
                                    <Link :href="route('subject.codes.update.show',{id:question.id})" type="button" class="btn-success my-2">
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

        <!--Question Info Modal-->
        <Dialog v-model:visible="infoModalOpen" modal  :style="{ width: '80rem' }">
            <div class="border mb-4">
                
            </div>
            Question Info : {{ viewQuestionInfo }}
            <div class="flex flex-col align-items-center gap-3 mb-3">
                <label for="username" class="font-semibold w-6rem"></label>
                
                <input  type="text" placeholder="Enter department name" class="flex-auto border border-gray-500 rounded " required/>
            </div>
            
            <button @click="submit" type="button" class="w-full btn-primary" >Save</button>
        </Dialog>

        <!--Question Info Modal-->
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue';
import {ref,watch,onMounted} from 'vue'
import { Link,usePage } from '@inertiajs/vue3';

const searchField = ref('')


const data = defineProps({
    subjectCodes:Array,
})

const user = usePage().props.user
const isAdmin = ref(false);
onMounted(()=>{
    if(user.role === 'admin')
    {
        isAdmin.value = true;
    }

    selectedSubjectCode.value = data.subjectCodes[0]
    subjectCodeQuestions.value = selectedSubjectCode.value.questions
    console.log(subjectCodeQuestions)
})

const correctAnswer = ref()



function formatDate(dateString){
    const date = new Date(dateString)

    const options = { year: 'numeric', month: 'long', day: 'numeric' };

    return date.toLocaleDateString('en-US', options);
}
const infoModalOpen = ref(false);
const viewQuestionInfo = ref('');
const showQuestionInfoModal = (question)=>{
    infoModalOpen.value = !infoModalOpen.value
    viewQuestionInfo.value = question
}

watch(infoModalOpen,(val)=>{
    if(!val){
        viewQuestionInfo.value =''
    }
})

const prelim = ref(false);
const midTerm = ref(false);
const prefinal = ref(false);
const final = ref(false);

const selectedSubjectCode = ref('');
const currentSubjectCodes = ref('')
const subjectCodeQuestions = ref([]); 
watch(selectedSubjectCode, (val)=>{
    console.log(subjectCodeQuestions.value)
    subjectCodeQuestions.value = val.questions
    
    questionTotalCoumt.value = 0


})

const myArray = [
    {
        name: 'myPrelim',
        term: 'prelim',
    },
    {
        name: 'myMidterm',
        term: 'midterm',
    },
    {
        name: 'myPrelim',
        term: 'prefinal',
    },
    {
        name: 'myFinal',
        term: 'final',
    }
]
// Watcher for each checkbox
watch(prelim, updateFilteredArray);
watch(midTerm, updateFilteredArray);
watch(prefinal, updateFilteredArray);
watch(final, updateFilteredArray);

// Function to filter myArray based on checkbox values
function updateFilteredArray() {
    
    subjectCodeQuestions.value = subjectCodeQuestions.value.filter(item => {
        return (
            (prelim.value && item.term === 'prelim') ||
            (midTerm.value && item.term === 'midterm') ||
            (prefinal.value && item.term === 'prefinal') ||
            (final.value && item.term === 'final')
        );
    });
}

// Define computed property to hold filtered array
const filteredArray = ref([]);

// Initial call to updateFilteredArray
updateFilteredArray();


const allTerm = ref(false);
const allTermsSelected = ref(false)
watch(allTerm,(val)=>{
        prelim.value = val
        midTerm.value = val
        prefinal.value = val
        final.value = val
        allTermsSelected.value = val
})
const questionTotalCoumt = ref('')
function getQuestionTotalCount(count){
    questionTotalCoumt.value = count
}

</script>