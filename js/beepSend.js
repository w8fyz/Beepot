const MAX_IMAGES = 4;

// add event listener to the "Add Image" button
const addImageButton = document.querySelector("#addImageButton");
const beepImages = document.querySelector("#beepImages");
const beepImagesPreview = document.querySelector("#beepImagesPreview");
addImageButton.addEventListener("click", () => {
    if (beepImagesPreview.children.length >= MAX_IMAGES) {
        return;
    }
    beepImages.click();
});

// add event listener to the file input for image preview
beepImages.addEventListener("change", () => {
    const image = beepImages.files[0];
    if (!image) {
        return;
    }
    const reader = new FileReader();
    reader.addEventListener("load", () => {
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
    });
    reader.readAsDataURL(image);
    updateImageCount();
});

// update the image count and hide the "Add Image" button if necessary
function updateImageCount() {
    const imageCount = beepImagesPreview.children.length;
    if (imageCount >= MAX_IMAGES) {
        addImageButton.style.display = "none";
    } else {
        addImageButton.style.display = "inline-block";
    }
}

// add event listener to the text area for character count
const beepContent = document.querySelector("#beepContent");
const charCount = document.querySelector("#charCount");
beepContent.addEventListener("input", () => {
    charCount.textContent = beepContent.value.length;
});

// add event listener to the "Envoyer" button for form submission
const sendBeepButton = document.querySelector("#sendBeepButton");
const newBeepForm = document.querySelector("#newBeepForm");
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
            console.log(data);
        })
        .catch((error) => {
            console.error(error);
        });
});
