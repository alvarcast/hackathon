// Variables
const carousel = document.querySelector('.carousel');
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
let currentSlide = 0;

carousel.style.transition = 'transform 1.5s ease';

// Función para ir al siguiente slide
function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    updateCarousel();
}

// Función para ir al slide anterior
function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    updateCarousel();
}

// Función para actualizar el desplazamiento del carrusel
function updateCarousel() {
    const offset = -currentSlide * 100;
    carousel.style.transform = `translateX(${offset}%)`;
}
setInterval(nextSlide, 8000);