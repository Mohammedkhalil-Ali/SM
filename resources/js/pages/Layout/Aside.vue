<template>
    <aside id="sidebar"
           class="fixed z-20 h-full left-[-100%] lg:top-0 lg:left-0 pt-16 hidden lg:flex flex-shrink-0 flex-col transition-width duration-75"
           :class="navbar?'w-60':'w-[4.5rem]'"
           aria-label="Sidebar">
           <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
               <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                   <div class="flex-1 px-3 bg-white divide-y space-y-1">
                       <ul class="space-y-2 pb-2 mt-2">
                           <li v-for="(item, index) in routes" :key="index">
                               <router-link :to="{name:item.route_name}"
                                   class="text-base text-gray-900 font-normal rounded flex items-center p-2 pl-3 hover:bg-gray-100 group " :class="item.links.includes(route.name)? 'bg-cyan-600 hover:bg-cyan-700 text-white hover:text-white' : ''">
                                   <i class="text-xl" :class="[item.icon, item.links.includes(route.name)? 'text-white group-hover:text-white' : ' text-gray-500',item.route_name=='invoice'?'ml-1':'']"></i>
                                   <span v-if="navbar" class="ml-3">{{ item.name }}</span>
                               </router-link>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
       </aside>

       <!-- For Mobile  --> 

       <aside id="sidebar"
            class="fixed lg:hidden  w-full z-20 min-h-screen bg-white text-gray-600 lg:top-0 flex-shrink-0 flex-col transition-width duration-500 ease-in-out overflow-y-auto"
            :class="navmobile?'left-0':'left-[-100%]'"
            aria-label="Sidebar">
            <div class="relative flex-1 flex flex-col min-h-screen border-r border-gray-200 pt-0 bg-white'">
                <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                    <div class="flex-1 px-3 divide-y space-y-1 bg-white'">
                        <ul class="space-y-2 pb-2 mt-2">
                            <li v-for="(item, index) in routes" :key="index">
                                <router-link :to="{name:item.route_name}"
                                   class="text-base text-gray-900 font-normal rounded flex items-center p-2 pl-3 hover:bg-gray-100 group " :class="item.links.includes(route.name)? 'bg-cyan-600 hover:bg-cyan-700 text-white hover:text-white' : ''">
                                   <i class="text-xl" :class="[item.icon, item.links.includes(route.name)? 'text-white group-hover:text-white' : ' text-gray-500']"></i>
                                   <span v-if="navmobile" class="ml-3">{{ item.name }}</span>
                               </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

</template>
<script setup>
import { inject, onMounted, ref,computed } from "@vue/runtime-core"
import  menuStore  from '../../Stores/menuStore'
import { useRoute } from "vue-router"
const route=useRoute()

const menues=menuStore()
const navbar = computed(() => menues.nav)
const navmobile = computed(() => menues.navmobile)

let routes= ref([
    {route_name: 'home', icon: 'fas fa-dashboard', name:'Home', links:['home']},
    {route_name: 'customers', icon: 'fas fa-user', name:'Customers', links:['customers','customers.create','customers.edit','contract','contract.create','contract.edit']},
    {route_name: 'invoice-item', icon: 'fa-solid fa-circle-info', name:'Invoice items', links:['invoice-item','invoice-item.create','invoice-item.edit']},
    {route_name: 'invoice', icon: 'fa-solid fa-file-lines', name:'Invoices', links:['invoice','invoice.create','invoice.edit']},
])

const removeNav = ()=>{
    menues.setNavMobile()
}

</script>
