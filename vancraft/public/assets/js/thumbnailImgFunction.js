// function declaration
// update thumbnails image, when you add image to post and answer

function checkInputImg(imageInput) {
    let files = imageInput.files;

    if (files.length > 4) {
        return false;
    }

    for (let i = 0; i < files.length; i++) {
        if (files[i].size > 2000000) {
            return false;
        }
        if (files[i].type === "image/png" || files[i].type === "image/jpeg" || files[i].type === "image/gif") {
            return true;
        }
        else {
            return false;
        }
    }
}

function updateThumbnails(elt, userInput) {
    let files = userInput.files;

    let oldImg = document.querySelectorAll("#add-img img");
    for (let i = 0; i < oldImg.length; i++) {
        oldImg[i].remove(); //remove old images
    }

    for (let i = 0; i < files.length; i++) {
        let img = document.createElement("img");
        img.classList.add("img-thumbnails");

        elt.appendChild(img);

        const reader = new FileReader();
        reader.onload = (e) => {img.src = e.target.result};
        reader.readAsDataURL(files[i]);
    }
}

const addImage = function() {
    if (!checkInputImg(imageInput)) {
        displayErrorMsg(errorMsg, "Erreur avec le fichier téléversé, il doit être de type png/jpeg/gif, ne pas dépasser 2mo, moins de 4 fichiers");
    }
    else {
        let imgContainer = document.querySelector("#add-img label");
        updateThumbnails(imgContainer, imageInput);
    }
}