ClassicEditor
           .create(document.querySelector('#editor'))
           .catch(error => {
               console.error(error);
           });

$(document).ready(function () {
   $("#selectAllBoxes").click(function () {
       
       if(this.checked){
           $(".checkBoxes").each(function () {
               this.checked = true;
           });
       }else{
           $(".checkBoxes").each(function () {
               this.checked = false;
           });
       }
   })
   var div_box = "<div id='load-screen'><div id='loading'></div></div>";
   $("body").prepend(div_box);
   $("#load-screen").delay(300).fadeOut(300,function () {
       $(this).remove();
   })

});





