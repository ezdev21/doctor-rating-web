<template>
 <div class="p-5">
  <div class="flex">
    <img :src="'/storage/doctors/'+doctor.avatar" class="w-48 h-48 rounded-full m-2">
    <div class="text-gray-600 m-2 my-auto">
      <h2 class="text-2xl font-bold capitalize">Dr {{doctor.name}}</h2>
      <p class="text-2xl">
       <span class="capitalize">{{doctor.gender}}</span>
       <span>age {{doctor.age}}</span>
      </p>
      <div v-if="doctor.hospital">
       <p>{{doctor.hospital}} is not registered</p>
       <button class="py-2 px-4 text-xl text-white bg-tiruhakim rounded-xl">
         <a href="/hospital/register">register {{doctor.hospital}}</a>
       </button>
      </div>
      <div v-for="hospital in doctor.hospitals" :key="hospital.id">
        <a :href="'/hospital/profile/'+hospital.id" class="flex no-underline hover:no-underline">
         <img :src="'/storage/hospitals/'+hospital.picture" class="h-16 w-16 rounded-full m-1"/>
         <div class="my-auto mx-1">
          <p class="text-xl capitalize">{{hospital.name}} hospital</p>
          <hospitalstars-component :hospitalId="hospital.id" />
        </div>
        <div class="mx-1 my-auto">
          <p class="text-xl capitalize">{{hospital.location}}</p>
        </div>
        </a>
      </div>
      <p class="text-gray-600 text-2xl">speciality</p>
      <a v-for="speciality in doctor.specialities" :href="'/speciality/'+speciality.id" :key="speciality.id">-{{speciality.name}}</a>
      <div class="cursor-pointer text-4xl">
        <stars-component :doctorId="doctorId"/>
      </div>
      <div v-if="!(doctorId==userId)">
        <button @click="popup=true" class="text-tiruhakim text-xl">leave a review</button>
      </div>
    </div>
    <div>
    </div>
  </div>
  <p class="m-2 text-xl text-gray-600">{{doctor.description}}</p>
  <div class="m-2">
   <div class="flex">
    <button @click="component='rating'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='rating'? 'text-tiruhakim':'']">
      <span class="">rating</span>
      <span v-if="component=='rating'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
    <button @click="component='aboutMe'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='aboutMe'? 'text-tiruhakim':'']">
      <span class="">about me</span>
      <span v-if="component=='aboutMe'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
    <button @click="component='hospitals'" class="flex flex-col -space-y-10 text-gray-500 text-xl px-3 text-gray-500 capitalize font-bold" :class="[component=='hospitals'? 'text-tiruhakim':'']">
      <span class="">hospitals</span>
      <span v-if="component=='hospitals'" class="text-6xl text-tiruhakim w-full text-center">.</span>
    </button>
   </div>
   <component :is="component" :doctorId="doctorId" />
  <div v-if="popup" class="absolute top-5 left-1/4 z-20 rounded-xl bg-white">
   <form @submit.prevent="giverate" class="m-auto rounded-2xl bg-white py-2 px-5">
   <h2 class="text-2xl m-1">how likely are you to recommend Dr <span class="capitalize">{{doctor.name}}?</span></h2>  
   <div class="flex">
    <button @click="rate=1" class="text-5xl hover:text-yellow-500" :class="[rate>=1? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=2" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate>=2? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=3" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate>=3? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=4" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate>=4? 'text-yellow-500':'text-gray-300']">★</button>
    <button @click="rate=5" class="text-5xl text-gray-300 hover:text-yellow-500" :class="[rate==5? 'text-yellow-500':'text-gray-300']">★</button>
   </div>   
   <p class="text-2xl m-1">tell us more about your visit.</p>
   <textarea v-model="comment" class="text-xl text-tiruhakim w-full h-28 rounded-xl border-2 border-gray-400"></textarea>
   <p class="text-2xl m-1">display name(optional)</p>
   <input type="text" v-model="name" placeholder="name" class="text-xl text-tiruhakim m-1 w-full text-xl p-2 rounded-xl border-2 border-gray-300"> 
   <p class="text-lg m-1">*anonymous review have lower rating</p>
   <p class="text-2xl m-1">email*(this will not appear in the review)</p>
   <input type="text" v-model="email" required placeholder="email" class="text-xl text-tiruhakim m-1 w-full text-xl p-2 rounded-xl border-2 border-gray-300"/>
   <p v-if="emailerror" class="text-xl text-red-600">please enter a valid email</p>
   <p class="text-2xl m-1">phone*(this will not appear in the review)</p>
   <input type="text" v-model="phone" required placeholder="phone number" class="text-xl text-tiruhakim m-1 w-full text-xl p-2 rounded-xl border-2 border-gray-300">  
   <button v-if="processing" type="button" class="py-2 px-4 m-2 text-white bg-tiruhakim text-2xl rounded-2xl" disabled>
    Processing
   </button>
   <input v-else type="submit" value="submit" class="py-2 px-4 m-2 text-white bg-tiruhakim text-2xl rounded-2xl"/>  
 </form>  
   </div>
  </div>
  <div v-if="popup" @click="popup=false" class="absolute -inset-full opacity-50 bg-black z-10"></div>
</div>
</template>
<script>
import rating from './rating.vue';
import aboutMe from './aboutMe.vue';
import hospitals from './hospitals.vue';
import stars from '../stars.vue';
export default {
  components:{
    "rating":rating,
    "aboutMe":aboutMe,
    "hospitals":hospitals,
    "stars-component":stars
  },
  props:['doctorId','userId'],
  data(){
    return {
     doctor:{}, 
     component:'rating',
     popup:false,
     rate:0,  
     comment:'',
     email:'',
     name:'',
     phone:'',
     processing:false,
     emailerror:false,
     user:{}
    }
  },
  mounted(){
    axios.get('/user/data',{params:{userId:this.userId}})
    .then(res=>{
      this.user=res.data.user;
    });
    if(this.user){
      this.email=this.user.email;
      this.name=this.user.name;
    }
    axios.get('/doctor/data',{params:{doctorId:this.doctorId}})
    .then(res=>{
      this.doctor=res.data.doctor;
      
    });
  },
  methods:{
    giverate(){
     if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)){
      this.processing=true;
       axios.post('/doctor/rate',{doctorId:this.doctor.id,rate:this.rate,comment:this.comment,email:this.email,name:this.name,phone:this.phone})
       .then(res=>{
         this.processing=false;
         this.popup=false;
       });
      }
      else{
        this.emailerror=true;
      }
    }   
  }
}
</script>