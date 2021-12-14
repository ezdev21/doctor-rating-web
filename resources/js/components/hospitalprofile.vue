<template>
 <div class="m-2 lg:m-5 xl:m-5 2xl:m-5">
  <div class="flex">
    <img :src="'/storage/hospitals/'+hospital.picture" class="w-64 m-3">
    <div class="text-gray-600 m-2 my-auto">
      <h2 class="text-2xl font-bold capitalize">{{hospital.name}}</h2>
      <p class="text-2xl capitalize">{{hospital.location}}, {{hospital.city}}</p>
      <div @click="popup=true" class="cursor-pointer text-4xl">
        <hospitalstars-component :hospitalId="hospitalId"/>
      </div>
      <p><button @click="popup=true" class="text-tiruhakim text-xl">leave a review</button></p>
     </div>
    <div>
   </div>
  </div>
  <p class="m-2 text-xl text-gray-600">{{hospital.description}}</p>
  <div v-show="doctors.length">
    <p class="text-2xl text-tiruhakim mx-3">doctors of {{hospital.name}}</p>
  </div>
  <div v-for="doctor in doctors" :key="doctor.id" class="my-1 mx-3 p-1 hover:bg-gray-200 w-max">
    <a :href="'/doctor/profile/'+doctor.id" class="flex">
      <img :src="'/storage/doctors/'+doctor.avatar" class="w-16 h-16 rounded-full my-auto m-1">
      <div class="mx-1">
        <p class="text-xl capitalize">{{doctor.name}}</p>
        <stars-component :doctorId="doctor.id"/>
      </div>
      <div class="mx-1 flex">
        <p v-for="speciality in doctor.speciality" :key="speciality.id" class="mx-1 text-xl">{{speciality.name}}</p>
      </div>
    </a>
  </div>
  <div v-show="!doctors.length">
    <p class="text-2xl text-tiruhakim mx-3">this hospital has no registered doctors</p>
  </div>
  <div class="m-2">
   <div v-if="popup" class="absolute top-10 left-1/4 z-20 rounded-xl bg-white">
    <div class="m-auto rounded-2xl bg-white p-5">
    <h2 class="text-2xl m-1">how likely are you to recommend <span class="capitalize">{{hospital.name}}?</span></h2>  
   <div class="flex">
    <button @click="rate=1" class="text-5xl hover:text-yellow-500" :class="[rate>=1? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=2" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate>=2? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=3" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate>=3? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=4" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate>=4? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=5" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate==5? 'text-yellow-500':'text-gray-300']">★</button>
   </div>   
   <p class="text-2xl m-1">tell us more about your visit.</p>
   <textarea v-model="comment" class="w-full h-28 rounded-xl border-2 border-gray-400"></textarea>
   <p class="text-2xl m-1">display name(optional)</p>
   <input type="text" v-model="name" placeholder="name" class="m-1 w-full text-xl p-2 rounded-xl border-2 border-gray-300"> 
   <p class="text-lg m-1">*anonymous review have lower rating</p>
   <p class="text-2xl m-1">email*(this will not appear in the review)</p>
   <input type="text" v-model="email" required placeholder="email" class="m-1 w-full text-xl p-2 rounded-xl border-2 border-gray-300"/>
   <p class="text-2xl m-1">phone*(this will not appear in the review)</p>
   <input type="text" v-model="phone" required placeholder="phone number" class="m-1 w-full text-xl p-2 rounded-xl border-2 border-gray-300">  
   <button @click="giverate" class="py-2 px-4 m-2 text-white bg-tiruhakim text-2xl rounded-2xl">submit</button>  
 </div>  
   </div>
  </div>
  <div v-if="popup" @click="popup=false" class="absolute -inset-full opacity-50 bg-black z-10"></div>
</div>
</template>
<script>
import hospitalStars from './hospitalstars.vue';
export default {
  components:{
    "hospitalstars-component":hospitalStars
  },
  props:['hospitalId'],
  data(){
    return {
     hospital:{},
     doctors:[], 
     popup:false,
     rate:0,  
     comment:'',
     email:'',
     name:'',
     phone:''
    }
  },
  mounted(){
    axios.get('/hospital/data',{params:{hospitalId:this.hospitalId}})
    .then(res=>{
      this.hospital=res.data.hospital;
      this.doctors=res.data.doctors;
    });
  },
  methods:{
    giverate(){
       axios.post('/hospital/rate',{hospitalId:this.hospital.id,rate:this.rate,comment:this.comment,email:this.email,name:this.name,phone:this.phone})
       .then(res=>{
         this.popup=false;
       });
      }  
  }
}
</script>
