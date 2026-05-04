import { createIcons, icons } from 'lucide';

// Function para i-initialize ang icons
const initLucide = () => {
    createIcons({ icons });
};

// Takbo sa unang load
initLucide();

// Takbo ulit tuwing mag-ki-click ng wire:navigate links
document.addEventListener('livewire:navigated', () => {
    initLucide();
});
