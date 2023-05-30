// Slideshow
var slideshow = document.querySelector('.slideshow');
var images = slideshow.querySelectorAll('img');
var currentImage = 0;

function nextImage() {
  currentImage = (currentImage + 1) % images.length;
  slideshow.style.backgroundImage = 'url(' + images[currentImage].src + ')';
}

setInterval(nextImage, 2000);

// Contact form validation
var form = document.querySelector('form');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  var name = document.querySelector('input[name="name"]').value;
  var email = document.querySelector('input[name="email"]').value;
  var message = document.querySelector('textarea').value;

  if (name === '') {
    alert('Please enter your name.');
    return;
  }

  if (email === '') {
    alert('Please enter your email address.');
    return;
  }

  if (message === '') {
    alert('Please enter your message.');
    return;
  }

  // Send the email
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '/contact.php');
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('name=' + encodeURIComponent(name) + '&email=' + encodeURIComponent(email) + '&message=' + encodeURIComponent(message));

  if (xhr.status === 200) {
    alert('Your message has been sent.');
    form.reset();
  } else {
    alert('An error occurred while sending your message.');
  }
});

// Dynamic greeting
var time = new Date();
var hour = time.getHours();

function getGreeting() {
  switch (hour) {
    case 6:
      return 'Good morning!';
    case 12:
      return 'Good afternoon!';
    case 18:
      return 'Good evening!';
    default:
      return 'Hello!';
  }
}
document.querySelector('header h1').textContent = getGreeting();