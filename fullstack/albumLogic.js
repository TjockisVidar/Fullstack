document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("change-page").style.display = "unset";
    document.getElementById("change-page").style.animation = "changePageAnim 1s ease-in reverse";
    setTimeout(function() {
        document.getElementById("change-page").style.display = "none";
        document.getElementById("change-page").style.animation = "";
    }, 900)

    const params = new URLSearchParams(window.location.search);
    const textID = params.get("textID");

    if (!textID) {
        document.body.innerText = "Ingen text vald.";
        return;
    }


    fetch(`textUpload.php?action=getOne&textID=${textID}`)
    .then(res => res.json())
    .then(data => {
        if (data.error) {
            document.body.innerText = data.error;
        } else {
            document.getElementById("username").innerText = "Text by: " + data.Username;
            document.getElementById("heading").innerText = data.Heading;
            document.getElementById("text").innerText = data.Text;
        }
    })
    .catch(err => {
        document.body.innerText = "Något gick fel: " + err;
    });

    document.getElementById("logo-text").addEventListener("click", function(event) {
        document.getElementById("change-page").style.left = (event.clientX-30)+"px";
        document.getElementById("change-page").style.top = (event.clientY-30)+"px";
        document.getElementById("change-page").style.display = "unset";
        document.getElementById("change-page").style.animation = "changePageAnim 1s ease-in";
        setTimeout(function() {
            window.location = "index.php";
        }, 900)
    })
})