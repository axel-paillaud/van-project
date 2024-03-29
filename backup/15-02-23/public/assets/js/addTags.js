let url = "/api/tags";
var tags;
let submitBtn = document.getElementById("submit-btn");
let postForm = document.getElementById("post-form");
let errorMsg = document.getElementById("js-error-msg");
let imageInput = document.getElementById("image");
let image = false;

//keep track of tags added by user
var userInputTags = [];
var countUserInputTags = 0;

const checkValidForm = function(e) {
    e.preventDefault();

    let title = postForm["title"];
    let content = postForm["content"];
    let userTags = postForm["tag[]"];
    console.log(userTags);
    let tagsContainer = document.querySelector(".post-tags-container");

    if (title.value === "") {
        displayErrorMsg(errorMsg, "Erreur : Un titre est obligatoire");
        setOutlineRed(title);
        return;
    }
    else if (content.value === "") {
        displayErrorMsg(errorMsg, "Erreur : Un contenu est obligatoire pour décrire votre question");
        setOutlineRed(content);
        return;
    }
    else if (countUserInputTags === 0) {
        displayErrorMsg(errorMsg, "Erreur : Vous devez spécifier au moins un mot-clef associé à votre question");
        setOutlineRed(tagsContainer);
        return;
    }
    else if (userTags.length > 5) {
        displayErrorMsg(errorMsg, "Erreur : Seul un maximum de 5 mots-clefs est autorisé");
        return;
    }

    if (countUserInputTags > 1) {
        userTags.forEach(tag => {
            console.log(tag.value.length);
            if (tag.value.length > 26) {
                displayErrorMsg(errorMsg, "Erreur : Un mot-clef peut contenir un maximum de 26 caractères");
                return;
            }
        });
    }

    postForm.submit();
}

function displayErrorMsg(errorMsg, content) {
    errorMsg.classList.add("message-container", "error");
    errorMsg.textContent = content;
    setTimeout(() => {
        errorMsg.classList.remove("message-container", "error");
        errorMsg.textContent = "";
    }, 5000);
}

function setOutlineRed(element) {
    element.style.outlineColor = "#d35452";
    element.style.outlineWidth = "3px";
    element.style.outlineStyle = "solid";
}

submitBtn.addEventListener('click',checkValidForm);

let modalContener = `<ul id='js-list-tag'>
                    </ul>`

//init tags = prepare for write tags, remove text information and set the focus on input tags
const initTags = function(e) {
    document.querySelector(".post-tags-container").firstElementChild.innerText = "";
    let inputTag = document.querySelector(".input-tag-container input");
    inputTag.focus();
    inputTag.addEventListener('input', addTags);
    inputTag.addEventListener('focus', addTags);
    inputTag.addEventListener('keydown', addInputTag);
    inputTag.addEventListener('click', stopPropagation);
    document.querySelector(".post-tags-container").removeEventListener('click', initTags);
    inputTag.removeEventListener('focus', initTags);
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
    newInput.maxLength = 26;
    newInput.autocomplete = "off";
    newInput.name = "tag[]";
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
    newInput.addEventListener('keydown', addInputTag);
    newInput.addEventListener('click', stopPropagation);
    newInput.focus();
}

const addInputTag = function (e) {
    if (e.type === 'click' || e.key === "Enter" || e.key === ",") {
        e.preventDefault();
        let tag = checkInputTag(e, userInputTags);
        let allInput = document.querySelectorAll(".input-tag-container input");
        let lastInput = allInput[allInput.length - 1];
    
        if (tag === false) return;

        if (!Number.isInteger(tag)) {
            document.getElementById("js-modal-tag").remove();
    
            let icon = document.createElement("i");
            icon.classList.add("fa-solid", "fa-xmark", "xmark-tag-icon");
            icon.addEventListener('click', deleteTag);
    
            lastInput.parentElement.appendChild(icon);
    
            lastInput.setAttribute('value', tag);
            lastInput.value = tag;
            lastInput.readOnly = true;
            lastInput.parentElement.classList.add("tag-lock");
            lastInput.style.color = "white";
            lastInput.style.textAlign = "center";
            lastInput.blur();
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
            resetAnimation(inputAlreadyHere, "pulseTags 0.5s");
        }
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
    if (document.getElementById("js-tag-input") === null) {
        return false;
    }
    else {
        tag = document.getElementById("js-tag-input").textContent;
        tag = tag.substring(1, tag.length -1);
        if (userInputTags.indexOf(tag) != -1) {
            return userInputTags.indexOf(tag);
        }
        else {
            return tag;
        }
    }
}

const stopPropagation = function (e) {
    e.stopPropagation();
}

const closeModal = function(e) {
    let modal = document.getElementById("js-modal-tag");
    if (modal === null || modal.style.display === "none") return;

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

//add images
function checkInputImg(imageInput) {
    let files = imageInput.files;

    if (files.length > 3) {
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
        displayErrorMsg(errorMsg, "Erreur avec le( fichier téléversé, il doit être de type png/jpeg/gif et ne pas dépasser 2mo");
    }
    else {
        let imgContainer = document.querySelector("#add-img label");
        updateThumbnails(imgContainer, imageInput);
    }
}

imageInput.addEventListener('change', addImage);

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
    let input = document.querySelector(".input-tag-container input");
    modalTags.addEventListener('click', initTags);
    input.addEventListener('focus', initTags);
})

