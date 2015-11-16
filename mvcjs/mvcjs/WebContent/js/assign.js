/**
 * 
 */
$(document).ready(
   function() {
	  $("#assignmentDueDate").datetimepicker();
      $("#instructor").change(
    	  function () { 
    		  var option = $("#instructor option:selected").val();
    		  var url = "/mvcjs/assignment/instructor/" + option;
       	   	  $.ajax(
       	   	      {type: "GET",
    	    	  url: url,
    	    	  dataType: "json",
    	    	  success: 
    	    		  function(result){
	    	     	      var el = $("#assignmentId");
	    	     	      alert("We made it in " + result[0].assignmentId);
	    	       	      el.empty(); // remove old options
	    	       	      for (var i = 0; i < result.length; ++i) {
	    	       	    	       var id = result[i].assignmentId;
	    	       	    	       var title = result[i].assignmentTitle;
	    	       	               el.append($("<option></option>").attr("value", id).text(id + ": " + title));
	    	       	      }
    	    	       },
    	          error: function() {alert ('Failed to download JSON string');}
    	       });  
    	  });
   });