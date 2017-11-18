
   <script src="js/typeahead.js"></script> 
  <script src="assets/js/bootstrap.min.js"></script>
    <!-- <script src="assets/js/custom.js"></script> -->
  <script src="js/jquery.sticky-kit.min.js"></script>
  <script src="js/jquery.scrollbar.min.js"></script>
 <script src="js/script.js"></script>
  
   <script>
    $("#searchany").keyup(function() {
      var inputval = $( "#searchany" ).val();
      $.ajax({
            type: "POST",
            url: "api/searching.php?q="+inputval,
            success: function(data){
                 $("#searchlist").html(data);
            }
      });
    });
  </script>