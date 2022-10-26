$('.responsive').slick({
    autoplay: true,
    dots: true,
    customPaging: function(slider, i) {
        var thumb = $(slider.$slides[i]).data();
        return `<div class="dotNumber"><a>${i + 1}</a></div>`;
    },
    arrows: false,
    infinite: true,
    speed: 1000,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});