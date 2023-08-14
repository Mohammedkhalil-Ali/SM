<template>
    <Header route_name="invoice-item.create" name="Invoice Item"/>
    <Table
        :tableHead="TableHead"
        :thead-data="thead"
        edit="/invoice-item/"
        url="/invoiceitem?"/>
</template>

<script setup>
    import Header from '../../Components/Header.vue'
    import Table from '../../Components/Table.vue'
    import { inject, onMounted , reactive , ref } from "@vue/runtime-core";
    

    const thead=ref([
        'name',
        'price',
        'quantity',
        'subtotal',
        ['user','name']
        
])

const TableHead=ref([
        'Name',
        'Price',
        'Quantity',
        'Subtotal',
        'User'
        
])

</script>