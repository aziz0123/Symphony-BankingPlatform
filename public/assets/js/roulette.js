(function (){
const wheel=document.querySelector('.wheel');
const startButton=document.querySelector('.button') ;
let deg=0;

startButton.addEventListener('click',() =>{

startButton.getElementsByClassName.pointerEvents= 'none';
deg= Math.floor(5000+Math.random()*5000);
wheel.style.transition= 'all 10s ease';
wheel.style.transform=`rotate(${deg}deg)`;
wheel.classList.add('blur');
});

wheel.addEventListener('transitionend',() =>{

 wheel.classList.remove('blur');
 startButton.getElementsByClassName.pointerEvents='none';
 wheel.style.transition='none';

 const actualDeg=deg%360;
 console.log(actualDeg);

 wheel.style.transform=`rotate(${actualDeg}deg)`;
 var element=document.getElementById('result');


 if(actualDeg>=0 && actualDeg<10){
   document.getElementById("result").textContent="BLACK";
   element.classList.remove("green");
   element.classList.remove("red");
   element.classList.add("black");
 }
  if(actualDeg>=10 && actualDeg<20){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=20 && actualDeg<30){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=30 && actualDeg<39){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=39 && actualDeg<49){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=49 && actualDeg<59){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=59 && actualDeg<69){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=69 && actualDeg<79){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=79 && actualDeg<89){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=89 && actualDeg<99){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=99 && actualDeg<109){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=109 && actualDeg<119){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=119 && actualDeg<129){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=129 && actualDeg<139){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=139 && actualDeg<149){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=149 && actualDeg<159){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=159 && actualDeg<169){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=169 && actualDeg<179){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=179 && actualDeg<189){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=189 && actualDeg<199){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=199 && actualDeg<209){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=209 && actualDeg<219){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=219 && actualDeg<229){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=229 && actualDeg<239){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=239 && actualDeg<249){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=249 && actualDeg<259){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=259 && actualDeg<269){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=269 && actualDeg<279){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=279 && actualDeg<289){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=289 && actualDeg<299){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=299 && actualDeg<309){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=309 && actualDeg<319){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=319 && actualDeg<329){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=329 && actualDeg<339){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }
  if(actualDeg>=339 && actualDeg<349){
    document.getElementById("result").textContent="BLACK";
    element.classList.remove("green");
    element.classList.remove("red");
    element.classList.add("black");
  }
  if(actualDeg>=349 && actualDeg<359){
    document.getElementById("result").textContent="RED";
    element.classList.remove("green");
    element.classList.remove("black");
    element.classList.add("red");
  }




})




}
)
