//     let text = $("input").val();
// console.log("Script Loaded")


// console.log(text);

// $("[type='button']").click(function(){
//     let text = $("input").val();
//     $("h5").html(text);
// });


// document.querySelector("[type='button']").addEventListener("click", function(){
//     let text = document.querySelector("input").value;
//     document.querySelector("h5").innerHTML = text;
// });

// $("input").keyup(function(){
//     let text = $("input").val();
//     $("h5").html(text);
// });


$("form").submit(function(e){
 e.preventDefault();
 let inputValue = $("input").val();
 if(inputValue === ""){
    $('small').text("input is requred").css('color','red');
 }
 else{
    $('small').text(inputValue);
    // $('form').submit();
    this.submit();
    alert("Form Submited");
 }
});

