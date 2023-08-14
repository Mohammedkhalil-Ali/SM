<template>
    <div class="w-96 text-center">
      <span >Number of Invoice are {{ invoice }}</span>
        <canvas id="myChart" class="w-96"></canvas>
    </div>
</template>
<script>
import Chart from 'chart.js/auto';
export default{
  props:['invoice','done','notdone'],
  mounted(){
    
const ctx = document.getElementById('myChart');


const data = {
  labels: [
    'Done',
    'Not Done',
  ],
  datasets: [{
    label: 'My First Dataset',
    data: [this.done, this.notdone],
    backgroundColor: [
      'rgb(54, 162, 235)',
      'rgb(255, 99, 132)',
    ],
    hoverOffset: 2
  }]
};



const myChart = new Chart(ctx, {
    type: 'doughnut',
  data: data,
    }) }}      
    
 
</script>

