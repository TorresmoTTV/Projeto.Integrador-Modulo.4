function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Toggle do submenu ao clicar em "Criar Relatórios"
function toggleSubmenu(event) {
    event.preventDefault(); // impede que o <a> recarregue a página
    const submenu = document.getElementById("submenuRelatorio");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}

// Fecha menus se clicar fora
window.onclick = function(event) {
    const dropdown = document.getElementById("myDropdown");
    const submenu = document.getElementById("submenuRelatorio");

    if (!event.target.closest('.menu')) {
        dropdown.classList.remove("show");
        submenu.style.display = "none";
    }
}