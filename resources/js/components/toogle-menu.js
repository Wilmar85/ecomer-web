document.addEventListener('DOMContentLoaded', function () {
	
	const navbarToggle = document.getElementById('navbar-toggle');
	const navbarMenu = document.getElementById('navbar-menu');


	navbarToggle.addEventListener('click', () =>{
		navbarToggle.classList.toggle('active');
		navbarMenu.classList.toggle('active');
		console.log(navbarToggle)
		console.log(navbarMenu)
	})
})