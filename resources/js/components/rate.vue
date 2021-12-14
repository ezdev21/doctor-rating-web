<template>
 <div>
  <div>
    <ul class="rate-area">
     <input type="radio" id="5-star" name="star" value="1"/>
     <input type="radio" id="4-star" name="star" value="2"/>
     <input type="radio" id="3-star" name="star" value="3"/>
     <input type="radio" id="2-star" name="star" value="4"/>
     <input type="radio" id="1-star" name="star" value="5"/>
    </ul>
  </div>
  <div v-if="ratingPopup" class="fixed top-1/3 left-1/4 z-20 w-full lg:w-1/2 xl:w-1/2 2xl:w-1/2 px-10 py-2 bg-gray-300 rounded-xl">
    <ul class="rate-area">
     <input type="radio" id="5-star" name="star" value="5"/>
     <input type="radio" id="4-star" name="star" value="4"/>
     <input type="radio" id="3-star" name="star" value="3"/>
     <input type="radio" id="2-star" name="star" value="2"/>
     <input type="radio" id="1-star" name="star" value="1"/>
    </ul>
    <ul>
     <li v-for="evaluation in evaluations" :key="evaluation.id">
      <p>{{evaluation.title}}</p>
      <ul class="rate-area">
        <input type="radio" id="5-star" name="crating" value="5">
        <label for="5-star" title="Amazing">5 stars</label>
        <input type="radio" id="4-star" name="crating" value="4">
        <label for="4-star" title="Good">4 stars</label>
        <input type="radio" id="3-star" name="crating" value="3">
        <label for="3-star" title="Average">3 stars</label>
        <input type="radio" id="2-star" name="crating" value="2">
        <label for="2-star" title="Not Good">2 stars</label>
        <input type="radio" id="1-star" required=""
         name="crating" value="1" aria-required="true">
        <label for="1-star" title="Bad">1 star</label>
      </ul>
     </li>
    </ul>
  </div>
 </div>
</template>
<script>
export default{
  props:['type'],
  data(){
    return{
      ratingPopup:false,
      evaluations:[],
      evaluation:[],
      comment:''
    }  
  },
  mounted(){
    axios.get('/evaluations',{params:{type:this.type}})
    .then(res=>{
      this.evaluations=res.data.evaluations;  
    });
  },
  methods:{
    rate(){
      axios.post('/doctor/rate',)
      .then(res=>{
         
      });  
    }  
  }
}
</script>
<style scoped>
.rate-area {
    float:left;
    border-style: none;
}

.rate-area:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
}

.rate-area:not(:checked) > label {
    float: right;
    width: .80em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 40px;
    line-height: 32px;
    color: lightgrey;
    margin-bottom: 10px !important;
}

.rate-area:not(:checked) > label:before {
    content: '★';
}

.rate-area > input:checked ~ label {
    color: #ffd700;
    text-shadow: none;
}

.rate-area:not(:checked) > label:hover,
.rate-area:not(:checked) > label:hover ~ label {
    color: #ffd700;
    
}

.rate-area > input:checked + label:hover,
.rate-area > input:checked + label:hover ~ label,
.rate-area > input:checked ~ label:hover,
.rate-area > input:checked ~ label:hover ~ label,
.rate-area > label:hover ~ input:checked ~ label {
    color: #e8262d;
    text-shadow: none;
    
}

.rate-area > label:active {
    position:relative;
    top:0px;
    left:0px; 
}
</style>