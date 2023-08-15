<template>
    <div class="relative px-4 h-full p-4">
            <div class="bg-white rounded-lg shadow relative md:w-10/12 lg:w-9/12 mx-auto">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        <span>Create new Invoice</span>
                    </h3>
                    <router-link :to="{name:'invoice'}" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="add-Doctor-modal">
                        back
                    </router-link>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3 relative">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Customer</span>
                                <i v-if="errors['customer_id']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="text" v-model="customer" @keyup="showOption()" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="Customer name">
                            <div class="bg-gray-400 border border-cyan-600 rounded-md max-h-[26vh] min-h-fit absolute top-[4.5rem] w-full overflow-y-auto" v-if="show && customers.length>0">
                                <div class="data p-2 h-[5vh] bg-white hover:bg-gray-100 cursor-pointer border-b" v-for="(item,index) in customers" :key="index" @click="chooseOption(item)">
                                    {{ item.name }}
                                </div>
                            </div>
                            <div class="text-xs text-red-600 mt-1 uppercase" v-if="errors['customer_id']">{{ errors['customer_id'][0] }}</div>
                        </div>
    
                        <div class="col-span-6 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Invoice Date</span>
                                <i v-if="errors['invoice_date']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="date" v-model="form.invoice_date" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                            <div class="text-xs text-red-600 mt-1 uppercase" v-if="errors['invoice_date']">{{ errors['invoice_date'][0] }}</div>
                        </div>
    
    
                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex items-center gap-x-2">
                                <span>Done</span>
                                <input type="checkbox" v-model="form.done" class="outline-none shadow-sm text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block p-2.5" placeholder="done">
                                <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                    <i v-if="errors['done']" class="fa-solid fa-circle-exclamation text-lg text-red-600 mt-1"></i>
                                </label>
                            </div>
                            <div class="text-xs text-red-600 mt-1 uppercase" v-if="errors['done']">{{ errors['done'][0] }}</div>
                        </div>
    
                    </div>
                </div>
    
                <div class="items-center p-6 border-t border-gray-200 rounded-b">
                    <button @click="store" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Add Doctor</button>
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
    customer_id : "" ,
    invoice_date : "" ,
    done : false
})


const router=useRouter()
const errors = ref([])
const show = ref(false)
const customers = ref([])
const customer = ref('')
const customerCheck = ref('')

//Show
const showOption = async ()=>{
    if(customer.value != ''){
        customerCheck.value == customer.value
        show.value=true
        await $axios.get('/customer?q='+customer.value).then(({data})=>{
            $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
            customers.value=data.data
        }).catch((error)=>{
            console.log(error)           
        })
    }else{
        customerCheck.value == ''
        show.value=false
        await $axios.get('/customer?q=').then(({data})=>{
            $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
            customers.value=data.data
        }).catch((error)=>{
            console.log(error)           
        })
    }
}

//Choose
const chooseOption = (e)=>{
    form.value.customer_id=e.id
    customerCheck.value=''
    customer.value=e.name
    show.value=false
}


//Store
const store = async ()=>{
    errors.value=[]
    form.value.done == false?form.value.done = '0' : form.value.done = '1';
    await $axios.post('/invoice',form.value).then(({data})=>{
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
        customer_id :"" ,
        invoice_date : "" ,
        done : false
    })

    customer.value=''
    customerCheck.value=''
        

    }).catch((error)=>{
        form.value.done == '0'?form.value.done = false : form.value.done = true;
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


onMounted(async()=>{
    await $axios.get('/customer?q=').then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        customers.value=data.data
    }).catch((error)=>{
        console.log(error)           
    })
})
</script>

