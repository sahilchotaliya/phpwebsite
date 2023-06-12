document.addEventListener('DOMContentLoaded', function() {
  const header = document.querySelector('header');

  function fixedNavbar() {
    header.classList.toggle('scrolled', window.pageYOffset > 0);
  }

  fixedNavbar();
  window.addEventListener('scroll', fixedNavbar);

  let menu = document.querySelector('#menu-btn');
  let userBtn = document.querySelector('#user-btn');
  
  // Function to show user details
  function showUserDetails() {
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
  }
  
  // Event listener for menu button
  menu.addEventListener('click', function() {
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
  });
  
  // Event listener for user button
  userBtn.addEventListener('click', showUserDetails);
  

  // const closeBtn = document.querySelector('#close-form');
  // closeBtn.addEventListener('click', () => {
  //   document.querySelector('.update-container').style.display = 'none';
  // });
});
