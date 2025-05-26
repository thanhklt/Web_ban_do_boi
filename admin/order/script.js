
const sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu_bar');
const closeBtn = document.querySelector("#close_btn");


menuBtn.addEventListener('click',()=>{
    sideMenu.style.display = "block";
}
)


closeBtn.addEventListener('click',()=>{
    sideMenu.style.display = "none";
}
)