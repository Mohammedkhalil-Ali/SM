<template>
    <Header route_name="contract.create" name="Contract" customers="customers" :customer_id="id"/>
    <Table
        :tableHead="TableHead"
        :thead-data="thead"
        editcontract="editcontract"
        edit="/invoice-item/"
        :url="'/contract?customer_id='+customer_id+'&'" />
</template>

<script setup>
    import Header from '../../Components/Header.vue'
    import Table from '../../Components/Table.vue'
    import { inject, onMounted , reactive , ref } from "@vue/runtime-core";
    import { useRoute, useRouter } from "vue-router";
    const route = useRoute()
  
    const customer_id= ref(route.params.customer_id)

    const thead=ref([
        ['customer','name'],
        'payment',
        'start_date',
        'expire_date',
        ['user','name']
        
])

const TableHead=ref([
        'Name',
        'Payment',
        'Start date',
        'Expire date',
        'User'
        
])

</script>