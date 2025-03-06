$(document).ready(function () {
    function loadRegion() {
        $.ajax({
            url: getRegionUrl,  // Use the URL from the HTML script tag
            method: "POST",
            dataType: "json",  // Ensure the response is parsed as JSON
            success: function (data) {
                console.log("Regions Loaded:", data);
                $('#customer_region').empty().append('<option value="">Select Region</option>');
                data.forEach(region => {
                    $('#customer_region').append(`<option value="${region.regCode}|${region.regDesc}">${region.regDesc}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error("Error loading regions:", xhr.responseText);
            }
        });
    }
    loadRegion();
});
