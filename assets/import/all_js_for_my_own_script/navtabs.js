function openTab(evt, tabName, element) {
    var i, tabcontent, tablinks;

    // Hide all tab content
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the "active" class from all tab items
    tablinks = document.querySelectorAll(".nav-tabs li");
    tablinks.forEach(function(tab) {
        tab.classList.remove("active");
    });

    // Show the selected tab content
    document.getElementById(tabName).style.display = "block";

    // Add "active" class to the clicked tab
    element.parentElement.classList.add("active");
}