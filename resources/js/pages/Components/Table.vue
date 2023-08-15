<template>
    <div class="w-full min-h-screen bg-white">
        <div class="ml-10 mr-2 flex justify-start gap-x-4 md:gap-x-0 md:justify-between items-center">

                <!-- record size -->

                <div class="flex items-center space-x-3 mb-2">
                    <span>Show</span>
                    <select v-model="show" class="bg-gray-100 px-4 w-20 py-2 rounded border" @change="load(show,search)">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Show 100 entries</span> 
                </div>

                <!-- search -->

                <div class="flex items-center">
                    <div class=" lg:block lg:pl-32 mb-4">
                        <label for="topbar-search" class="sr-only">Search
                        </label>
                        <div class="mt-1 relative lg:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input  id="topbar-search"
                            v-model="search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-cyan-600 focus:border-cyan-600 block w-full pl-10 p-2.5"
                                placeholder="Search">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Table -->

            <div class="ml-10 mt-2 mr-2" :class="props?.tableHead?.length > 7 ? 'overflow-x-scroll' : ''">
                <div :class="props?.tableHead?.length > 7 ? 'min-w-[1640px] ' : ''">
                 
                    <div class="flex flex-col">
                        <div class="overflow-x-auto">
                            <div class="align-middle inline-block min-w-full">
                                <div class="shadow overflow-hidden">
                                    <table class="table-fixed min-w-full divide-y divide-gray-200">
                                        <thead  class="bg-gray-100">
                                            <tr>
                                                <th  scope="col" class=" text-left text-sm text-gray-500 uppercase border-l"  v-for="(item, index) in props.tableHead" :key="index">
                                                    <div class="flex justify-between p-4" role="button">
                                                        <span class="text-cyan-600"> {{ item }}</span>
                                                    </div>
                                                </th>
                                              
                                                <th  class=" text-sm uppercase w-28 border-l text-cyan-600" v-if="props.contract">
                                                    Contract
                                                </th>
                                                <th scope="col" class=" text-sm uppercase w-20 border-l text-cyan-600">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class=" divide-y bg-white divide-gray-200">
                                            <tr  class="hover:bg-gray-100" v-for="(item, index) in tbodyData" :key="index">
                                                <td  class="whitespace-nowrap text-base font-medium text-gray-900 border-x"  v-for="(td, intd) in theadData" :key="intd"  :class="td=='note'?'p-0':'p-4 '">
                                                    <div>
                                                        <span v-if="(typeof td != 'object') && td=='done'">{{ item[td]==0?'Not Done':'Done' }} </span>
                                                        <textarea v-if="(typeof td != 'object')&& td=='note'" cols="20" rows="4" class="w-full resize-none"> {{ item[td] }}</textarea>
                                                        <span v-if="(typeof td != 'object')&& td!='done' && td!='note'">{{ item[td] }} </span>
                                                        <!-- for relation -->
                                                        <span v-else-if="(typeof td == 'object') && td.length==2 ">{{ (item[td[0]])?.[td[1]]  }}</span>
                                                        <span v-else-if="(typeof td == 'object') && td.length==3 ">{{ (item[td[0]])?.[td[1]]?.[td[2]] }}</span>
                                                    </div>
        
                                                </td>
                                                
                                                <td class="border-x p-1" v-if="props.contract">
                                                    <router-link 
                                                        :to="{
                                                            name: 'contract',
                                                            params: {
                                                                'customer_id': item['id'] 
                                                                }
                                                            }" 
                                                        class="cursor-pointer w-28 text-white text-center focus:ring-4 focus:ring-cyan-200 font-medium rounded text-sm flex items-center px-2  py-2 justify-center ">
                                                        <p class="text-cyan-600 underline text-center">Contract</p>
                                                    </router-link>
                                                </td>

                                                <td class=" p-1 flex items-center mt-2 w-20" v-if="props.editcontract">
                                                    <router-link 
                                                        :to="{ 
                                                            name: 'contract.edit',
                                                            params: { 
                                                                customer_id: item['customer_id'],
                                                                contract_id: item['id'] 
                                                                }
                                                            }"
                                                        class=" cursor-pointer w-10 ml-5 text-white bg-cyan-600 text-center hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded text-sm flex items-center px-2  py-2 justify-center ">
                                                        <i class="fas fa-pen"></i>
                                                    </router-link>
                                                </td>

                                                <td class=" p-1 flex items-center mt-2 w-20" v-else>
                                                    <router-link :to="props.edit+item['id']+'/edit'" class=" cursor-pointer w-10 ml-5 text-white bg-cyan-600 text-center hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 font-medium rounded text-sm flex items-center px-2  py-2 justify-center ">
                                                        <i class="fas fa-pen"></i>
                                                    </router-link>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 
            <!-- Pagination -->

            <div class="flex ml-10 mt-5 items-center justify-between mr-2" v-if="tbodyData?.length > 0">
                <p >Showing <span>{{ show }} </span> of {{ dataForTable?.total }}  entries</p>
                <div class="flex flex-wrap space-x-2 mt-3 items-center">

                    <div>
                        <button
                            :disabled="dataForTable.prev_page_url == null"
                            @click="load(show, search ,  --dataForTable.current_page)"
                            class="btn mx-1 cursor-pointer"
                        >Previous</button>
                    </div>

                    <div v-for="(item, index) in dataForTable.links" :key="'page'+index" >
                        <button
                            @click="item.url != null? load(show,search, item.label) : ''"
                            v-if="index!=0 && index!= dataForTable.links.length-1"
                            :class="[ item.active?'bg-cyan-600 text-white' : ' text-cyan-600']"
                            class="px-3 py-1 rounded"
                            v-html="item.label"
                        />
                    </div>

                    <button 
                            :disabled="dataForTable.next_page_url == null"
                            @click="load(show,search, ++dataForTable.current_page)"
                            class="btn mx-1 cursor-pointer"
                        >Next</button>

                </div>
            </div>

        </div>
</template>

<script setup>
import { inject, onMounted, ref,computed,watch  } from '@vue/runtime-core'
const props = defineProps(['theadData','tableHead','url','doctor','edit','contract','editcontract'])
const $axios = inject('$axios');
import debounce from "lodash.debounce";

let search = ref('')
let show = ref(100)
let tbodyData = ref([])
let dataForTable = ref([])

const debouncedWatch = debounce( async () => {
    await $axios.get(props.url+"record="+show.value+'&q='+search.value+'&page=').then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        tbodyData.value=data.data.data
        dataForTable.value=data.data
        console.log(data.data);
    }).catch((error)=>{
        console.log(error)
    })
}, 300);

watch(search, debouncedWatch);

const load = async (number,q,page)=>{
    await $axios.get(props.url+"record="+number+'&q='+q+'&page='+page).then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        tbodyData.value=data.data.data
        dataForTable.value=data.data
        console.log(data.data.data);
        console.log(data.data);
    }).catch((error)=>{
        console.log(error)
    })
}


onMounted( async ()=>{
    await $axios.get(props.url+"record="+show.value).then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        tbodyData.value=data.data.data
        dataForTable.value=data.data
        console.log(data.data.data);
        console.log(data.data);
    }).catch((error)=>{
        console.log(error)
    })
})

 </script>