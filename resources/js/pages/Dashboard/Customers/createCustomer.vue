<template>
    <div class="relative px-4 h-full p-4">
            <div class="bg-white rounded-lg shadow relative md:w-10/12 lg:w-9/12 mx-auto">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        <span>Create new customer</span>
                    </h3>
                    <router-link :to="{name:'customers'}" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        back
                    </router-link>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Name</span>
                                <i v-if="errors['name']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="text" v-model="form.name" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Example">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['name']">{{ errors['name'][0] }}</div>
                        </div>
    
                        <div class="col-span-6 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Address</span>
                                <i v-if="errors['address']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="text" v-model="form.address" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['address']">{{ errors['address'][0] }}</div>
                        </div>
    
    
                        <div class="col-span-6 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Phone Number</span>
                                <i v-if="errors['phone_number']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="text" v-model="form.phone_number" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="07** 123-4567">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['phone_number']">{{ errors['phone_number'][0] }}</div>
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Start date</span>
                                <i v-if="errors['start_date']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="date" v-model="form.start_date" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['start_date']">{{ errors['start_date'][0] }}</div>
                        </div>


                        <div class="col-span-12 sm:col-span-6">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Note</span>
                                <i v-if="errors['note']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <textarea name="" v-model="form.note" id="" cols="10" rows="5" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5"></textarea>
                            <div class="text-sm text-red-600 mt-1" v-if="errors['note']">{{ errors['note'][0] }}</div>
                        </div>
    
    
                    </div>
                </div>
    
                <div class="items-center p-6 border-t border-gray-200 rounded-b">
                    <button @click="store" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Add Customer</button>
                </div>
    
    
            </div>
        </div>
</template>

<script setup>
import { inject, onMounted , reactive , ref } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";
import Swal from 'sweetalert2'
const $axios = inject('$axios');

const form = ref({
    name : "" ,
    address : "" ,
    phone_number :"" ,
    start_date : "" ,
    note : ""
})

const router=useRouter()
const errors = ref([])

//Store
const store = async ()=>{
    errors.value=[]
    await $axios.post('/customers',form.value).then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Stored successfully'
        })

        
        form.value = ref({
            name : "" ,
            address : "" ,
            phone_number :"" ,
            start_date : "" ,
            note : ""
        })
        

    }).catch((error)=>{
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        color:"red",
        title: 'Something went wrong'
        })
        console.log(error)
        let errorsData= error.response.data.errors
        if(typeof errorsData != 'undefined'){
            errors.value = errorsData;
        }
    })
        
}


</script>
