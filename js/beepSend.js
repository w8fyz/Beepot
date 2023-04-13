const MAX_IMAGES = 4;
const addImageButton = document.querySelector("#addImageButton");
const beepImages = document.querySelector("#beepImages");
const beepImagesPreview = document.querySelector("#beepImagesPreview");
addImageButton.addEventListener("click", () => {
    if (beepImagesPreview.children.length >= MAX_IMAGES) {
        return;
    }
    beepImages.click();
});

beepImages.addEventListener("change", () => {
    Array.from(beepImages.files).forEach((image, index) => {
       if(index <= MAX_IMAGES) {

    if(image.size > 41943040) {
        displayWarning("Le fichier ne doit pas faire plus de 5MB");
        return;
    }
    const imageExt = image.name.slice((image.name.lastIndexOf(".") - 1 >>> 0) + 2);
    if(["jpeg","jpg","png", "gif", "ico", "webp"].indexOf(imageExt) == -1) {
        displayWarning("L'extension doit être parmis les suivantes : jpeg, ico, webp, jpg, png, gif.");
        return;
    }
    if (!image) {
        return;
    }
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        if(beepImagesPreview.querySelectorAll(".position-relative").length < MAX_IMAGES) {
        const img = document.createElement("img");
        img.classList.add("position-absolute");
        img.classList.add("top-0");
        img.classList.add("start-0");
        img.style.maxWidth = "100%";
        img.style.maxHeight = "100%";
        img.src = reader.result;
        const closeButton = document.createElement("button");
        closeButton.classList.add("btn");
        closeButton.classList.add("btn-danger");
        closeButton.classList.add("btn-sm");
        closeButton.classList.add("position-absolute");
        closeButton.classList.add("top-0");
        closeButton.classList.add("end-0");
        closeButton.style.padding = "0.25rem";
        closeButton.style.margin = "0.25rem";
        closeButton.innerHTML = "&times;";
        closeButton.addEventListener("click", () => {
            beepImagesPreview.removeChild(wrapper);
            updateImageCount();
        });
        const wrapper = document.createElement("div");
        wrapper.classList.add("position-relative");
        wrapper.style.width = "100px";
        wrapper.style.height = "100px";
        wrapper.style.position = "relative";
        wrapper.appendChild(img);
        wrapper.appendChild(closeButton);
        beepImagesPreview.appendChild(wrapper);
        updateImageCount();
        }
    });
    reader.readAsDataURL(image);
    updateImageCount();
       }
    })
});

function updateImageCount() {
    const imageCount = beepImagesPreview.querySelectorAll(".position-relative").length;
    console.log(imageCount);
    if (imageCount >= MAX_IMAGES) {
        addImageButton.style.display = "none";
    } else {
        addImageButton.style.display = "inline-block";
    }
}

const beepContent = document.querySelector("#beepContent");
const charCount = document.querySelector("#charCount");
beepContent.addEventListener("input", () => {
    charCount.textContent = beepContent.value.length;
});


const sendBeepButton = document.querySelector("#sendBeepButton");
const newBeepForm = document.querySelector("#newBeepForm");

const beepModalWarning = document.querySelector("#beepSendWarning");
function displayWarning(responseElement) {
    if(responseElement != "") {
        beepModalWarning.style.display = "block";
        beepModalWarning.textContent = responseElement;
    } else {
        beepModalWarning.style.display = "none";
    }
}

sendBeepButton.addEventListener("click", () => {
    const formData = new FormData(newBeepForm);
    formData.delete("beepImages");
    const images = Array.from(beepImages.files).slice(0, MAX_IMAGES);
    images.forEach((image, index) => {
        formData.append(`beepImage${index}`, image);
    });
    console.log(formData);
    fetch("manager/createPost.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if(data == "") {
                displayWarning("");
                while(beepImages.lastElementChild) {
                    beepImages.removeChild(beepImages.lastElementChild);
                }
                beepContent.textContent = "";
                document.getElementById('newBeepClose').click();
            } else {
                displayWarning(data);
            }

        })
        .catch((error) => {
            console.error(error);
        });
});
