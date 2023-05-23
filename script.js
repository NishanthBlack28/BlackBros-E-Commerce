// Script for navigation bar
const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('nav-bar');
const shake = document.getElementById('shake');

if (bar) {
  bar.addEventListener('click', () => {
    nav.classList.add('active');
  });
}

if (bar) {
  bar.addEventListener('click', () => {
    shake.classList.add('active');
  });
}

if (close) {
  close.addEventListener('click', () => {
    nav.classList.remove('active');
  });
}

if (close) {
  close.addEventListener('click', () => {
    shake.classList.remove('active');
  });
}
