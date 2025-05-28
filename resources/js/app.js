import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import AOS from 'aos'

import 'aos/dist/aos.css'

AOS.init({
  once: false // la animación se ejecuta cada vez que el elemento entra en pantalla
})