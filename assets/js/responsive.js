const toggleButton = document.getElementById('toggle-button');
const navList = document.getElementById('nav');

toggleButton.addEventListener('click', () => {
    navList.classList.toggle('active');
    
})