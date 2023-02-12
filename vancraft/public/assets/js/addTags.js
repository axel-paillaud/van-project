let url = "/api/tags";
var tags;

let modalContent = `<ul>
                        <li><i class="fa-solid fa-tag margin-right-8"></i>Créer un tag "<span id=js-tag-input></span>"</li>
                        <hr>
                    </ul>`

//init tags = prepare for write tags, remove text information and set the focus on input tags
const initTags = function(e) {
    this.firstElementChild.innerText = "";
    let inputTag = document.querySelector(".input-tag-container input");
    inputTag.focus();
    inputTag.addEventListener('input', addTags);
    this.removeEventListener('click', initTags);
}

const addTags = function(e) {
    if (this.value != "" && this.value != " ") { //check if the user input tag is not an empty string, or a space
        console.log(tags);
        let modal = this.nextElementSibling;
        modal.innerHTML = modalContent;
        let tagInput = document.getElementById("js-tag-input");
        tagInput.innerText = this.value;
    }
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
.then(getTags => {
    tags = getTags;
    let modalTags = document.getElementById("js-modal-tags");
    modalTags.addEventListener('click', initTags);
})

