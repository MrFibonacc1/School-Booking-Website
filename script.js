

//These are all just methods
//Header scrolling affect
//And for the nav bar
//Used to make the page look nice

//When a button is clicked, it will add and remove certain classes below


// header scrolling effect
$(window).on('scroll', function(){
	if($(window).scrollTop()){
      $('header').addClass('nav-show');

	} 
	else{
		$('header').removeClass('nav-show');
	}

})








let menu = document.querySelector('#menu-bars');
let header = document.querySelector('header');
 
menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    header.classList.toggle('active');
}
 
window.onscroll = () =>{
    menu.classList.remove('fa-times');
    header.classList.remove('active');
}
 
let cursor1 = document.querySelector('.cursor-1');
let cursor2 = document.querySelector('.cursor-2');
 
window.onmousemove = (e) =>{
    cursor1.style.top = e.pageY + 'px';
    cursor1.style.left = e.pageX + 'px';
    cursor2.style.top = e.pageY + 'px';
    cursor2.style.left = e.pageX + 'px';
}
 
document.querySelectorAll('a').forEach(links =>{
 
    links.onmouseenter = () =>{
        cursor1.classList.add('active');
        cursor2.classList.add('active');
    }
 
    links.onmouseleave = () =>{
        cursor1.classList.remove('active');
        cursor2.classList.remove('active');
    }
 
});







  