let currentIndex = 1;
showSlides(currentIndex);

function changeSlide(n) {
showSlides(currentIndex += n);
}

function currentSlide(n) {
showSlides(currentIndex = n);
}

function showSlides(n) {
let slides = document.querySelectorAll('.slide');
let dots = document.querySelectorAll('.dot');

if (n > slides.length) {
currentIndex = 1;
}
if (n < 1) {
currentIndex = slides.length;
}

slides.forEach((slide, index) => {
    slide.classList.remove('active'); 
});

dots.forEach((dot, index) => {
dot.classList.remove('active');
});

slides[currentIndex - 1].classList.add('active');
dots[currentIndex - 1].classList.add('active'); 
}

function openLightbox(imgElement) {
    var modal = document.getElementById("lightboxModal");
    var modalImg = document.getElementById("lightboxImage");
    var captionText = document.getElementById("lightboxCaption");
    
    modal.style.display = "block";
    modalImg.src = imgElement.src.replace("-thumbnail", ""); 
    captionText.innerHTML = imgElement.alt;
}

function closeLightbox() {
    var modal = document.getElementById("lightboxModal");
    modal.style.display = "none";
}

