<template>
    <div>
        <Nav />

        <div class="flex overflow-hidden bg-white pt-16">
            <Aside />
            
            <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto" :class="[navbar?'lg:ml-60':'lg:ml-[4.5rem]']">
                <main class="min-h-[90vh]">
                    <router-view></router-view>
                </main>
            </div>
        </div>
    </div>
</template>
<script setup>
import Nav from '../Layout/Nav.vue'
import Aside from '../Layout/Aside.vue'

import { ref , computed  } from '@vue/runtime-core'
import  menuStore  from '../../Stores/menuStore'

const menes=menuStore()
const navbar = computed(() => menes.nav)

</script>
