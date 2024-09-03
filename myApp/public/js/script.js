



// /**
//  *  Add event listeners to all video elements
//  * to track video competion and store the progress in the database
//  */



// let lesson = document.querySelector('.lesson');
// if(lesson){
   
//    lesson.addEventListener('ended', function () {
//       console.log(lesson);
   
//       console.log('Video ended');
//       markVideoAsCompleted(lesson);
   
//    });
// }

function markVideoAsCompleted(videoElement) {

   const videoId = videoElement.getAttribute('data-video-id');
   const userId = videoElement.getAttribute('data-user-id');
   console.log(videoId);


   fetch('/api/video/completed', {
      method: 'POST',
      headers: {
         'Content-Type': 'application/json',
         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
         video_id: videoId,
         user_id: userId
      })
   })
      .then(response => response.json())
      .then(data => {
         if (data.success) {
            alert('Video marked as completed!');
         }
      });

   console.log('done video marked')

}

//  /**
//       * add event listener to all playlists to show & hide palylist items
//       */

 const playlists = document.querySelectorAll('.playlist');

 if(playlists){
   playlists.forEach(element => {

      element.addEventListener('click', function() {
          // Get the arrow icon child element of the current  playlist class
          let arrowIcon = this.children.item(1);
 
          // Get playlist items of the current playlist class
          let playlistItems = this.nextElementSibling;
 
 
          if (playlistItems.style.display === 'none' || playlistItems.style.display === '' ) {
              playlistItems.style.display = 'block';
              arrowIcon.classList.add('rotate-90');
          } else {
              playlistItems.style.display = 'none';
              arrowIcon.classList.remove('rotate-90');
          }
 
      });
 
  });
 }

/**
 * add event listener to all close & open buttons to show & hide pop up pages
 */

// let popUp = document.querySelectorAll('.pop-up');
// console.log(popUp)

// let openBtns = document.querySelectorAll('.open-btn');
// console.log(opentBtns)

// opentBtns.forEach(btn => {
//    btn.addEventListener('click', function(){
//       console.log("clicked")

//    })
// })
















// let toggleBtn = document.getElementById('toggle-btn');
// let body = document.body;
// let darkMode = localStorage.getItem('dark-mode');

// const enableDarkMode = () => {
//    toggleBtn.classList.replace('fa-sun', 'fa-moon');
//    body.classList.add('dark');
//    localStorage.setItem('dark-mode', 'enabled');
// }

// const disableDarkMode = () => {
//    toggleBtn.classList.replace('fa-moon', 'fa-sun');
//    body.classList.remove('dark');
//    localStorage.setItem('dark-mode', 'disabled');
// }

// if (darkMode === 'enabled') {
//    enableDarkMode();
// }

// toggleBtn.onclick = (e) => {
//    darkMode = localStorage.getItem('dark-mode');
//    if (darkMode === 'disabled') {
//       enableDarkMode();
//    } else {
//       disableDarkMode();
//    }
// }

// let profile = document.querySelector('.header .flex .profile');

// document.querySelector('#user-btn').onclick = () => {
//    profile.classList.toggle('active');
//    search.classList.remove('active');
// }

// let search = document.querySelector('.header .flex .search-form');

// document.querySelector('#search-btn').onclick = () => {
//    search.classList.toggle('active');
//    profile.classList.remove('active');
// }

// let sideBar = document.querySelector('.side-bar');

// document.querySelector('#menu-btn').onclick = () => {
//    sideBar.classList.toggle('active');
//    body.classList.toggle('active');
// }

// document.querySelector('#close-btn').onclick = () => {
//    sideBar.classList.remove('active');
//    body.classList.remove('active');
// }

// window.onscroll = () => {
//    profile.classList.remove('active');
//    search.classList.remove('active');

//    if (window.innerWidth < 1200) {
//       sideBar.classList.remove('active');
//       body.classList.remove('active');
//    }
// }