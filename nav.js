document.addEventListener('DOMContentLoaded', function(){
  const breakpoint = 768;
  function moveNav(){
    const nav = document.querySelector('header .nav nav');
    const menu = document.getElementById('hamburgerMenu');
    if(!nav || !menu) return;
    if(window.innerWidth <= breakpoint){
      if(!menu.querySelector('.mobile-nav')){
        const mobileNav = nav.cloneNode(true);
        mobileNav.classList.add('mobile-nav');
        mobileNav.style.display = 'block';
        mobileNav.querySelectorAll('a').forEach(a=>{ a.style.display='block'; a.style.padding='10px 12px'; a.style.color='inherit'; a.style.textDecoration='none'; });
        // Normalize active state for mobile: remove any copied 'active' and set it based on current path
        mobileNav.querySelectorAll('a').forEach(a=>{
          a.classList.remove('active');
          try{
            const linkPath = new URL(a.getAttribute('href'), location.href).pathname.replace(/\/$/, '');
            const curPath = location.pathname.replace(/\/$/, '');
            if(linkPath === curPath) a.classList.add('active');
          }catch(e){ /* ignore invalid URLs */ }
          // hide menu on mobile link click
          a.addEventListener('click', ()=>{ menu.style.display = 'none'; });
        });
        menu.insertBefore(mobileNav, menu.firstChild);
      }
      nav.style.display='none';
    } else {
      const mobileNav = menu.querySelector('.mobile-nav');
      if(mobileNav) mobileNav.remove();
      nav.style.display='';
      menu.style.display='none';
    }
  }
  moveNav();
  window.addEventListener('resize', moveNav);

  window.toggleMenu = function(){
    const menu = document.getElementById('hamburgerMenu');
    if(!menu) return;
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
  };

  window.logout = function(){ localStorage.removeItem('isLoggedIn'); window.location.href='index.html'; };

  // Close menu when clicking outside
  window.addEventListener('click', function(e){
    const menu = document.getElementById('hamburgerMenu');
    const burger = document.querySelector('.hamburger');
    if(menu && burger && !menu.contains(e.target) && !burger.contains(e.target)){
      menu.style.display = 'none';
    }
  });
});
