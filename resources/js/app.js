import { createIcons, icons } from 'lucide';

const initLucide = () => {
    createIcons({ icons });
};

initLucide();

document.addEventListener('livewire:navigated', () => {
    initLucide();
});
