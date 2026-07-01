// jquery-click-scroll 
// Updated version
$(document).ready(function() {
    var sectionArray = [1, 2, 3, 4, 5, 6];
    var offsetTolerance = 90; // Jarak offset agar tidak tertutup navbar sticky

    // 1. Fungsi Smooth Scroll
    $('.click-scroll').on('click', function(e) {
        var href = $(this).attr('href');
        
        // Cek apakah href adalah internal link (mengandung #)
        if (href && href.indexOf('#') !== -1) {
            var targetId = href.substring(href.indexOf('#'));
            var targetSection = $(targetId);

            if (targetSection.length) {
                e.preventDefault(); // Hanya stop reload jika target ID ditemukan di halaman ini
                
                $('html, body').stop().animate({
                    'scrollTop': targetSection.offset().top - offsetTolerance
                }, 300);
                
                // Sinkronisasi class active secara instan
                $('.nav-link').removeClass('active').addClass('inactive');
                $(this).addClass('active').removeClass('inactive');
            }
        }
    });

    // 2. Logic Scroll Spy (Optimasi deteksi scroll)
    $(window).on('scroll', function() {
        var docScroll = $(document).scrollTop();
        
        $.each(sectionArray, function(index, value) {
            var section = $('#section_' + value);
            
            if (section.length) {
                var offsetSection = section.offset().top - (offsetTolerance + 10);
                
                // Cek apakah posisi scroll berada di dalam rentang section
                if (docScroll >= offsetSection) {
                    $('.navbar-nav .nav-link').removeClass('active').addClass('inactive');
                    $('.navbar-nav .nav-link').eq(index).addClass('active').removeClass('inactive');
                }
            }
        });
    });
});