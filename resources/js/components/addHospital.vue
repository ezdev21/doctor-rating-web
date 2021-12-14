<template>
  <div>
    <input type="text" v-model="searchQuery" @input="filter" class="">  
  </div>    
</template>
<script>
export default {
   props:[],
   data(){
    return{
     searchQuery:'',   
     allHospitals:[],
     filteredHospitals:[]
    }
   },
   mounted(){
    axios.get('/allhospitals')
    .then(res=>{
     this.allHospitals=res.data.hospitals;
    });
   },
   methods:{
     filter(){
         
     }  
   } 
}
</script>