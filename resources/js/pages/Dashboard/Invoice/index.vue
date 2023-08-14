<template>
    <Header route_name="invoice.create" name="Invoice"/>
    <Table
        :tableHead="TableHead"
        :thead-data="thead"
        edit="/invoice/"
        url="/invoice?"/>
</template>

<script setup>
import Header from '../../Components/Header.vue'
import Table from '../../Components/Table.vue'
import { inject, onMounted , reactive , ref } from "@vue/runtime-core";


const thead=ref([
    ['customer','name'],
    'invoice_date',
    'done',
    ['user','name'],
    
])

const TableHead=ref([
    'Customer Name',
    'Invoice Date',
    'Done',
    'User',
    
])

</script>