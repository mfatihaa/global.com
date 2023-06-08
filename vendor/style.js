// Show & Hide Password Login
function myPassword() {
    var showhide = document.getElementById('pass');
    if (showhide.type === "password") {
        showhide.type = "text";
    } else {
        showhide.type = "password";
    };

    var showhide = document.getElementById('confirm');
    if (showhide.type === "password") {
        showhide.type = "text";
    } else {
        showhide.type = "password";
    };

    return showhide();
};