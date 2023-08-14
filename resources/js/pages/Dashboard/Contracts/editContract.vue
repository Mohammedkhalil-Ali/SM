<template>
    <div class="relative px-4 h-full p-4">
            <div class="bg-white rounded-lg shadow relative md:w-10/12 lg:w-9/12 mx-auto">
                <div class="flex items-start justify-between p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold">
                        <span>Edit contract</span>
                    </h3>
                    <router-link :to="{ name: 'contract', params: { 'customer_id':customer_id }}" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        back
                    </router-link>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-9 gap-6">
                        <div class="col-span-4 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Start date</span>
                                <i v-if="errors['start_date']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="date" v-model="form.start_date" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['start_date']">{{ errors['start_date'][0] }}</div>
                        </div>
    
                        <div class="col-span-4 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Expire date</span>
                                <i v-if="errors['expire_date']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="date" v-model="form.expire_date" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['expire_date']">{{ errors['expire_date'][0] }}</div>
                        </div>
    
    
                        <div class="col-span-4 sm:col-span-3">
                            <label  class="text-sm font-medium text-gray-900 block mb-2 flex justify-between items-center">
                                <span>Payment Number</span>
                                <i v-if="errors['payment']" class="fa-solid fa-circle-exclamation text-lg text-red-600"></i>
                            </label>
                            <input type="text" v-model="form.payment" class="outline-none shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full p-2.5" placeholder="xxxxxxxxxxxxx">
                            <div class="text-sm text-red-600 mt-1" v-if="errors['payment']">{{ errors['payment'][0] }}</div>
                        </div>


                        <div class="col-span-12 sm:col-span-10">
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
                    <div class="flex items-center space-x-2">
                        <button @click="update" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Update Customer</button>
                        <button @click="deleteData" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="submit">Delete Customer</button>
                    </div>
                </div>
            </div>
    
            </div>
</template>

<script setup>
    import { inject,onMounted , reactive , ref } from "@vue/runtime-core";
    import { useRoute, useRouter } from "vue-router";
    const $axios = inject('$axios');
    import Swal from 'sweetalert2'

    const route = useRoute()
    const router = useRouter()
    
    const customer_id= ref(route.params.customer_id)
    const contract_id= ref(route.params.contract_id)

    const form = ref({
        payment : "" ,
        start_date : "" ,
        expire_date :"" ,
        note : "",
        customer_id : customer_id
    })
    
    const errors = ref([])
    
    //edit
    
    const update = async ()=>{
        errors.value=[]
        await $axios.put('/contract/'+route.params.contract_id+'?_method=put',form.value).then(({data})=>{
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
            title: 'Updated successfully'
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
            title: 'Something was wrong'
            })
            console.log(error)
            let errorsData= error.response.data.errors
            if(typeof errorsData != 'undefined'){
                errors.value = errorsData;
            }
        })
    }
    
    //delete
    const deleteData = async()=>{
        errors.value=[]
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then(async(result) => {
            if (result.isConfirmed) {
            await $axios.post('/contract/'+route.params.contract_id+'?_method=delete',form.value).then(({data})=>{
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
            title: 'Deleted successfully'
            })

            
            router.push({name:'contract',params:{'customer_id':route.params.customer_id}})
        })
    }
})


       
    }
    
    onMounted(async ()=>{
        await $axios.get("contract/"+route.params.contract_id+'?customer_id='+route.params.customer_id).then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        form.value.payment = data.data.payment 
        form.value.start_date = data.data.start_date 
        form.value.expire_date = data.data.expire_date 
        form.value.note = data.data.note
        form.value.customer_id =data.data.customer_id 
        }).catch((error)=>{
            console.log(error)
        })
    })
    
</script>
