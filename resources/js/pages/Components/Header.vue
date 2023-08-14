<template>
    <div>
        <div class="w-full h-20 bg-white flex justify-between items-center">
            <p class="ml-10 text-gray-700 cursor-pointer"><i class="fa-solid fa-house"></i>&nbsp;&nbsp;&nbsp; Dashboard <span v-if="props.name">&nbsp;&nbsp;>&nbsp;&nbsp; {{ props?.name }}</span></p>
        </div>
        <hr>
            <div class="w-full h-20 bg-white flex justify-between items-center" v-if="props.name">

            <p class="ml-10 text-gray-700" v-if="props.name">All {{ props.name }}</p>
            
            <div class="flex" v-if="props.customers">
                <router-link :to="{name:props?.customers}" >
                    <p class="mr-2 bg-cyan-500 rounded-md p-2 outline-none hover:bg-cyan-600 text-white cursor-pointer"> Back to customers</p>
                </router-link>
                <router-link :to="{ name: props?.route_name, params: { 'customer_id': props.customer_id }}">
                    <p class="mr-2 bg-cyan-600 rounded-md p-2 outline-none hover:bg-cyan-700 text-white cursor-pointer">+ Add {{ props?.name }}</p>
                </router-link>
            </div>
            <div class="flex" v-else>
                <router-link :to="{name:props?.route_name}"  v-if="props.route_name">
                    <p class="mr-2 bg-cyan-600 rounded-md p-2 outline-none hover:bg-cyan-700 text-white cursor-pointer">+ Add {{ props?.name }}</p>
                </router-link>
            </div>

            
        </div>
    </div>
</template>

<script setup>
    const props=defineProps(['name','route_name','customers','customer_id']);
</script>