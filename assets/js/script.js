let aside = document.querySelector('aside');
let button = document.querySelector('.bi-list');
button.addEventListener('click', () => {
    aside.classList.toggle('active');
});


let show = document.querySelectorAll('.show');
let dr = document.querySelectorAll('.dropdown');
let iconDr = document.querySelectorAll('.bi-caret-down-fill');
dr[0].addEventListener('click', () => {
    show[0].classList.toggle('aktif');
    iconDr[0].classList.toggle('rotate');
});
dr[1].addEventListener('click', () => {
    iconDr[1].classList.toggle('rotate');
    show[1].classList.toggle('aktif');
});

dr[2].addEventListener('click', () => {
    iconDr[2].classList.toggle('rotate');
    show[2].classList.toggle('aktif');
});
