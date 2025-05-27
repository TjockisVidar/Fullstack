document.addEventListener("DOMContentLoaded", function () {
    let textsList = [];


    fetch("textUpload.php?action=count")
        .then(res => res.json())
        .then(data => {
            textsCount = data.total;
        });

    fetch("textUpload.php?action=getAll")
    .then(res => res.json())
    .then(data => {
        if (data.texts) {
            textsList = data.texts;

            for (let i = 0; i < textsList.length; i++) {
                const text = textsList[i];

                const nameContainer = document.createElement("div");
                nameContainer.classList = "indTextContainer";
                nameContainer.dataset.textid = text.TextID;
                document.getElementById("texts-container").appendChild(nameContainer);

                nameContainer.addEventListener("click", function (event) {
                    const textID = this.dataset.textid;

                    document.getElementById("change-page").style.left = (event.clientX-30)+"px";
                    document.getElementById("change-page").style.top = (event.clientY-30)+"px";
                    document.getElementById("change-page").style.display = "unset";
                    document.getElementById("change-page").style.animation = "changePageAnim 1s ease-in";
                    setTimeout(function() {
                        window.location.href = `textView.php?textID=${textID}`;
                    }, 900)
                });

                const textName = document.createElement("h2");
                textName.innerText = text.Heading;
                nameContainer.appendChild(textName);
            }
        }
    });

    document.getElementById("signup-button").addEventListener("click", function () {
        document.getElementById("slide-cover").style.animation = "slideLeft 0.7s ease-in";
        document.getElementById("right-container").style.animation = "rightNoSlide 0.7s ease-in";
        document.getElementById("left-container").style.animation = "leftNoSlide 0.7s ease-in";

        setTimeout(function () {
            document.getElementById("slide-cover").style.transform = "translate(-100%)";
            document.getElementById("right-container").style.transform = "translate(100%)";
            document.getElementById("left-container").style.transform = "translate(100%)";
        }, 700);
    });

    document.getElementById("login-button").addEventListener("click", function () {
        document.getElementById("slide-cover").style.animation = "slideRight 0.7s ease-in";
        document.getElementById("right-container").style.animation = "rightNoSlideBack 0.7s ease-in";
        document.getElementById("left-container").style.animation = "leftNoSlideBack 0.7s ease-in";

        setTimeout(function () {
            document.getElementById("slide-cover").style.transform = "translate(0%)";
            document.getElementById("right-container").style.transform = "translate(0%)";
            document.getElementById("left-container").style.transform = "translate(0%)";
        }, 700);
    });

    document.getElementById("logsignin-container").style.display = "none";

    document.getElementById("profile-button").addEventListener("click", function () {
        let logContainer = document.getElementById("logsignin-container");
        if (logContainer.style.display === "none") {
            logContainer.style.display = "grid";
            document.getElementById("close-text").style.display = "unset";
            document.getElementById("profile-text").style.display = "none";
            document.getElementById("profile-button").classList = "profile buttonOn";
            document.getElementById("upload-page").style.display = "none";
            document.getElementById("create-button").classList = "createButton";
            document.getElementById("create-add-close").style.transform = "rotate(0deg)";
        } else {
            document.getElementById("close-text").style.display = "none";
            document.getElementById("profile-text").style.display = "unset";
            document.getElementById("profile-button").classList = "profile profileOff";
            logContainer.style.display = "none";
        }
    });

    document.getElementById("create-button").addEventListener("click", function () {
        if (document.getElementById("upload-page").style.display == "none") {
            document.getElementById("logsignin-container").style.display = "none";
            document.getElementById("close-text").style.display = "none";
            document.getElementById("profile-text").style.display = "unset";
            document.getElementById("profile-button").classList = "profile profileOff";
            document.getElementById("upload-page").style.display = "unset";
            document.getElementById("create-button").classList = "createButton buttonOn";
            document.getElementById("create-add-close").style.transform = "rotate(45deg)";
        } else {
            document.getElementById("upload-page").style.display = "none";
            document.getElementById("create-button").classList = "createButton";
            document.getElementById("create-add-close").style.transform = "rotate(0deg)";
        }

        document.getElementById("text-text").addEventListener("input", function() {
            document.getElementById("letter-count").innerText = 5000-document.getElementById("text-text").value.length;
        })

        document.getElementById("submit-text").addEventListener("click", async function (event) {
            document.getElementById("upload-page").style.display = "none";

            const username = document.getElementById("text-username").value;
            const heading = document.getElementById("text-heading").value;
            const text = document.getElementById("text-text").value;
            const idResponse = await fetch("textUpload.php?action=getNextId");
            const idData = await idResponse.json();
            const textID = idData.nextId;

            const formData = new FormData();
            formData.append("Username", username);
            formData.append("Heading", heading);
            formData.append("Text", text);
            formData.append("TextID", textID);

            fetch("textUpload.php", {
                method: "POST",
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status != "ok") {
                    alert("Fel: " + data.message);
                }
            })
            .catch(err => {
                console.error("Fel vid fetch:", err);
            });
        });
    });
});
