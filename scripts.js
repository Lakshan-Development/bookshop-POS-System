const contextMenu = document.querySelector(".wrapper"),
shareMenu = contextMenu.querySelector(".share-menu");

window.addEventListener("contextmenu", e => {
    e.preventDefault();
    let x = 530, y = 300,
    winWidth = window.innerWidth,
    winHeight = window.innerHeight,
    cmWidth = contextMenu.offsetWidth,
    cmHeight = contextMenu.offsetHeight;
    contextMenu.style.visibility = "visible";
});

document.addEventListener("click", () => contextMenu.style.visibility = "hidden");