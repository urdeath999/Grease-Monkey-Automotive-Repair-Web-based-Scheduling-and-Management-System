// Array of testimonials
const testimonials = [
    {
        image: 'images/charles.jpg',
        name: 'Charles Dean Candelaria',
        text: '"Mabilis lang ang pag book ng appointment dahil sa tulong na rin ng website. Plus poiints ito para sakin!"'
    },
    {
        image: 'images/franken.jpg',
        name: 'Franken Roxas',
        text: '"Mababait ang mga technicians sa Grease Monkey! Satisfied ako sa kanilang trabaho."'
    },
    {
        image: 'images/cedrix.jpg',
        name: 'Cedrix James Estoquia',
        text: '"Mura at quality ang gawa!"'
    },
    {
        image: 'images/marc.jpg',
        name: 'Marc Mahilum',
        text: '"Efficient at effective ang kanilang customer support"'
    },
    {
        image: 'images/maythur.jpg',
        name: 'Maythur Espiritu',
        text: 'Sa uulitin ulit mga boss! Dito na ako magpapagawa sa mga sususnod'
    },
];

let currentTestimonial = 0;

function createTestimonialCard(testimonial) {
    return `
        <div class="testimonial-card">
            <img src="${testimonial.image}" alt="Client Photo" class="testimonial-image">
            <h4 class="client-name">${testimonial.name}</h4>
            <p class="testimonial-text">${testimonial.text}</p>
        </div>
    `;
}

function updateTestimonials(index) {
    const testimonialContainer = document.getElementById('testimonial-container');
    
    testimonialContainer.innerHTML = '';

    const currentTestimonialHTML = createTestimonialCard(testimonials[index]);
    const nextIndex = (index + 1) % testimonials.length;
    const nextTestimonialHTML = createTestimonialCard(testimonials[nextIndex]);

    testimonialContainer.innerHTML = currentTestimonialHTML + nextTestimonialHTML;
}

document.getElementById('prev-btn').addEventListener('click', () => {
    currentTestimonial = (currentTestimonial === 0) ? testimonials.length - 1 : currentTestimonial - 1;
    updateTestimonials(currentTestimonial);
});

document.getElementById('next-btn').addEventListener('click', () => {
    currentTestimonial = (currentTestimonial + 1) % testimonials.length;
    updateTestimonials(currentTestimonial);
});

updateTestimonials(currentTestimonial);
