import $ from "jquery";
import debounce from "lodash/debounce";
import { tns } from "tiny-slider";

function createLahanElement(lahan) {
    const div = `
        <div class="p-3 cursor-pointer hover:bg-slate-100 rounded-md flex items-center lokasi-lahan"
            data-koordinat= ${JSON.stringify({
        lat: lahan.latitude,
        lng: lahan.longitude,
    })}>
            <div class="flex flex-row gap-3">
                <div class="flex-initial">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="w-full">
                    <p class="font-bold"> ${lahan.nama_lahan}</p>
                    <p class="font-medium text-primary ${lahan.new_nama}">${lahan.kecamatan + ", " + lahan.kota
        }
                    </p>
                </div>
            </div>
        </div>
    `;

    return div;
}

function renderCarousel(data) {
    $('#carousel-container').html('');

    var carouselDiv = document.createElement('div');
    carouselDiv.classList.add('my-carousel');

    data.forEach(function (item) {
        var slideItem = createLahanElement(item);
        $(carouselDiv).append(slideItem);
    });

    $('#carousel-container').append(carouselDiv);

    let width = screen.width;

    // Small and Medium Screen
    if (width >= 640 && width < 1024) {
        tns({
            container: carouselDiv,
            items: 2,
            slideBy: 'page',
            "mouseDrag": true,
            slideBy: 'page',
            rewind: true,
            autoplay: false,
            controls: true,
            nav: true,
        });
    } else if (width < 640) {
        // Small Screen
        tns({
            container: carouselDiv,
            items: 1,
            slideBy: 'page',
            "mouseDrag": true,
            slideBy: 'page',
            rewind: true,
            autoplay: false,
            controls: true,
            nav: true,
        });
    } else {
        tns({
            container: carouselDiv,
            items: 3,
            slideBy: 'page',
            "mouseDrag": true,
            slideBy: 'page',
            rewind: true,
            autoplay: false,
            controls: true,
            nav: true,
        });
    }
}

renderCarousel(seluruhLahan);
$(window).on("resize", function() {
    renderCarousel(seluruhLahan);
});


$("#search-lahan").on("keyup", debounce(function () {
    var searchTerm = $(this).val();

    $.ajax({
        url: url,
        method: "GET",
        data: {
            search: searchTerm,
        },
        success: function (data) {
            seluruhLahan = data.data_lahan;

            // Loop through elements with class .lokasi-lahan and handle based on parent's ID
            $(".lokasi-lahan").each(function () {
                var parentID = $(this).parent().attr("id");
                var koordinat = $(this).data("koordinat");
                var lat = koordinat.lat;
                var lng = koordinat.lng;
                var shouldHide = true;

                // Check if any lahan matches the lat and lng
                for (var i = 0; i < seluruhLahan.length; i++) {
                    var lahan = seluruhLahan[i];
                    if (lat === lahan.latitude && lng === lahan.longitude) {
                        shouldHide = false;
                        break;
                    }
                }

                // Handle elements based on parent's ID
                if (parentID === "big-screen-lahan") {
                    if (shouldHide) {
                        $(this).addClass("hidden");
                    } else {
                        $(this).removeClass("hidden");
                    }
                }

                renderCarousel(data.data_lahan);
            });
        },
    });
}, 500 // milliseconds debounce interval
));
