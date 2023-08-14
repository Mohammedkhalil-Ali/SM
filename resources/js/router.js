import { createRouter , createWebHistory } from "vue-router";

import Login from './pages/Auth/login.vue'
//Customers
import Customers from './pages/Dashboard/Customers/index.vue'
import CustomerCreate from './pages/Dashboard/Customers/createCustomer.vue'
import CustomerEdit from './pages/Dashboard/Customers/editCustomer.vue'
//Contract
import Contract from './pages/Dashboard/Contracts/index.vue'
import ContractCreate from './pages/Dashboard/Contracts/createContract.vue'
import ContractEdit from './pages/Dashboard/Contracts/editContract.vue'
//Invoice
import Invoice from './pages/Dashboard/Invoice/index.vue'
import InvoiceCreate from './pages/Dashboard/Invoice/createInvoice.vue'
import InvoiceEdit from './pages/Dashboard/Invoice/editInvoice.vue'
//InvoiceItem
import InvoiceItem from './pages/Dashboard/InvoiceItems/index.vue'
import InvoiceItemCreate from './pages/Dashboard/InvoiceItems/createInvoiceItem.vue'
import InvoiceItemEdit from './pages/Dashboard/InvoiceItems/editInvoiceItem.vue'
//Home
import Home from './pages/Dashboard/Home/index.vue'
import Main from './pages/Dashboard/MainLayout.vue'

// authentication
const IfAuth = (to, from, next)=>{
    localStorage.getItem('token')? next() : next('/login')
    }

    const IfNotAuth = (to, from, next)=>{
    !localStorage.getItem('token')? next() : next('/')
    }
const routes=[
    {path:'/login',name:'login',component:Login, beforeEnter: IfNotAuth},
    {path:'/',name:'dashboard',component:Main,redirect:'/home',children:[
        {path:'/home',name:'home',component:Home,props:true},
        //Customers
        {path:'/customers',name:'customers',component:Customers,props:true},
        {path:'/customers/create',name:'customers.create',component:CustomerCreate,props:true},
        {path:'/customers/:id/edit',name:'customers.edit',component:CustomerEdit,props:true},
        //Contract
        {path:'/contract/:customer_id',name:'contract',component:Contract,props:true},
        {path:'/contract/:customer_id/create',name:'contract.create',component:ContractCreate,props:true},
        {path:'/contract/:customer_id/:contract_id/edit',name:'contract.edit',component:ContractEdit,props:true},
        //Invoice
        {path:'/invoice',name:'invoice',component:Invoice,props:true},
        {path:'/invoice/create',name:'invoice.create',component:InvoiceCreate,props:true},
        {path:'/invoice/:id/edit',name:'invoice.edit',component:InvoiceEdit,props:true},
        //InvoiceItem
        {path:'/invoice-item',name:'invoice-item',component:InvoiceItem,props:true},
        {path:'/invoice-item/create',name:'invoice-item.create',component:InvoiceItemCreate,props:true},
        {path:'/invoice-item/:id/edit',name:'invoice-item.edit',component:InvoiceItemEdit,props:true},
    ], beforeEnter:IfAuth},
]

const router =createRouter({
    history:createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
      if (savedPosition) {
        return savedPosition;
      } else if (to.hash) {
        return {
          selector: to.hash,
        };
      } else {
        return { top: 0, left: 0 };
      }
    }
})

export default router; 