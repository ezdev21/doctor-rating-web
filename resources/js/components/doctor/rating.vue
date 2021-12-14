<template>
<div>
  <div>
  <h2 class="text-2xl text-gray-700">likelihood to recommend Dr <span class="capitalize">{{doctor.name}}</span></h2> 
  <div class="flex">
   <p class="text-6xl m-2">{{averagerate}}</p> 
   <div class="my-auto mx-1">
   <div v-show="averagerate">
    <stars-component :doctorId="doctorId"/>
   </div>
     <p class="text-xl">based on {{previews.length}} ratings</p>
   </div>
  </div> 
  <div class="text-xl">
    <p class="text-xl">5 stars - ({{fivestars}})</p>
    <p class="text-xl">4 stars - ({{fourstars}})</p>
    <p class="text-xl">3 stars - ({{threestars}})</p>
    <p class="text-xl">2 stars - ({{twostars}})</p>
    <p class="text-xl">1 stars - ({{onestars}})</p>
    <p class="text-xl">0 stars - ({{zerostars}})</p>
  </div>
  </div>
  <div class="my-3">
    <div v-for="preview in previews" :key="preview.id" class="relative border-2 border-gray-300 rounded-xl w-full lg:w-1/2 xl:w-1/2 2xl:w-1/2 p-5 my-2">
      <p class="text-3xl">
       <span :class="[preview.star>=1? 'gold':'text-gray-300']">★</span>
       <span :class="[preview.star>=2? 'gold':'text-gray-300']">★</span>
       <span :class="[preview.star>=3? 'gold':'text-gray-300']">★</span>
       <span :class="[preview.star>=4? 'gold':'text-gray-300']">★</span>
       <span :class="[preview.star==5? 'gold':'text-gray-300']">★</span>
      </p>
      <p class="text-lg text-gray-600 m-1 p-1 block">{{preview.comment}}</p>
      <p class="absolute right-1 bottom-1 m-2">
        <span class="text-lg capitalize" v-if="preview.name">{{preview.name}}</span>
        <span v-else class="text-lg capitalize">anonymous</span>
        <span class="text-6xl mx-2 -mt-2">.</span>
        <span class="text-lg">{{preview.month}} {{preview.date}} {{preview.year}}</span>
      </p>
    </div>
  </div>
</div>
</template>
<script>
import stars from '../stars.vue';
export default {
  components:{
   "stars-component":stars
  },
  props:['doctorId'],
  data(){
    return{
      doctor:{},
      previews:[],
      averagerate:null,
      fivestars:0,
      fourstars:0,
      threestars:0,
      twostars:0,
      onestars:0,
      zerostars:0
    }
  },
  mounted(){
    axios.get('/doctor/averagerate',{params:{doctorId:this.doctorId}})
    .then(res=>{
      this.averagerate=res.data.rate;
      this.averagerate=this.averagerate.toString().substr(0,4);
    });
    axios.get('/doctor/rating',{params:{doctorId:this.doctorId}})
    .then(res=>{
      this.doctor=res.data.doctor;
    });
    axios.get('/doctor/previews',{params:{doctorId:this.doctorId}})
    .then(res=>{
      this.previews=res.data.previews;
      this.previews.forEach(preview => {
        preview.year=preview.created_at.substr(0,4);
        preview.month=preview.created_at.substr(5,2);
        preview.date=preview.created_at.substr(8,2);
        if(parseInt(preview.date)<10){
          preview.date=preview.date.substr(1,1);
        }
        let months=['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec']
        if(preview.month<10){
          preview.month=preview.month.subsrt(1,2);
        }
        preview.month=months[preview.month-1];
        if(preview.star==0){
          this.zerostars+=1;
        }
        if(preview.star==1){
          this.onestars+=1;
        }
        if(preview.star==2){
          this.twostars+=1;
        }
        if(preview.star==3){
          this.threestars+=1;
        }
        if(preview.star==4){
          this.fourstars+=1;
        }
        if(preview.star==5){
          this.fivestars+=1;
        }
      });
    });
  }
}
</script>
<style scoped>
 .gold{
   color:#ffd700;
 }
</style>