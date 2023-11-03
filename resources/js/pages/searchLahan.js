import $ from "jquery";
import debounce from "lodash/debounce";

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
            var elementsToHide = [];
            var elementsNotToHide = [];

            // Loop through elements with class .lokasi-lahan in big screen and categorize elements to hide or show
            $("#big-screen-lahan .lokasi-lahan").each(function () {
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

                // Categorize elements based on whether they should be hidden or not
                if (shouldHide) {
                    elementsToHide.push(this);
                } else {
                    elementsNotToHide.push(this);
                }
            });

            // Hide elements in the elementsToHide array
            elementsToHide.forEach(function (element) {
                $(element).addClass("hidden");
            });

            // Show elements in the elementsNotToHide array
            elementsNotToHide.forEach(function (element) {
                $(element).removeClass("hidden");
            });
        },
    });
}, 300 // milliseconds debounce interval
));
