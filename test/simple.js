;$(function() {

    var sendCode = function(){
      var code = $(".textarea").val();
      console.log(code);
      var url = "http://localhost:8080/simpleoj";
      var success = function(data){
        $("#finalResult").html(data);
      }

      $.ajax({
        type: "POST",
        url: url,
        contentType: "plain/text; charset=utf-8",
        dataType: "text",
        data: code,
        success: success
      });
    }

    $("#submit").on("click",()=>{
      sendCode();
    });
});
