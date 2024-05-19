// dynamic navbar background
document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener("scroll", function() {
        let navbar = document.getElementById('nav-container')
        var height = document.getElementById('heroes').offsetHeight;
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        list = document.querySelectorAll('[id=nav-text]')
        if(scrollTop > height) {
            navbar.classList.remove('md:absolute')
            navbar.classList.add('md:fixed', 'md:-top-40', 'md:translate-y-40', 'md:transition-transform', 'md:duration-300')
            document.getElementById('nav-container').classList.add('md:animate-fadein');
            document.getElementById('nav-container').classList.remove('md:animate-fadeout');
            document.getElementById('logo').classList.add('md:animate-textfadein');
            document.getElementById('logo').classList.remove('md:animate-textfadeout');
            document.getElementById('nav-list').classList.add('md:animate-textfadein');
            document.getElementById('nav-list').classList.remove('md:animate-textfadeout');
        } else {
            navbar.classList.remove('md:fixed', 'md:-top-40', 'md:translate-y-40', 'md:transition-transform', 'md:duration-300')
            navbar.classList.add('md:absolute')
            document.getElementById('nav-container').classList.add('md:animate-fadeout');
            document.getElementById('nav-container').classList.remove('md:animate-fadein');
            document.getElementById('logo').classList.add('md:animate-textfadeout');
            document.getElementById('logo').classList.remove('md:animate-textfadein');
            document.getElementById('nav-list').classList.remove('md:animate-textfadein');
            document.getElementById('nav-list').classList.add('md:animate-textfadeout');
        }
    })
}); 