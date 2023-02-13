let url = "/api/tags";
var tags;
let modalTags = false;

let modalContener = `<ul id='js-list-tag'>
                    </ul>`

let modalContent = `
                    <li><i class="fa-solid fa-tag margin-right-8"></i>Créer un tag "<span id='js-tag-input'></span>"</li>
                    <hr>`

//init tags = prepare for write tags, remove text information and set the focus on input tags
const initTags = function(e) {
    this.firstElementChild.innerText = "";
    let inputTag = document.querySelector(".input-tag-container input");
    inputTag.focus();
    inputTag.addEventListener('input', addTags);
    this.removeEventListener('click', initTags);
}

const addTags = function(e) {
    let modal = this.nextElementSibling;
    if (this.value != "" && this.value != " ") { //check if the user input tag is not an empty string, or a space
        if (modalTags === false) {
            modal.innerHTML = modalContener; //modalContener have to be add only once, modalContent need to be refresh on every change
            modalTags = true;

            let listTags = document.getElementById("js-list-tag");
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
        }
        let listTags = document.getElementById("js-list-tag");
        let tagStartWith = checkTags(tags, this.value);
        tagStartWith.forEach(tag => {
            let li = document.createElement("li");
            listTags.appendChild(li).innerText = tag;
        });
        let tagInput = document.getElementById("js-tag-input");
        tagInput.innerText = '"' + this.value + '"';
    }
    else {
        document.getElementById("js-list-tag").removeEventListener('click', getInputTag);
        modal.innerHTML = "";
        modalTags = false;
    }
}

const getInputTag = function (e) {
    let value = checkInputTag(e);
    console.log(value);
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
    let modalTags = document.getElementById("js-modal-tags");
    modalTags.addEventListener('click', initTags);
})

