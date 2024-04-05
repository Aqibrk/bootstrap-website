

function toggleModal() {
    $('#userModal').modal('toggle');
}

function changeColor(element) {
    // Remove active class from all nav items
    var navItems = document.querySelectorAll('.nav-link');
    navItems.forEach(function (item) {
        item.classList.remove('active');
    });

    // Add active class to the clicked nav item
    element.classList.add('active');
}


var backToTopBtn = document.getElementById("back-to-top");

window.addEventListener("scroll", function () {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTopBtn.style.display = "block";
    } else {
        backToTopBtn.style.display = "none";
    }
});

backToTopBtn.addEventListener("click", function () {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
});



$('.navbar-toggler').click(function () {
$('.navbar-collapse').toggleClass('show');
});


$('.navbar-nav>li>a').on('click', function(){
$('.navbar-collapse').removeClass('show'); // Change 'hide' to 'show'
});


      // Toggle modal function
      function toggleModal() {
        $('#userModal').modal('toggle');
    }

    // Automate carousel
    $('.carousel').carousel({
        interval: 3000, // Change slide interval here (in milliseconds)
        pause: 'hover' // Pause slide on hover
    });

    // Function to change button color on click
    function changeColor(element) {
        // Remove active class from all nav items
        var navItems = document.querySelectorAll('.nav-link');
        navItems.forEach(function(item) {
            item.classList.remove('active');
        });

        // Add active class to the clicked nav item
        element.classList.add('active');
    }

    // Back to top button functionality
    var backToTopBtn = document.getElementById("back-to-top");

    window.addEventListener("scroll", function() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            backToTopBtn.style.display = "block";
        } else {
            backToTopBtn.style.display = "none";
        }
    });

    backToTopBtn.addEventListener("click", function() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    });