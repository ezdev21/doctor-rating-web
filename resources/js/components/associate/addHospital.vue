<template>
 <div class="bg-white w-full lg:w-2/3 xl:w-2/3 2xl:w-2/3 rounded-2xl p-2 my-2 mx-auto">
  <h2 class="capitalize text-center text-tiruhakim text-3xl border-b-2 border-gray-300 p-2 mb-2">submit the form below to get profile</h2>
  <form method="POST" @submit.prevent="register" enctype="multipart/form-data" class="mx-3 my-2">
   <label for="name" class="capitalize m-1 text-2xl text-tiruhakim">full name</label>
   <input type="text" v-model="name" placeholder="full name" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>
   <label for="email" @input="checkEmail" class="capitalize m-1 text-2xl text-tiruhakim">email</label>
   <input type="email" v-model="email" @input="checkEmail" placeholder="email" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2"/>
   <p v-if="emailError" class="text-xl text-red-600">Email already taken! a Hospital with this email is already registered</p>
   <div class="my-2 flex">
    <label for="city" class="capitalize m-1 text-2xl text-tiruhakim">city</label>
    <select name="" v-model="city" class="mx-3 text-xl py-1 px-3 text-tiruhakim border-2 border-tiruhakim">
      <option value="select" disabled selected>select</option>
      <option v-for="city in cities" :key="city.id" :value="city.id" class="capitalize">{{city.name}}</option>
    </select>
    <button v-if="city=='select'" @click="popup=true;" class="bg-tiruhakim text-white py-2 px-4 rounded-xl text-xl">add city</button>
   </div>
   <div v-if="popup" class="absolute inset-center bg-white z-20 rounded-xl py-5 px-10">
      <p class="capitalize text-2xl text-center m-2">add new city here</p>
      <input @keyup.enter="addCity" type="text" v-model="cityName" required placeholder="new speciality" class="m-1 border-2 rounded-xl w-72 p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
      <button @click="addCity" class="flex bg-tiruhakim text-white text-xl py-2 px-4 rounded-2xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>add new</span>
      </button>  
    </div>
    <div v-if="popup" @click="popup=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>  
    <div>
    <label for="picture" class="capitalize m-1 text-2xl text-tiruhakim m-1">hospital photo</label>
    <input @change="onChange" type="file" accept="image/*" required class="text-xl bg-tiruhakim text-white"/>
   </div>
   <div>
    <label for="location" class="capitalize m-1 text-2xl text-tiruhakim m-1">location</label>
    <input type="text" v-model="location" placeholder="location" class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim">
   </div>
   <p>
   <label class="text-2xl text-tiruhakim capitalize m-1 ">description<span class="text-gray-500">(hospital description)</span></label>
   <input type="text" v-model="description" placeholder="hospital description" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   </p>
   <label class="capitalize m-1 text-2xl text-tiruhakim tiruhakim">phone number</label>
   <input type="number" v-model="phoneNumber" placeholder="phone number" required class="border-2 border-gray-200 rounded-xl w-full p-2 text-xl outline-none focus:border-b-2 focus:border-b-tiruhakim"/>
   <input type="submit" :value="registerText" :class="[processing? 'cursor-wait':'',emailError? 'cursor-not-allowed':'']" class="my-3 py-2 px-5 rounded-3xl text-xl bg-tiruhakim text-white p-1">
  </form> 
  <div v-if="registerPopup" class="inset-center bg-white z-20 rounded-xl py-5 px-10">
   <button @click="backToSite" class="absolute text-tiruhakim top-2 right-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="text-tiruhakim h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
   </button>
   <h1 class="capitalize text-3xl text-center m-2">thank you</h1>
   <p class="text-gray-600 text-2xl">your submission has been recieved.<br>we will be in touch and contact you soon!</p>
   <button @click="backToSite" class="text-xl text-white bg-tiruhakim py-2 px-4 rounded-lg block mx-auto my-2">back to site</button> 
  </div>
  <div v-if="registerPopup" @click="backToSite" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>  
 </div>   
</template>
<script>
export default {
 data(){
  return{
    cities:[],
    name:'',
    email:'',
    file:'',
    city:'select',
    phoneNumber:'',
    description:'',
    location:'',
    cityName:'',
    emails:[],
    popup:false,
    emailError:false,
    processing:false,
    registerPopup:false,
    registerText:'Register'
  }   
 },
 mounted(){
  axios.get('/city/all')
  .then(res=>{
    this.cities=res.data.cities;
  });
  axios.get('/hospital/emails')
  .then(res=>{
    this.emails=res.data.emails;
  });
 },
 methods:{
   checkEmail(){
    this.emailError=false;
    this.emails.forEach(email=>{
      if(email==this.email){
        this.emailError=true;
      }
    });
   },
  addCity(){
    axios.post('associate/city/add',{params:{cityName:this.cityName}})
    .then(res=>{
     let city=res.data.city; 
     this.cities.push(city);
     this.city=city.id;
    });
  },   
  onChange(e){
    this.file = e.target.files[0];
  },
  register(){
    this.registerText='processing';
      let currentObj = this;
      const config = {
          headers: { 'content-type': 'multipart/form-data' }
      }
      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('name', this.name);
      formData.append('email', this.email);
      formData.append('city',this.city);
      formData.append('location',this.location);
      formData.append('phoneNumber', this.phoneNumber);
      formData.append('description',this.description);
      axios.post('/associate/addhospital',formData,config)
      .then(res=>{
        this.registerPopup=true;
      });  
  },
  backToSite(){
    window.location.href="/";
  }  
 }   
}
</script>