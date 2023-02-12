let url = "/api/tags";
let modalTags = document.getElementById("js-modal-tags");

//init tags = prepare for write tags, remove text information and set the focus on input tags
const initTags = function(e) {
    modalTags.firstElementChild.innerText = "";
    let inputTag = document.querySelector(".input-tag-container input");
    inputTag.focus();
    inputTag.addEventListener('input', addTags);
    modalTags.removeEventListener('click', initTags);
}

const addTags = function(e) {
    console.log("hello");
}

fetch(url)
.then(response => {
    if (response.ok) {
        return response.json();
    }
    else {
        console.log("Un problème est survenu sur la récupération des tags sur le serveur, code status: " + response.status);
    }
})
.then(tags => {
    modalTags.addEventListener('click', initTags);
})

