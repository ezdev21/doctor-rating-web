<template>
 <div>
  <div class="stars-outer">
    <div class="stars-inner"></div>
  </div>
 </div>  
</template>
<script>
 export default {
  props:['doctorId'],
  data(){
   return{
     rate:0
   }
  },
  mounted(){
    axios.get('/doctor/averagerate',{params:{doctorId:this.doctorId}})
    .then(res=>{
      this.rate=res.data.rate;
      const starTotal = 5; 
      const starPercentage = (this.rate / starTotal) * 100;
      const starPercentageRounded = `${(Math.round(starPercentage / 10) * 10)}%`;
      document.querySelector(`.stars-inner`).style.width = starPercentageRounded;
    });
    }
 } 
</script>
<style scoped>
.stars-outer {
  display: inline-block;
  position: relative;
  font-family: FontAwesome;
  font-size:2rem;
}
.stars-outer::before {
  content: "\f006 \f006 \f006 \f006 \f006";
  color:#D3D3D3;
  font-size: 2rem;
}
.stars-inner {
  position: absolute;
  top: 0;
  left: 0;
  white-space: nowrap;
  overflow: hidden;
  width: 0;
  font-size:2rem;
}
.stars-inner::before {
  content: "\f005 \f005 \f005 \f005 \f005";
  color:#ffd700;
  font-size:2rem;
}
</style>