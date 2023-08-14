<template>
    <div class="text-center">
      <span>Number of customers are {{ customer }}</span>
        <canvas id="myChart1" width="500" height="300"></canvas>
    </div>
</template>
<script>
import Chart from 'chart.js/auto';

export default{
  props:['customer','month','one','two','three','four'],
  mounted(){
        
const ctx = document.getElementById('myChart1');


const labels = ['4 month ago','3 month ago','2 month ago','1 month ago','this month'];
const data = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [this.four,this.three, this.two,this.one,this.month],
    fill: false,
    borderColor: 'rgb(78, 44, 99)',
    tension: 0.1
  }]
};



const myChart = new Chart(ctx, {
    type: 'line',
  data: data,
    })
 }}      
    
 
</script>