/*  ---------------------------------------------------
    Template Name: Manup
    Description: Manup Event HTML Template
    Author: Colorlib
    Author URI: http://colorlib.com
    Version: 1.0
    Created: Colorlib
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------------
		Partner Slider
    ----------------------- */
    $(".partner-logo").owlCarousel({
        items: 6,
        dots: false,
        autoplay: true,
        loop: true,
        smartSpeed: 1200,
        margin: 116,
        responsive: {
            320: {
                items: 2,
            },
            480: {
                items: 3,
            },
            768: {
                items: 4,
            },
            992: {
                items: 5,
            },
            1200: {
                items: 6
            }
        }
    });

    /*------------------------
		Testimonial Slider
    ----------------------- */
    $(".testimonial-slider").owlCarousel({
        items: 2,
        dots: false,
        autoplay: false,
        loop: true,
        smartSpeed: 1200,
        nav: true,
        navText: ["<span class='fa fa-angle-left'></span>", "<span class='fa fa-angle-right'></span>"],
        responsive: {
            320: {
                items: 1,
            },
            768: {
                items: 2
            }
        }
    });

    /*------------------
        Magnific Popup
    --------------------*/
    $('.video-popup').magnificPopup({
        type: 'iframe'
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end
    

    // Use this for real timer date
    /*  var timerdate = "2020/01/01"; */

	$("#countdown").countdown(timerdate, function(event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));
    });

})(jQuery);



    function openModal(src) {
        document.getElementById("imageModal").style.display = "block";
        document.getElementById("modalImage").src = src;
    }

    function closeImageModal() {
        document.getElementById("imageModal").style.display = "none";
    }
    window.onclick = function(event) {
    const modal = document.getElementById("imageModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}







function daftarEvent(e, eventId, eventName) {
    e.preventDefault();

    // Simpan registrasi dulu
    fetch('/register-event', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        credentials: 'same-origin',
        body: JSON.stringify({
            event_id: eventId
        })
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 409) {
                throw new Error('Kamu sudah mendaftar event ini!');
            }
            throw new Error('Gagal simpan data registrasi.');
        }
        return response.json();
    })
    .then(data => {
        console.log('Registrasi berhasil:', data);

        // 2️⃣ Baru ambil Snap Token
        return fetch('/get-snap-token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            credentials: 'same-origin',
            body: JSON.stringify({ event_id: eventId,nama_event: eventName  })
        });
    })
    .then(response => response.json())
    .then(data => {
        console.log('Snap Token:', data.token);

        // 3️⃣ Tampilkan Midtrans popup
        window.snap.pay(data.token, {
            onSuccess: function(result){
            console.log("Pembayaran sukses:", result);
            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                html: `Terima kasih sudah melakukan pendaftaran untuk event <b>${eventName}</b>.`,
                confirmButtonText: 'OK'
            }).then(() => {
                // Optional: refresh halaman atau redirect ke halaman history
                location.reload();
                document.getElementById('btnUpload' + eventId).disabled = false;
            });
        },
            onPending: function(result){
                console.log("Menunggu pembayaran:", result);
                // Bisa update status pending di sini kalau perlu
            },
            onError: function(result){
                console.log("Pembayaran error:", result);
            },
            onClose: function(){
                console.log("Popup ditutup tanpa transaksi");
            }
        });
    })
    .catch(error => {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: error.message,
        });
    });
}


function updateHistoryNotif() {
    fetch('/history-notif-count')
        .then(response => response.json())
        .then(data => {
            let badge = document.getElementById('historyNotif');
            if(data.count > 0){
                badge.style.display = 'inline-block';
                badge.innerText = data.count;
            } else {
                badge.style.display = 'none';
            }
        })
        .catch(error => console.error('Notif Error:', error));
}

document.addEventListener('DOMContentLoaded', function () {
    updateHistoryNotif();
});
