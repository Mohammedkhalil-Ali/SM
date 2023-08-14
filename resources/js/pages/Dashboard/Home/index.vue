<template>
    <div>
      <div class="mt-2 py-5 border-cyan-600 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mx-2 border-t ">
          <div class="shadow-lg shadow-cyan-600/30 rounded-lg p-4 sm:p-6 xl:p-8 mt-2 ml-5 bg-white text-black'">
              <div class="flex items-center justify-between">
                <h3 class="ml-5 text-xl font-bold flex items-center space-x-3">
                  <i class="text-7xl text-cyan-700/60"></i>
                    <span>Customer</span>
                </h3>
                <div class="flex-shrink-0">
                  <span class="text-2xl sm:text-3xl leading-none font-bold text-cyan-600">{{ customer }}</span>
                </div>
              </div>
          </div>
          <div class="shadow-lg shadow-cyan-600/30 rounded-lg p-4 sm:p-6 xl:p-8 mt-2 ml-5 bg-white text-black'">
              <div class="flex items-center justify-between">
                <h3 class="ml-5 text-xl font-bold flex items-center space-x-3">
                  <i class="text-7xl text-cyan-700/60"></i>
                    <span>Contract</span>
                </h3>
                <div class="flex-shrink-0">
                  <span class="text-2xl sm:text-3xl leading-none font-bold text-cyan-600">{{ contract }}</span>
                </div>
              </div>
          </div>
          <div class="shadow-lg shadow-cyan-600/30 rounded-lg p-4 sm:p-6 xl:p-8 mt-2 ml-5 bg-white text-black'">
              <div class="flex items-center justify-between">
                <h3 class="ml-5 text-xl font-bold flex items-center space-x-3">
                  <i class="text-7xl text-cyan-700/60"></i>
                    <span>Invoice</span>
                </h3>
                <div class="flex-shrink-0">
                  <span class="text-2xl sm:text-3xl leading-none font-bold text-cyan-600">{{ invoice }}</span>
                </div>
              </div>
          </div>
      </div>
    </div>

    <div class="lg:flex h-[40vh] lg:justify-around lg:items-center block text-center mt-4" v-if="customer_this_month">
      <doughnut-chart class="mt-6 lg:mt-40"
      :invoice="invoice" 
      :notdone="invoice_not_done" 
      :done="invoice_done">
      </doughnut-chart>
      <bar-chart class="mt-6 lg:mt-40"
      :customer="customer" 
      :month="customer_this_month" 
      :one="customer_one_month_ago"
      :two="customer_two_month_ago"
      :three="customer_three_month_ago"
      :four="customer_four_month_ago">
    </bar-chart>
    </div>

</template>

<script setup>
    import { inject, onMounted , reactive , ref } from "@vue/runtime-core";
    import DoughnutChart from './doughnut.vue'
    import BarChart from './bar.vue'
    const $axios = inject('$axios')

    const customer = ref('')
    const contract = ref('')
    const invoice = ref('')
    const invoice_done = ref('')
    const invoice_not_done = ref('')
    const customer_this_month = ref('')
    const customer_one_month_ago = ref('')
    const customer_two_month_ago = ref('')
    const customer_three_month_ago = ref('')
    const customer_four_month_ago = ref('')

    onMounted(async ()=>{
        await $axios.get("home").then(({data})=>{
        $axios.defaults.headers.common["Authorization"] ="Bearer " + localStorage.getItem('token');
        customer.value = data.customer
        contract.value = data.contract
        invoice.value = data.invoice
        invoice_done.value = data.invoice_done
        invoice_not_done.value = data.invoice_not_done
        customer_this_month.value = data.customer_this_month
        customer_one_month_ago.value = data.customer_one_month_ago
        customer_two_month_ago.value = data.customer_two_month_ago
        customer_three_month_ago.value = data.customer_three_month_ago
        customer_four_month_ago.value = data.customer_four_month_ago
        console.log(data);
        }).catch((error)=>{
            console.log(error)
        })
    })
</script>