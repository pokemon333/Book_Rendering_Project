<template>
    <div class="flex">
        <div class=" w-full   border-r-2 flex justify-center items-center" style="height: 585px;">
             <div class="w-11/12 h-full ">
                   <div class=" h-1/2 flex justify-evenly items-center">
                      <BarChart :chartData="testData" class="w-60 h-30" />
                      <DoughnutChart :chartData="testData" class="w-60 h-30"/>
                   </div>
                   <div class="h-1/2 flex justify-evenly items-center ">
                      <ScatterChart :chartData="testData" class="w-60 h-30 ml-12"/>
                      <PolarAreaChart :chartData="testData" class="w-60 h-30 ml-12"/>
                   </div>
             </div>
        </div>
    </div>
  </template>
  
  <script lang="ts">
  import { BarChart ,DoughnutChart,ScatterChart,PolarAreaChart} from 'vue-chart-3';
  import { Chart, registerables } from "chart.js";
  import ApiServices from '../../../services/ApiServices';
  
  Chart.register(...registerables);
 
  export default {
    data(){
      return {
        auth:false,
        role: ''
      }
    },
    mounted(){
          this.setAuthUser()
    },
    name: 'Home',
    components: { BarChart ,DoughnutChart,ScatterChart,PolarAreaChart},
    methods:{
      setAuthUser (){
            ApiServices.get('user').then((res)=>{
              let roles = res.data.data.role
              let test = roles.filter(element => {
                 return element.name == 'admin' 
               });
               
              if (test.length == 0) {
                this.$router.push({name: 'client'})
              }
                
            }).catch((err)=>console.log(err))
             
        },
    },
   
    setup() {
      const testData = {
        labels: ['Paris', 'Nîmes', 'Toulon', 'Perpignan', 'Autre'],
        datasets: [
          {
            data: [30, 40, 60, 70, 5],
            backgroundColor: ['#77CEFF', '#0079AF', '#123E6B', '#97B0C4', '#A5C8ED'],
          },
        ],
      };
  
      return { 
        testData,
        options: [
        {
          label: 'Profile',
          key: 'profile',
          icon: ''
        },
        {
          label: 'Edit Profile',
          key: 'editProfile',
          icon: ''
        },
        {
          label: 'Logout',
          key: 'logout',
          icon: ''
        }
      ]
     };
    },
  };
  </script>