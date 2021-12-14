<template>
 <div class="py-3 flex justify-between w-full shadow-md bg-white pr-5">
  <div class="ml-5 pl-3"> 
   <a href="/" class="">
    <img src="/storage/icons/tiruHakimLogo_longform_en.png" class="h-13">   
   </a>
  </div>
  <div class="my-auto">
    <ul class="hidden lg:flex xl:flex 2xl:flex my-auto">
      <li class="px-3 py-1 text-xl text-gray-500 font-bold">
        <a class="flex flex-col -space-y-8 no-underline hover:no-underline" href="/finddoctors">
         <p class="hover:text-tiruhakim" :class="[currentUrl==doctorLink? 'text-tiruhakim': 'text-gray-500']">Find a Doctor</p><p v-if="currentUrl==doctorLink" class="text-5xl w-full text-center text-tiruhakim rounded-full">.</p>
        </a>
      </li>
      <li class="px-3 py-1 text-xl text-gray-500 font-bold">
        <a class="flex flex-col -space-y-8 no-underline hover:no-underline" href="/">
         <p class="hover:text-tiruhakim" :class="[currentUrl==homeLink? 'text-tiruhakim': 'text-gray-500']">Home</p><p v-if="currentUrl==homeLink" class="text-5xl text-center w-full text-tiruhakim rounded-full">.</p>
        </a>
      </li>
      <li class="px-3 py-1 text-xl text-gray-500 font-bold">
        <a class="flex flex-col -space-y-8 no-underline hover:no-underline" href="/findhospitals">
         <p class="hover:text-tiruhakim" :class="[currentUrl==hospitalLink? 'text-tiruhakim': 'text-gray-500']">Find a Hospital</p><p v-if="currentUrl==hospitalLink" class="text-5xl w-full text-center text-tiruhakim rounded-full">.</p>
        </a>
      </li>
    </ul>
  </div>
  <div v-if="isAdmin" class="hidden md:flex lg:flex xl:flex 2xl:flex mx-2">
    <div>
      <notifications-component :userId="userId"/>   
    </div>   
  </div>
   <div class="hidden lg:flex xl:flex 2xl:flex mx-3 my-auto"> 
    <!-- <div class="inline my-auto">
     <select name="" id="" class="text-white text-xl bg-tiruhakim my-auto mx-2 py-1 px-3 rounded-lg">
       <option value="english" selected>English</option>
       <option value="amharic">አማርኛ</option>
     </select>
    </div> -->
     <div v-if="userId" class="my-auto flex">
       <img v-if="user.avatar" src="" class="h-5 w-5 rounded-full m-1"/>
       <button @click="userDropdownMenu=true" class="my-auto">
        <span class="capitalize text-xl text-tiruhakim font-semibold my-auto">{{user.name}}</span>
       </button>   
     </div>
     <div v-else class="flex text-white text-xl w-full my-auto">
     <a href="/login" class="text-lg mx-2 rounded px-2 py-1 text-gray-500 font-bold my-auto">Login</a>
     <registerpopup-component/>
     </div>
    </div>
    <div class="inline lg:hidden xl:hidden 2xl:hidden">
      <button @click="userDropdownMenu=true">
      <svg xmlns="http://www.w3.org/2000/svg" class="text-tiruhakim h-14 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    </div>
    <div v-if="userDropdownMenu" class="absolute z-20 text-xl bg-gray-100 top-0 right-0 text-tiruhakim">
      <ul>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/" :class="[currentUrl==homeLink? 'text-gray-500':'']">Home</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/finddoctors" :class="[currentUrl==doctorLink? 'text-gray-500':'']">Find a Doctor</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/findhospitals" :class="[currentUrl==hospitalLink? 'text-gray-500':'']">Find a Hospital</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/login">Login</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/doctor/register">Register(Doctor)</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/hospital/register">Register(Hospital)</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="/register">Register(User)</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="#">About Us</a></li>
       <li class="hover:bg-blue-200 px-5 py-1 font-bold italic"><a class="hover:no-underline" href="#">Contact Us</a></li>
       <li v-if="userId" class="hover:bg-blue-200 px-5 py-1 font-bold italic">
        <button @click="logout" class="font-bold">logout</button>
       </li>
      </ul>
     </div>
     <div v-if="userDropdownMenu" @click="userDropdownMenu=false" class="absolute z-10 -inset-y-full -inset-x-0 bg-black opacity-50"></div>
  </div>
</template>
<script>
import registerPopup from './registerPopup.vue';
export default {
   props:['userId'],
   components:{
     "registerPopup":registerPopup
   },
   data(){
    return{
      user:{},
      isAdmin:false,
      userDropdownMenu:false,
      currentUrl:'',
      doctorLink:'http://tiruhakim.com/finddoctors',
      homeLink:'http://tiruhakim.com/',
      hospitalLink:'http://tiruhakim.com/findhospitals'
    }
   },
   mounted(){
    this.currentUrl=window.location.href;
    if(this.userId){
    axios.get('/navigation',{params:{userId:this.userId}})
    .then(res=>{
    this.user=res.data.user;
    this.isAdmin=res.data.isAdmin;
    });
    }
   },
   methods:{
    logout(){
      document.getElementById('logout-form').submit(); 
    }
   }
}
</script>
style <style scoped>
.h-13{
  height:3.25rem;
}
</style>