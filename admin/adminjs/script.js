const menu = document.querySelectorAll(".listmenu-2");
// console.log(menu);
menu.forEach(mn => {
    mn.addEventListener('click', () => {
        document.querySelector('.active')?.classList.remove('active')
        mn.classList.add('active')
    })
})