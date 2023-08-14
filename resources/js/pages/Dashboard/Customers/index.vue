<template>
    <Header route_name="customers.create" name="Customer"/>
    <Table
        :tableHead="TableHead"
        :thead-data="thead"
        edit="/customers/"
        contract="contract"
        url="/customers?"/>
</template>

<script setup>
    import Header from '../../Components/Header.vue'
    import Table from '../../Components/Table.vue'
    import { inject, onMounted , reactive , ref } from "@vue/runtime-core";
    

    const thead=ref([
        'name',
        'address',
        'phone_number',
        'start_date',
        'note',
        ['user','name']
        
])

const TableHead=ref([
        'Name',
        'Address',
        'Phone Number',
        'Start date',
        'Note',
        'User'
        
])

</script>