$(window).scroll(function() {
  if ($("#menu1").offset().top > 56) {
      $("#menu1").addClass("bg-info");
  } else {
      $("#menu1").removeClass("bg-info");
  }
});
$(window).scroll(function(){
	if ($("#menu2").offset().top > 56) {
      $("#menu2").addClass("bg-info");
      $("#textLog").text("U T S E M");
  } else {
      $("#menu2").removeClass("bg-info");
      $("#textLog").text("S I T U T");
  }
});

const classSha = "cardShadow",
card1 = document.querySelector("#cardSh"), card2 = document.querySelector("#cardSh1"),
card3 = document.querySelector("#cardSh2"), card4 = document.querySelector("#cardSh3"),
card5 = document.querySelector("#cardSh4");

card1.addEventListener("mouseover", function(){
  card1.classList.add(classSha);
});
card1.addEventListener("mouseleave", function(){
  card1.classList.remove(classSha);
});
card2.addEventListener("mouseover", function(){
  card2.classList.add(classSha);
});
card2.addEventListener("mouseleave", function(){
  card2.classList.remove(classSha);
});
card3.addEventListener("mouseover", function(){
  card3.classList.add(classSha);
});
card3.addEventListener("mouseleave", function(){
  card3.classList.remove(classSha);
});
card4.addEventListener("mouseover", function(){
  card4.classList.add(classSha);
});
card4.addEventListener("mouseleave", function(){
  card4.classList.remove(classSha);
});
card5.addEventListener("mouseover", function(){
  card5.classList.add(classSha);
});
card5.addEventListener("mouseleave", function(){
  card5.classList.remove(classSha);
});