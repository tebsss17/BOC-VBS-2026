import { createIcons, icons } from 'lucide';
import Alpine from 'alpinejs';


const initLucide = () => {
    createIcons({ icons });
};

initLucide();

document.addEventListener('livewire:navigated', () => {
    initLucide();
});


window.Alpine = Alpine

Alpine.start()
