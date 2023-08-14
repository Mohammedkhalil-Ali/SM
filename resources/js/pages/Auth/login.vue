<template>
   <main class="bg-gray-50">
      <div class="mx-auto md:h-screen flex flex-col justify-center items-center px-6 pt-8 pt:mt-0">
        <div class="bg-white shadow rounded-lg md:mt-0 w-full sm:max-w-screen-sm xl:p-0">
            <div class="p-6 sm:p-8 lg:p-16 space-y-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900">
                    Login to <span class="text-red-600">Smart</span>Med
                </h2>
                <div class="text-red-500" v-if="errors['message']">{{ errors['message'] }}</div>
                    <div>
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2">Email</label>
                        <input type="email" v-model="form.email" id="email" class="bg-gray-50 outline-none border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" placeholder="Example@gmail.com" required>
                        <div class="text-sm text-red-600" v-if="errors['email']">{{ errors['email'][0] }}</div>
                    </div>
                    <div>
                        <label for="password" class="text-sm font-medium text-gray-900 block mb-2">password</label>
                        <input type="password"  id="password" v-model="form.password" placeholder="********" class="bg-gray-50 outline-none border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-red-600 focus:border-red-600 block w-full p-2.5" required>
                        <div class="text-sm text-red-600" v-if="errors['password']">{{ errors['password'][0] }}</div>
                    </div>
    
                    <button type="submit"  @click="login" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-200 font-medium rounded-lg text-base px-5 py-3 w-full sm:w-auto text-center">Login to your account</button>
            </div>
         </div>
      </div>
    </main>
</template>
    
    
<script setup>
import { inject, onMounted, ref } from "@vue/runtime-core";
import {useRouter} from 'vue-router'
import authStore from '../../Stores/auth'
const $axios = inject('$axios');

const form = ref({
    email:'',
    password:''
})


const AuthStore = authStore()
const router = useRouter();

const errors = ref([])
const login = async ()=>{
    errors.value=[]
    await $axios.post('/login',form.value).then(({data})=>{
        AuthStore.setUser(data.user)
        localStorage.setItem('token', data.token)
        $axios.defaults.headers.common["Authorization"] ="Bearer " + data.token;
        router.push('/home')

    }).catch((error)=>{
        console.log(error)
        let errorsData= error.response.data.errors
        if(typeof errorsData != 'undefined'){
            errors.value = errorsData;
        }
    })
}

</script>