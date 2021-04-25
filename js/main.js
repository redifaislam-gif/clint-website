$(document).ready(function(){
	
	
//stikey
	$(".js--clint-section").waypoint(function(direction){
		
	if(direction== "down"){
		$(".menu-section").addClass("stikey");
	}else{
	$(".menu-section").removeClass("stikey");	
	}	
		
	});
	//protfolio
	var mixer=mixitup('.container');
	
	
	$(".hellow-circle").circleProgress();	
		
	

$(".hellow-circle").circleProgress();	
	
	
	
	
	
$('.owl-carosel').owlCarousel();	
	
});

$(document).ready(function(){
	
	$(".logo").click(function(){
		
			$(this).slideIn();
		
	});	
		
});

	

 function openNav() {
	  
	  document.getElementById("myNav").style.width="100%";
  }
  
  
  function closeNav() {
	  
	  document.getElementById("myNav").style.width="0%";
  }
  


  
  
  
  
  
  
  
  
  
  $(function(){
	  
	  let start =0;
	  let end =$(".countup1").html();
	  let speed =100;
	  
	  setInterval(function(){
		  if(start<end){
			  
			  start++;
		  }
		  $(".countup1").html(start);
		  
	  }, speed);
	  
	  
  });
    
  $(function(){
	  
	  let start =0;
	  let end =$(".countup2").html();
	  let speed =100;
	  
	  setInterval(function(){
		  if(start<end){
			  
			  start++;
		  }
		  $(".countup2").html(start);
		  
	  }, speed);
	  
	  
  });
  
    
  $(function(){
	  
	  let start =0;
	  let end =$(".countup3").html();
	  let speed =100;
	  
	  setInterval(function(){
		  if(start<end){
			  
			  start++;
		  }
		  $(".countup3").html(start);
		  
	  }, speed);
	  
	  
  });

 

