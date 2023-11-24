function updateFinalPriceLabel(priceElement, discountElement, finalPriceElement){
    let price = $("#" + priceElement).val();
    let discount = $("#" + discountElement).val();

    // Calculate and display finalPrice
    let finalPrice = price * (1 - (discount / 100));
    finalPrice = Math.round(finalPrice * 100) / 100;
    $("#" + finalPriceElement).text("Final price: " + finalPrice + "$");

    // Display discount
    $("label[for='" + discountElement + "']").text("Discount: " + discount + "%");
}

// Display images functions
function productDisplayThumbnail(inputFileID, displayContainerID){
    let files = $("#" + inputFileID).prop("files");

    if (files.length <= 0) return;

    // Clear displayContainer
    $("#" + displayContainerID).children().remove();

    let thumbnail = files[0];

    let reader = new FileReader();

    // After reader reads -> arrow function will be executed
    reader.onload = (event) => {
        // create img element
        let imgElement = $("<img>");

        // set attributes
        imgElement.attr({
            "src": event.target.result,
            "class": "img-thumbnail mt-3 me-3",
            "style": "height: 200px; object-fit: cover;"
        });

        // append element to display container
        $("#" + displayContainerID).append(imgElement);
    }

    // reader will read
    reader.readAsDataURL(thumbnail);
}
function productDisplayImages(inputFileID, displayContainerID){
    let files = $("#" + inputFileID).prop("files");

    if (files.length <= 0) return;

    // Clear displayContainer
    $("#" + displayContainerID).children().remove();

    // Display all uploaded images
    for (i = 0; i < files.length; i++){
        let thumbnail = files[i];

        let reader = new FileReader();

        // After reader reads -> arrow function will be executed
        reader.onload = (event) => {
            // create img element
            let imgElement = $("<img>");

            // set attributes
            imgElement.attr({
                "src": event.target.result,
                "class": "img-thumbnail mt-3 me-3",
                "style": "height: 200px; object-fit: cover;"
            });

            // append element to display container
            $("#" + displayContainerID).append(imgElement);
        }

        // reader will read
        reader.readAsDataURL(thumbnail);

        }
    }

function toggleForm(formId){
    $("#" + formId + " :input:not([name='_token'])").prop("disabled", function(i, val){
        return !val;
    });
}

function markImageToDelete(imageId, hiddenInputId, button){
    $("#" + imageId).toggleClass("black-and-white-image");
    $(button).toggleClass("btn-danger btn-primary");
    $(button).children().toggleClass("bi-trash-fill bi-arrow-counterclockwise");
    if($("#" + imageId).hasClass("black-and-white-image")){
        // If it has class add to array
        let j = JSON.parse($("#" + hiddenInputId).val());
        // Push to array
        j.images.push(imageId);
        // Update input element
        $("#" + hiddenInputId).val(JSON.stringify(j));
    }else{
        // If no class remove from array
        let j = JSON.parse($("#" + hiddenInputId).val());
        // Remove from array
        j.images = j.images.filter(image => image != imageId);
        // Update input element
        $("#" + hiddenInputId).val(JSON.stringify(j));
    }
}
