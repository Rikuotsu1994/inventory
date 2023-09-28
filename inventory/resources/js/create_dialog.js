document.querySelector(".create_seasoning_image").addEventListener("click", () => {
  document.querySelector("input.create_seasoning_image").click();
  });

function imagePreview(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  var preview = document.getElementById("img_preview");
  var previewImage = document.getElementById("previewImage");

  if(previewImage != null) {
    preview.removeChild(previewImage);
  }

  reader.onload = function(event) {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    img.setAttribute("class", "previewImage");
    preview.appendChild(img);
  };
  reader.readAsDataURL(file);
};

document.getElementById("create_btn").addEventListener("click", () => {
  document.querySelector(".create_dialog").style.display = "block";
});
document.querySelector(".create_cancel_btn").addEventListener("click", () => {
  document.querySelector(".create_dialog").style.display = "none";
});
function digitcontrol(inputdigit, maxdigit) {  
  inputdigit.value = inputdigit.value.slice(0, maxdigit);  
}