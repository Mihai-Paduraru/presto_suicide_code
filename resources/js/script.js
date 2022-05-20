// Import Swiper JS
import Swiper from 'swiper/bundle';

// Swiper Homepage
var swiper = new Swiper(".swiperHomepage", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  loopFillGroupWithBlank: true,
  scrollbar: {
    el: ".swiper-scrollbar",
    hide: true,
  },
  grabCursor: true,
  breakpoints: {
    576: {
      slidesPerView: 1,
      spaceBetween: 15,
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    1024: {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    1400:{
      slidesPerView: 3,
      spaceBetween: 40,
    }
  }
});
// End Swiper Homepage

// Navbar
let sidebar = document.querySelector('.sidebar');
let title = document.querySelector('.title-wrapper');
let navItems = document.querySelectorAll('.link-container');
let closeIcon = document.querySelector('.close-icon');
let innerContainers = document.querySelectorAll('.inner-container');
let sideLinks = document.querySelectorAll('.nav-link');

// Spostamento titolo header al cambio size della navbar
if(sidebar){
  if(window.innerWidth > 992){
    sidebar.addEventListener('mouseover', ()=> {
      title.style.transform = 'translateX(400px)';
    });
    sidebar.addEventListener('mouseout', ()=> {
      title.style.transform = 'translateX(0px)';
    });
  }
}


// Funzionamento sidebar
if(!closeIcon){
  sideLinks.forEach(sidelink =>{
    sidelink.addEventListener('mouseover', ()=>{
      sidelink.classList.add('nav-link-active');
    })
    sidelink.addEventListener('mouseout', ()=>{
      sidelink.classList.remove('nav-link-active');
    })
  });
}


// Funzionamento navbar mobile
if(closeIcon){
  navItems.forEach((item, idItem) =>{
    item.addEventListener('click', () => {
      item.classList.add('active');
      innerContainers.forEach((container, idContainer) =>{
        if(idItem == idContainer){
          if(idContainer > 1){
            container.style.transform= `translateY(-157px) translateX(-${(idItem * 45) + 45}px)`;
          }else{
            container.style.transform= `translateY(-157px) translateX(-${idItem * 45}px)`;
          }
          container.style.height= `200px`;
          container.classList.remove('invisible');
        }else{
          container.style.transform= `translateY(0px)`;
          container.style.height= `0px`;
          container.classList.add('invisible');
        }
      })
      closeIcon.style.transform= `translateY(-148px) translateX(100px)`;
      closeIcon.classList.remove('invisible');
      navItems.forEach((otherItem, otherId )=>{
        if (otherId != idItem){
          otherItem.classList.remove('active');
        }
      });
    });
});

closeIcon.addEventListener('click', () => {
  closeIcon.style.transform= `translateY(0px)`;
  closeIcon.classList.add('invisible');
  innerContainers.forEach(container =>{
    container.style.transform= `translateY(0px)`;
    container.style.height= `0px`;
    container.classList.add('invisible');
  });
  navItems.forEach(otherItem =>{

      otherItem.classList.remove('active');

  });
})
}




// Carousel lista show
var swiper = new Swiper(".mySwiper", {
  spaceBetween: 10,
  grabCursor: true,
  direction: "horizontal",
  slidesPerView: 2,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    768: {
      direction: "horizontal",
      slidesPerView: 2,
    },
    992: {
      direction: "vertical",
      slidesPerView: 2,
    },
    1200: {
      direction: "vertical",
      slidesPerView: 3,
    },
  },
});
var swiper2 = new Swiper(".mySwiper2", {
  loop: true,
  grabCursor: true,
  spaceBetween: 30,
  thumbs: {
    swiper: swiper,
  },
  breakpoints: {
    768: {
      spaceBetween: 30,
    },
  },
});


// Import JQuery
import $ from 'jquery';
// Dropzone
$(function(){
    if ($("#drophere").length > 0){
      let csrfToken = $('meta[name="csrf-token"]').attr('content');
      let uniqueSecret = $('input[name="uniqueSecret"]').attr('value');
  
      let myDropzone = new Dropzone('#drophere', {
        url: '/ad/images/upload',
        params: {
            _token: csrfToken,
            uniqueSecret: uniqueSecret
        },
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
  
        init: function(){
          $.ajax({
            type: 'GET',
            url: '/ad/images',
            data: {
              uniqueSecret: uniqueSecret
            },
            dataType: 'json'
          }).done(function(data){
            $.each(data, function(key, value){
              let file = {
                serverId: value.id
              };
  
              myDropzone.options.addedfile.call(myDropzone, file);
              myDropzone.options.thumbnail.call(myDropzone, file, value.src);
            });
          });
        }
      });
  
      myDropzone.on("success", function(file, response){
        file.serverId = response.id;
      });
  
      myDropzone.on("removedfile", function(file){
        $.ajax({
          type: 'DELETE',
          url: '/ad/images/remove',
          data: {
            _token: csrfToken,
            id: file.serverId,
            uniqueSecret: uniqueSecret
          },
          dataType: 'json'
        });
      });
    }
  });