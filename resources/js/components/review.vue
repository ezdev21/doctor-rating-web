<template>
 <div>
  <ul v-if="evaluations.length">
   <li v-for="evaluation in evaluations">
    <p>{{evaluation.name}} {{evaluation.score}}</p>
   </li>
  </ul>
  <p v-else class="">no evaluation is given</p>
 </div>
</template>
<script>
export default{
props:['doctorId'],
data(){
 return{
  evaluations:[]
 }
},
mounted(){
 axios.get('/doctor/preview',{params:{doctorId:this.doctorId}})
 .then(res=>{
  this.evaluations=res.data.evaluations;
  });
 }
}
</script>
