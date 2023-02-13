let url = "/api/tags";
var tags;

let modalContener = `<ul id='js-list-tag'>
                    </ul>`

//init tags = prepare for write tags, remove text information and set the focus on input tags
const initTags = function(e) {
    this.firstElementChild.innerText = "";
    let inputTag = document.querySelector(".input-tag-container input");
    inputTag.focus();
    inputTag.addEventListener('input', addTags);
    inputTag.addEventListener('focus', addTags);
    inputTag.addEventListener('click', stopPropagation);
    this.removeEventListener('click', initTags);
}

const addTags = function(e) {

    if (this.value != "" && this.value != " ") { //check if the user input tag is not an empty string, or a space
        let modal = document.getElementById("js-modal-tag");
        if (modal.style.display = "none") {
            modal.innerHTML = modalContener; //modalContener have to be add only once, modalContent need to be refresh on every change
            modal.style.display = null;

            let listTags = document.getElementById("js-list-tag");

            DOMinitCreateTags(listTags);

            document.querySelector("body").addEventListener('click', closeModal);
        }

        let listTags = document.getElementById("js-list-tag");

        let listElt = listTags.children;
        for (let i = 0; i < listElt.length; i++) {
            if (i > 1) {
                listTags.removeChild(listElt[i])
            }
        }

        let tagStartWith = checkTags(tags, this.value);

        for (let i = 0; i < tagStartWith.length; i++) {
            if (i > 10) break;
            let li = document.createElement("li");
            li.addEventListener('click', closeModal);
            listTags.appendChild(li).innerText = tagStartWith[i];
        }

        let tagInput = document.getElementById("js-tag-input");
        tagInput.innerText = '"' + this.value + '"';
    }
    else {
        document.getElementById("js-list-tag").removeEventListener('click', getInputTag);
        modal.innerHTML = "";
        modal.style.display = "none";
    }
}

function DOMinitCreateTags(listTags) { //add "Créer un tag xxx" to the list tags DOM
    let i = document.createElement("i");
    let li = document.createElement("li");
    let hr = document.createElement("hr");
    let span = document.createElement("span");

    hr.addEventListener('click', stopPropagation);

    li.appendChild(i).classList.add("fa-solid", "fa-tag", "margin-right-8");
    li.innerHTML += "Créer un tag ";
    li.appendChild(span).id = "js-tag-input";
    listTags.appendChild(li);
    listTags.appendChild(hr);

    listTags.addEventListener('click', getInputTag);
    li.addEventListener('click', closeModal);
}

function  DOMinitNewInput() {
    let newInput = document.createElement("input");
    newInput.maxLength = 28;
    newInput.autocomplete = "off";
    newInput.name = "tags";
    newInput.type = "text";
    let div = document.createElement("div");
    let divModal = document.createElement("div");
    divModal.id = "js-modal-tag";
    divModal.classList.add("modal-tags");
    divModal.style.display = "none";
    div.classList.add("input-tag-container");
    div.appendChild(newInput);
    div.appendChild(divModal);

    document.querySelector(".post-tags-container").appendChild(div);
    newInput.addEventListener('input', addTags);
    newInput.focus();
}

const getInputTag = function (e) {
    let tag = checkInputTag(e);

    if (tag != false) {
        console.log(tag);

        document.getElementById("js-modal-tag").remove();
        let allInput = document.querySelectorAll(".input-tag-container input");
        let lastInput = allInput[allInput.length - 1];

        lastInput.value = tag;
        lastInput.disabled = true;
        lastInput.classList.add("tag-lock");

        DOMinitNewInput();
        
    }
}

function checkInputTag(element) {
    if(element.target.lastElementChild === null) {
        if (element.target.tagName === "LI") {
            return element.target.textContent;
        }
    }

    if (element.target.lastElementChild != null) {
        if (element.target.lastElementChild.id === "js-tag-input") {
            let tag = element.target.lastElementChild.textContent;
            return tag.substring(1, tag.length -1); //remove quote
        }
    }

    if (element.target.tagName === "I") {
        let tag = element.target.nextElementSibling.textContent;
        return tag.substring(1, tag.length -1);
    }
    if (element.target.tagName === "SPAN") {
        let tag = element.target.textContent;
        return tag.substring(1, tag.length - 1);
    }

    return false;
}

const stopPropagation = function (e) {
    e.stopPropagation();
}

const closeModal = function(e) {
    let modal = document.getElementById("js-modal-tag");
    if (modal.style.display === "none") return;

    e.preventDefault();
    modal.style.display = "none";
    modal.addEventListener('click', stopPropagation);
    removeCloseEventListener();
}

function removeCloseEventListener() {
    let parentTagList = document.getElementById("js-list-tag");
    let tagList = parentTagList.children;

    for (let i = 0; i < tagList.length; i++) {
        tagList[i].removeEventListener('click', closeModal);
    }
    document.querySelector("body").removeEventListener('click', closeModal);
}

//function that check if the first input of user exists in the array of tags, and return an array of tags that begin with the same input
function checkTags(tags, value) {
    value = value.toLowerCase();
    tagStartWith = [];
    tags.forEach(tag => {
        if (tag.startsWith(value)) {
            tagStartWith.push(tag);
        }
    });

    return tagStartWith;
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
    let modalTags = document.querySelector(".post-tags-container");
    modalTags.addEventListener('click', initTags);
})

