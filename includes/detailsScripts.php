<script>
  
  $(document).ready(function () {
	  
	 // $('#datePick').multiDatesPicker();

    $("#next").hide();
    $(".can").hide();
    $("#cartSelect").hide();
	$("#calendarSelect").hide();
	
	

    $(".cartButon").click(function () {
        $("#cartSelect").slideDown();
        $(".cartButon").fadeOut();
        $(".can").fadeIn();
        $("#next").fadeIn();
    });
    $(".can").click(function () {
        $("#cartSelect").slideUp();
        $(".cartButon").fadeIn();
        $(".can").fadeOut();
        $("#next").fadeOut();
		
});
		$("#next").click(function () {
			var dates = $('#calendar').multiDatesPicker('getDates');
			console.log(dates);
			console.log(typeof dates);
			datesString = JSON.stringify(dates);
			console.log(typeof datesString);
			console.log(datesString);
			console.log(datesString.length);
			var str_array = datesString.split(',');
			console.log(str_array);
			console.log(str_array.length);
			console.log(typeof str_array);
			
			var table = document.getElementById("calendarSelect");
			for (var i=0; i< str_array.length; i++) {
    			table = table + "<tr><td>"+ str_array[i]+"</td></tr>"; 
			}
			table = table + "</table>";

			return table;
			
			
			$("#cartSelect").slideUp();
			$("#calendarSelect").show();
			//$("#calendarSelect").text(dates);
			console.log(str_array);
			
		});

		$( "#calendar" ).multiDatesPicker({ 
		minDate: +1, maxDate: "+8D", 
		beforeShowDay: $.datepicker.noWeekends ,
		dateFormat: 'yy-mm-dd', 
		showButtonPanel: true, 
		 showOn: "button",
         buttonImage: "/comp344_ass1/images/calendar.gif",
         buttonImageOnly: true,
         buttonText: "Select date"});
});

  </script>