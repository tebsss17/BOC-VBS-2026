import { createIcons, icons } from 'lucide';
import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';


const initLucide = () => {
    createIcons({ icons });
};

initLucide();

document.addEventListener('livewire:navigated', () => {
    initLucide();
});


window.Alpine = Alpine

Alpine.start()

window.Chart = Chart;

