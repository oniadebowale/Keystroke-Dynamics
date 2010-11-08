//register.js
var $j = jQuery.noConflict();

$j(document).ready(function() {
  	//disable form submission
   $j('form').submit(function()
  	{   
    	return false;
  	}
   );
 //add round corner
 //on load animations
 
  $j('#leftcontent, #leftheader, ').corner("round 10px").hide().fadeIn("slow");
  $j('#header').corner("round 8px").parent().css('padding', '4px').corner("round 10px").hide().show("slow");
  $j('#main-handle').hide().show("slide");
  $j('#cometinfo,#appletdiv').hide().corner("round 10px");
  
  //menu
  $j("#main-nav li a.main-link").hover(function(){
		$j("#main-nav li a.close").fadeIn();
		$j("#main-nav li a.main-link").removeClass("active");												 
		$j(this).addClass("active");										 
		$j("#sub-link-bar").animate({
			height: "40px"					   
		});
		$j(".sub-links").hide();
		$j(this).siblings(".sub-links").fadeIn();
	});
	$j("#main-nav li a.close").click(function(){
		$j("#main-nav li a.main-link").removeClass("active");												 									 
		$j(".sub-links").fadeOut();
		$j("#sub-link-bar").animate({
			height: "10px"					   
		});		
		$j("#main-nav li a.close").fadeOut();
	});
	
	 $j("#proceed").attr("disabled","disabled");	 

	//validates username
	var usernameok = false;
	var username = $j("#username");
	var usernameinfo = $j("#usernameinfo");
	     username.blur(function(){  
				//username shud be atleast 5 chars
				if($j("#username").val().length < 5) 
				{
					usernameinfo.html("Too short. require min 5 chars").removeClass('Green').addClass('Error');  
				}
				else {
        				 $j.ajax({  
						 type: "POST",  
						 data: "username="+$j(this).attr("value"),  
						 url: "check.php",  
						 beforeSend: function(){  
							 usernameinfo.html("Checking Username...").removeClass('Error').addClass('Green');  ;  
						 },  
						 success: function(data){  
							 if(data == "1")  
							 {  
								 usernameok = false;  
								 usernameinfo.html("Username already exist").removeClass('Green').addClass('Error');  
								 $j("#proceed").attr("disabled","disabled");	 //if enalbed disable button
			
							 }  
							 else  
							 {  
								 usernameok = true;  
								 usernameinfo.html("Username is ok.").removeClass('Error').addClass('Green');  
								 //user name is ok. disable it move to other function
								 $j("#proceed").removeAttr("disabled"); //enable button
								  //display java applet in iframe :S
								 $j('#appletframe').attr('src', 'applet_files/applet.php?name='+username.val());
							
                 			 }  
                         }  
         				});  
				}
     });  
		 
	$j("#proceed").click(function ()
			{
				 username.attr("disabled","disabled");	 	
				
				 $j('#cometinfo, #appletdiv').slideDown("slow");
				 $j('#proceed').attr("disabled","disabled");
			});
	
	$j("#attempt").click(function ()
	{
                 $j('#appletframe').removeAttr("src");
				 $j('#appletframe').attr('src', 'applet_files/applet.php?name='+username.val());
	});
	
	$j("#create").click(function ()
	{
                var i = $j("#patterncount").html();
				if(i > 11) { //number of patterns before template creation can happen
					$j.ajax({  
						 type: "POST",  
						 data: "type=new&name="+$j('#username').val(),  
						 url: "TemplateEngine.php",  
						 success: function(data){    
						 		$j("#proceed").attr("disabled","disabled");	 	
								$j("#create").attr("disabled","disabled");
								$j("#attempt").attr("disabled","disabled");	 	
								$j('#appletdiv').hide("slow");
                         }  
         				});  
					
				}
				else
				{
					jAlert('Not enough patterns to create Template.');
				}
	});
	
});