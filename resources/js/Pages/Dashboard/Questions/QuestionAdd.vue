<template>
    <DashboardLayout>
        <div class="flex items-center justify-between border-bot-only py-4 mb-6">
            <span class="text-[20px] font-bold text-gray-500 ">New Question Page </span> 
        </div>
        
        <div class="" >  
            <div  class=" flex w-full mb-4 flex-col lg:flex-row ">
                <div class="flex items-center w-[150px] ">
                    <span class="font-semibold text-lg py-2 " >Subject Code : </span>
                </div>
                
                <select v-model="selectedSubjectCode" id="subjectCodeSelect" class="rounded-md border-gray-400 shadow-md hover:cursor-pointer ">
                    <option value="" hidden>Select subject code</option>
                    <option v-for="code in data.subjectCodes" :key="code.id" :value="code">
                        {{ code.name }}
                    </option>
                </select>
            </div>
            
           
            <div class=" flex flex-col lg:flex-row w-full mb-4">
                <div class="flex items-center w-[150px] ">
                    <span class="font-semibold text-lg py-2 " >Description : </span>
                </div>
                
                <input type="text" disabled :value="selectedSubjectCode.description" class="rounded-md w-[100$] lg:w-[60%] bg-gray-100 "/>
            </div>
            <hr class="border-gray-400  mb-4">
            <div class="flex flex-col lg:flex-row gap-2  h-full">
                <!--left container-->
                <div class="w-full lg:w-[60%] border flex flex-col border-gray-900 p-2 rounded-md shadow-md">
                    <div>
                        <textarea cols="50" rows="5" class="w-full rounded-md" placeholder="Type your question here."></textarea>
                    </div>
                    <div class="flex justify-center lg:justify-start  mt-auto mb-2">
                        <div class="flex flex-col w-[160px] justify-center items-center gap-2">
                            <img :src="imageUrl+'image_attachment.png'" alt="Image attachment" class="border border-gray-400 rounded-md shadow-md max-w-[150px] max-h-[150px]"/>
                            <input type="file" ref="fileInput" hidden/>

                            <button @click="triggerFileInput" class="bg-gray-200 p-2 max-w-[150px] w-full rounded-md">Add Image</button>
                        </div>
                        
                    </div>
                </div>
                <!--left container-->
                
                <!--right container-->
                <div class="w-full lg:w-[40%] border flex flex-col rounded-md border-gray-900 px-2 shadow-md">
                    <div class="flex flex-col flex-grow " >
                        <div v-if="textTab" class=" flex-grow border-b-2 border-gray-300 rounded-b-md shadow-sm p-2">
                            <div class="flex items-center gap-2 py-2">
                                <input type="radio"  id="option_a" name="options"/>
                                <textarea cols="10" rows="2" class="w-full"></textarea>
                            </div>
                            <div class="flex items-center gap-2 py-2">
                                <input type="radio"  id="option_b" name="options"/>
                                <textarea cols="10" rows="2" class="w-full"></textarea>
                            </div>
                            <div class="flex items-center gap-2 py-2">
                                <input type="radio"  id="option_c" name="options"/>
                                <textarea cols="10" rows="2" class="w-full"></textarea>
                            </div>
                            <div class="flex items-center gap-2 py-2">
                                <input type="radio"  id="option_d" name="options"/>
                                <textarea cols="10" rows="2" class="w-full"></textarea>
                            </div>
                        </div>
                        <div class="ml-6 mb-2  ">
                            <button @click="textTabClicked" class="bg-gray-200 p-2 border border-t-0 border-gray-400 rounded-bl-lg hover:bg-gray-300 hover:font-bold hover:text-gray-800 transition-all" :class="{'pb-3':textTab}">Text</button>
                            <button @click="imageTabClicked" class="bg-gray-200 p-2 border border-t-0 border-gray-400 rounded-br-lg hover:bg-gray-300 hover:font-bold hover:text-gray-800 transition-all">Image</button>
                        </div>
                    </div>
                </div>
                
                <!--right container-->
            </div>
            
            
        </div>

    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue';
import {ref} from 'vue'

const data = defineProps({
    subjectCodes:Array,
})

const questionType = ref([
    'text',
    'image',
])

const selectedSubjectCode = ref('');
const imageUrl  = ref('/storage/images/');
const textTab   = ref(true)
const imageTab  = ref(false)

const imageTabClicked = ()=>{
    imageTab.value = true
    textTab.value = false
}

const textTabClicked = ()=>{
    textTab.value = true
    imageTab.value = false
}
const fileInput = ref('')
const triggerFileInput = ()=>{
    fileInput.value.click();
    
}
</script>