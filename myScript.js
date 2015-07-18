function changeHTML() {
    "use strict";
    var dc = document.getElementById("demo");
    if (dc.innerHTML === "Chris Mott") {
        dc.innerHTML = "CreativeCode+";
    } else {
        dc.innerHTML = "Chris Mott";
    }
}
