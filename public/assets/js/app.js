$('.owl-carousel').owlCarousel({
    loop:true,
    nav:true,
    navText: [`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"><path d="M15 18L9 12L15 6" stroke="#777777" stroke-width="2"/></svg>`,`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"><path d="M9 6L15 12L9 18" stroke="#777777" stroke-width="2"/></svg>`],
    dots: false,
    responsive:{
        0:{
            items: 1
        },
        992:{
            items: 1,
            nav: false,
            dots: true
        }
    }
})

let navbarToggler = $(".navbar-toggler");
let navbarLinks = $(".navbar-links");
let searchToggler = $(".search-toggler");
let mobileSearch = $(".mobile-search");

navbarToggler.on("click", () => {
    navbarLinks.slideToggle();
});

searchToggler.on("click", () => {
    mobileSearch.slideToggle();
});