document.querySelector(".create_seasoning_image").addEventListener("click", () => {
  document.querySelector("input.create_seasoning_image").click();
  });
document.getElementById("create_seasoning_image").addEventListener("change", function(event) {
  const file = event.target.files[0];
  const reader = new FileReader();
  const createimage = document.getElementById("create_img");
  const createimgpreview = document.getElementById("create_img_preview");
  if(createimage != null) {
    createimgpreview.removeChild(createimage);
  }
  reader.onload = function(event) {
    const img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "create_img");
    img.setAttribute("class", "create_img");
    createimgpreview.appendChild(img);
  };
  reader.readAsDataURL(file);
});
document.getElementById("create_btn").addEventListener("click", () => {
  document.querySelector(".create_dialog").style.display = "block";
});
document.querySelector(".create_cancel_btn").addEventListener("click", () => {
  const errormessage = document.querySelectorAll(".error_message");
  const imagefile = document.getElementById("create_seasoning_image");
  const createdialog = document.querySelector(".create_dialog_error");
  const createimage = document.getElementById("create_img");
  const createimgpreview = document.getElementById("create_img_preview");
  const createnameerror = document.querySelector(".create_seasoning_name_error");
  const createinventoryerror = document.querySelector(".create_seasoning_inventory_error");
  const createremarkserror = document.querySelector(".create_seasoning_remarks_error");

  if(imagefile !== null) {
    imagefile.value = "";
  }
  if (createimage != null) {
    createimgpreview.removeChild(createimage);
  }

  if (createdialog != null) {
    createdialog.classList.remove("create_dialog_error");
    if (errormessage != null)
      errormessage.forEach(x => {
        x.remove("error_message"); 
    });
    if (createnameerror != null) {
      document.querySelector(".create_seasoning_name_label_error").classList.replace("create_seasoning_name_label_error", "create_seasoning_name_label");
      createnameerror.classList.replace("create_seasoning_name_error", "create_seasoning_name");
    }
    if (createinventoryerror != null) {
      document.querySelector(".create_seasoning_inventory_label_error").classList.replace("create_seasoning_inventory_label_error", "create_seasoning_inventory_label");
      createinventoryerror.classList.replace("create_seasoning_inventory_error", "create_seasoning_inventory");
    }
    if (createremarkserror != null) {
      document.querySelector(".create_remarks_label_error").classList.replace("create_remarks_label_error", "create_remarks_label");
      createremarkserror.classList.replace("create_seasoning_remarks_error", "create_seasoning_remarks");
    }
  }
  document.querySelector(".create_dialog").style.display = "none";
});
function digitcontrol(inputdigit, maxdigit) {  
  inputdigit.value = inputdigit.value.slice(0, maxdigit);  
}