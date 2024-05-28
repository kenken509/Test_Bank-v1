<template>
    <DashboardLayout>
        <div class="flex items-center justify-between border-bot-only py-4 mb-6">
            <span class="text-[20px] font-bold text-gray-500 ">New Question Page </span> 
        </div>
        <form>    
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
                            <textarea v-model="form.question" cols="50" rows="5" class="w-full rounded-md" placeholder="Type your question here."></textarea>
                        </div>
                        <div class="flex justify-center items-center lg:justify-start  mt-auto mb-2">
                            <div class="flex flex-col w-[160px] justify-center items-center gap-2"> 
                                <img :src="attachedImagePreviewUrl || (imageUrl + 'image_attachment.png') " alt="Image attachment" class="border border-gray-400 rounded-md shadow-md max-w-[150px] max-h-[150px]"/>
                                <input @change="handleAttachedImageChange"  type="file" ref="fileInput" accept=".jpg, .jpeg" hidden/>

                                <button @click="triggerFileInput" type="button" class="bg-gray-200 hover:bg-gray-300 border border-gray-800 p-2 max-w-[150px] w-full rounded-md">Add Image</button>
                            </div>
                            <span v-if="attachedImageValidator" class="text-red-500 ml-2">{{ attachedImageValidator }}</span>
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
                            <div v-if="imageTab" class=" flex-grow border-b-2 border-gray-300 rounded-b-md shadow-sm p-2">
                                <div class="grid grid-cols-2 p-2">
                                    <div class="col-span-2 lg:col-span-1 flex items-center justify-center   py-2 gap-2 ">
                                        <input type="radio"  id="image_option_a" name="image_options"/>
                                        <div class="flex flex-col ml-2">
                                            <input type="file"  hidden/>
                                            <img :src="imageUrl+'no_image.png'" alt="Image option" class="border border-gray-400 rounded-md shadow-md max-w-[122px] max-h-[122px]"/>
                                            <button type="button" class="bg-gray-200 hover:bg-gray-300 p-2 mt-2 border border-gray-800 rounded-md">Add Image</button>
                                        </div>
                                    </div>   
                                    <div class="col-span-2 lg:col-span-1 flex items-center justify-center  py-2 gap-2 ">
                                        <input type="radio"  id="image_option_a" name="image_options"/>
                                        <div class="flex flex-col ml-2">
                                            <input type="file"  hidden/>
                                            <img :src="imageUrl+'no_image.png'" alt="Image option" class="border border-gray-400 rounded-md shadow-md max-w-[122px] max-h-[122px]"/>
                                            <button type="button" class="bg-gray-200 hover:bg-gray-300 p-2 mt-2 border border-gray-800 rounded-md">Add Image</button>
                                        </div>
                                    </div>   
                                    <div class="col-span-2 lg:col-span-1 flex items-center justify-center  py-2 gap-2 ">
                                        <input type="radio"  id="image_option_a" name="image_options"/>
                                        <div class="flex flex-col ml-2">
                                            <input type="file"  hidden/>
                                            <img :src="imageUrl+'no_image.png'" alt="Image option" class="border border-gray-400 rounded-md shadow-md max-w-[122px] max-h-[122px]"/>
                                            <button type="button" class="bg-gray-200 hover:bg-gray-300 p-2 mt-2 border border-gray-800 rounded-md">Add Image</button>
                                        </div>
                                    </div>   
                                    <div class="col-span-2 lg:col-span-1 flex items-center justify-center  py-2 gap-2 ">
                                        <input type="radio"  id="image_option_a" name="image_options"/>
                                        <div class="flex flex-col ml-2">
                                            <input type="file"  hidden/>
                                            <img :src="imageUrl+'no_image.png'" alt="Image option" class="border border-gray-400 rounded-md shadow-md max-w-[122px] max-h-[122px]"/>
                                            <button type="button" class="bg-gray-200 hover:bg-gray-300 p-2 mt-2 border border-gray-800 rounded-md">Add Image</button>
                                        </div>
                                    </div>                            
                                </div>
                            </div>
                            <div class="ml-6 mb-2">
                                <button type="button" @click="textTabClicked" class=" p-2 border border-t-0 border-gray-400 rounded-bl-lg  hover:font-bold hover:text-gray-400 " :class="{'bg-blue-800 text-white hover:text-gray-100 hover:font-normal': textTab, 'bg-gray-200 ': !textTab}">Text</button>
                                <button type="button" @click="imageTabClicked" class="p-2 border border-t-0 border-gray-400 rounded-br-lg  hover:font-bold hover:text-gray-400 " :class="{'bg-blue-800 text-white hover:text-gray-100 hover:font-normal': imageTab, 'bg-gray-200 ': !imageTab}">Image</button>
                            </div>
                        </div>
                    </div>
                    
                    <!--right container-->
                </div>
            </div>
            <div class="my-4">
                <button type="submit" class="bg-blue-800 hover:bg-blue-700 rounded-md w-full p-2 text-gray-100">Submit</button>
            </div>
        </form>
        
 
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '../DashboardLayout.vue';
import {ref, watch} from 'vue'
import { useForm,usePage } from '@inertiajs/vue3';


const user = usePage().props.user
const form = useForm({
    question:'',
    type:'',
    attached_image:'',
    term:'',
    subject_code_id:'',
    author_id:user.id,
    options:[],
})
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


//watchers
watch(selectedSubjectCode,(code)=>{
    form.subject_code_id = code.id
})


//image logic
const triggerFileInput = ()=>{
    fileInput.value.click();
   
}


const handleAttachedImageChange = (event) => {
   
    const file = event.target.files[0];
    

    if(file)
    {
        if(!['image/jpeg'].includes(file.type))
        {
            attachedImageValidator.value = 'Only JPG files are allowed.'
            form.attached_image = ''
            return;
        }
        
        if(file.size > 1024 * 1024)
        {
            attachedImageValidator.value = 'File size should be less than 1MB.'
            form.attached_image = '';
            return;
        }

        form.attached_image = file.name;
        attachedImageValidator.value = ''
        attachedImagePreviewUrl.value = URL.createObjectURL(file);
        console.log('attached image: '+form.attached_image);
        console.log('size: '+file.size)
    }
    else
    {
        console.log('no file selected');
        attachedImageValidator.value = 'No file selected.'
    }
    
};


// validators
const attachedImageValidator = ref('');

//image urls
const attachedImagePreviewUrl = ref('');
</script>