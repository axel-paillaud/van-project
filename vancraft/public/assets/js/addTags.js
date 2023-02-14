let url = "/api/tags";
var tags;

//keep track of tags added by user
var userInputTags = [];
var countUserInputTags = 0;

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
    let modal = document.getElementById("js-modal-tag");
    if (this.value != "" && this.value != " ") { //check if the user input tag is not an empty string, or a space
        if (modal.style.display === "none") {
            modal.innerHTML = modalContener; //modalContener have to be add only once, modalContent need to be refresh on every change
            modal.style.display = null;

            let listTags = document.getElementById("js-list-tag");

            DOMinitCreateTags(listTags);

            document.querySelector("body").addEventListener('click', closeModal);
        }

        let listTags = document.getElementById("js-list-tag");

        let listElt = listTags.children;
        for (let i = 0; i < listElt.length; i++) {// clear list on every change, except for "Créer un tag ..." element
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
        let listTags = document.getElementById("js-list-tag");
        if (listTags != null) {
            document.getElementById("js-list-tag").removeEventListener('click', addInputTag);
        }  
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

    listTags.addEventListener('click', addInputTag);
    li.addEventListener('click', closeModal);
}

function  DOMinitNewInput() {
    let newInput = document.createElement("input");
    let icon = document.createElement("i");
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
    newInput.addEventListener('click', addTags);
    newInput.addEventListener('focus', addTags);
    newInput.addEventListener('click', stopPropagation);
    newInput.focus();
}

const addInputTag = function (e) {
    let tag = checkInputTag(e, userInputTags);
    let allInput = document.querySelectorAll(".input-tag-container input");
    let lastInput = allInput[allInput.length - 1];

    if (!Number.isInteger(tag)) {
        document.getElementById("js-modal-tag").remove();

        let icon = document.createElement("i");
        icon.classList.add("fa-solid", "fa-xmark", "xmark-tag-icon");
        icon.addEventListener('click', deleteTag);

        lastInput.parentElement.appendChild(icon);

        lastInput.setAttribute('value', tag);
        lastInput.disabled = true;
        //lastInput.classList.add("tag-lock");
        lastInput.parentElement.classList.add("tag-lock");
        lastInput.style.color = "white";
        userInputTags.push(tag);
        countUserInputTags++;

        lastInput.removeEventListener('click', addTags);
        lastInput.removeEventListener('focus', addTags);
        lastInput.removeEventListener('input', addTags);

        if (countUserInputTags < 5) {
            DOMinitNewInput();
        }
    }
    else { // if input tag is equal false, that's mean it's incorrect, so delete the current input and refocus
        lastInput.value = "";
        lastInput.focus();
        inputAlreadyHere = allInput[tag].parentElement;
        resetAnimation(inputAlreadyHere, "pulseTags 0.4s");
    }
}

const deleteTag = function (e) {
    let contenerInput = e.target.parentElement;
    let input = contenerInput.firstElementChild;

    e.target.removeEventListener('click', deleteTag);
    
    let indexOfDeleteUserTag = userInputTags.indexOf(input.value); // delete the tag also from the global array userInputTags
    userInputTags.splice(indexOfDeleteUserTag, 1);

    if (countUserInputTags != 5) {
        contenerInput.nextElementSibling.firstElementChild.focus(); //set the focus on the next target input
    }
    else {
        DOMinitNewInput();
    }

    contenerInput.remove();
    countUserInputTags--;
}

// bad code here, surely there is a better solution
function checkInputTag(element, userInputTags) {
    let tag;
    if(element.target.lastElementChild === null) {
        if (element.target.tagName === "LI") {
            tag = element.target.textContent;
            if (userInputTags.indexOf(tag) != -1) {
                return userInputTags.indexOf(tag);
            }
            else {
                return tag;
            }
        }
    }

    if (element.target.lastElementChild != null) {
        if (element.target.lastElementChild.id === "js-tag-input") {
            tag = element.target.lastElementChild.textContent;
            tag = tag.substring(1, tag.length -1); //remove quote
            if (userInputTags.indexOf(tag) != -1) {
                return userInputTags.indexOf(tag);
            }
            else {
                return tag;
            }
        }
    }

    if (element.target.tagName === "I") {
        tag = element.target.nextElementSibling.textContent;
        tag = tag.substring(1, tag.length -1);
        if (userInputTags.indexOf(tag) != -1) {
            return userInputTags.indexOf(tag);
        }
        else {
            return tag;
        }
    }
    if (element.target.tagName === "SPAN") {
        tag = element.target.textContent;
        tag = tag.substring(1, tag.length - 1);
        if (userInputTags.indexOf(tag) != -1) {
            return userInputTags.indexOf(tag);
        }
        else {
            return tag;
        }
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

function resetAnimation(element, animation) {
    element.style.animation = "none";
    void element.offsetWidth;
    element.style.animation = animation;
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

