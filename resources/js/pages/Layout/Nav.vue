<template>
    <nav class="bg-white border-b border-gray-200 fixed z-30 w-full">
       <div class="px-3 py-1 lg:px-5 lg:pl-3">
           <div class="flex items-center justify-between">
               <div class="flex items-center justify-start">
                   <router-link to="/" class="text-xl font-bold flex items-center ">
                       <p>Smart<span class="text-red-600">Med</span></p>
                   </router-link>

                       <i @click="menu" :class="navbar?'rotate-180':''" class="fa-solid fa-caret-right hidden lg:block ml-16 text-gray-600 hover:text-gray-900 cursor-pointer p-2 rounded transition-all duration-500"></i>
                       <i @click="menuMobile" :class="navmobile?'rotate-180':''" class="fa-solid fa-caret-right lg:hidden ml-16 text-gray-600 hover:text-gray-900 cursor-pointer p-2 rounded transition-all duration-500"></i>
                   
               </div>
               <div class="flex items-center">
                   <div class="flex items-center">
                       <div>
                           <button
                               @click="logoutModal = !logoutModal"
                               class="hidden flex justify-between items-center sm:inline-flex ml-5 text-black bg-gray-100 w-40 hover:bg-gray-200  font-medium rounded-lg text-sm px-2 py-2.5 text-center items-center mr-3 space-x-1">
                               <div class="flex items-center space-x-1">
                                   <i class="fas fa-user w-8 h-8 text-lg rounded-full text-red-600 bg-white flex items-center justify-center"></i>
                                  {{ name.name }}
                               </div>
                               <i class="fas fa-arrow-down"></i>
                           </button>
                           <div v-if="logoutModal" class="absolute  rounded-lg shadow bg-white overflow-hidden mt-1 w-36 ml-7">
                               <button class="text-center hover:bg-gray-600 hover:text-white w-full p-2" @click="logout"> <i class="fas fa-sign-out"></i> Logout</button>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>

   </nav>

</template>


<script setup>
import { inject, onMounted, provide, ref ,computed} from "@vue/runtime-core";
import  menuStore  from '../../Stores/menuStore'
import authStore from '../../Stores/auth'
import { useRouter } from "vue-router"
const $axios = inject('$axios');

    const router=useRouter()
    const authentication = authStore()
    const name = computed(() => authentication.user)

    const menues=menuStore()
    const navbar = computed(() => menues.nav)
    const navmobile = computed(() => menues.navmobile)



   const logout = async ()=>{
        await $axios.post('/logout').then(({data})=>{
            $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
            authentication.setUser([])
            localStorage.removeItem('token')
            router.push('/login')

    }).catch((error)=>{
        console.log(error)
    })
   }


   onMounted(async ()=>{
    await $axios.get('/user').then(({data})=>{
        authentication.setUser(data.user)

    }).catch((error)=>{
        console.log(error)
    })
   })

   const logoutModal= ref(false)
  

   const menu = ()=>{
    menues.setNav()
   }

   const menuMobile = ()=>{
    menues.setNavMobile()
   }

   window.addEventListener('click', (e) => {

           
    })

</script>
