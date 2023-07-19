//slide show
let slideIndex = 1;
let slideshowTimer;

showSlides(slideIndex);
startSlideshow();

function currentSlide(n) {
    clearTimeout(slideshowTimer);
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    
    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }
    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    
    startSlideshow();
}

function startSlideshow() {
    clearTimeout(slideshowTimer);
    slideshowTimer = setTimeout(() => {
        slideIndex++;
        showSlides(slideIndex);
    }, 5000);
}


//Signup submit
function enableSubmit(){
    if(document.getElementById("checkbox").checked){
		document.getElementById("submitBtn").disabled=false;
	}
	else{
		document.getElementById("submitBtn").disabled=true;
	}
}

//admin dashboard nav links active
document.querySelectorAll(".navList").forEach(function (element){
    element.addEventListener('click',function (){
        document.querySelectorAll(".navList").forEach((e)=>{
            e.classList.remove('active')
            this.classList.add('active')
        })
    })
})

