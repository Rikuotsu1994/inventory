document.querySelector(".update_seasoning_image").addEventListener("click", () => {
  document.querySelector("input.update_seasoning_image").click();
});
document.getElementById("update_seasoning_image").addEventListener("change", function(event) {
  const file = event.target.files[0];
  const reader = new FileReader();
  const updateimage = document.getElementById("update_image");
  const updateimgpreview = document.getElementById("update_img_preview");
  if(updateimage != null) {
    updateimgpreview.removeChild(updateimage);
  }
  reader.onload = function(event) {
    const img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "update_image");
    img.setAttribute("class", "update_image");
    updateimgpreview.appendChild(img);
    document.getElementById("image_delete_btn").style.display = "none";
    document.getElementById("image_delete_flag").value = "0";
  };
  reader.readAsDataURL(file);
});
document.addEventListener('DOMContentLoaded', ()=>{
  document.querySelectorAll('.seasoning_update_btn').forEach(x => {
    x.addEventListener('click',e=>{
      const id = x.dataset.seasoningid;
      const conversionseasoningid = Number(id);
      const seasoningname = document.getElementById("seasoning_name_" + id).textContent;
      const seasoningpictureid = document.getElementById("seasoning_picture_" + id);
      const seasoninginventory = document.getElementById("number_of_seasoning_" + id).textContent;
      const seasoningremarks = document.getElementById("seasoning_remarks_" + id).textContent;
      const seasoningremarkssubstr = seasoningremarks.substring(3);
      document.getElementById("update_seasoning_id").value = conversionseasoningid;
      document.getElementById("update_seasoning_name").value = seasoningname;
      document.getElementById("update_seasoning_inventory").value = seasoninginventory;
      document.getElementById("update_seasoning_remarks").value = seasoningremarkssubstr;
      if (seasoningpictureid != null) {
        seasoningsrc = seasoningpictureid.getAttribute("src");
        const img = document.createElement("img");
        img.setAttribute("src", seasoningsrc);
        img.setAttribute("id", "update_image");
        img.setAttribute("class", "update_image");
        document.getElementById("update_img_preview").appendChild(img);
        document.getElementById("image_delete_btn").style.display = "block";
        const substrsrc = Number(seasoningsrc.indexOf("storage/u")) + 8;
        const seasoningpic = seasoningsrc.substring(substrsrc);
        document.getElementById("update_seasoning_picture_id").setAttribute("value", seasoningpic);
      }
      document.querySelector(".update_dialog").style.display = "block";
    });
  });
});
document.getElementById("image_delete_btn").addEventListener("click", () => {
  const updateimage = document.getElementById("update_image");
  const updateimgpreview = document.getElementById("update_img_preview");
  updateimgpreview.removeChild(updateimage);
  document.getElementById("image_delete_flag").value = "1";
  document.getElementById("image_delete_btn").style.display = "none";
});
document.querySelector(".update_cancel_btn").addEventListener("click", () => {
  const errormessage = document.querySelectorAll(".error_message");
  const imagefile = document.getElementById("update_seasoning_image");
  const updatedialog = document.querySelector(".update_dialog_error");
  const updateimage = document.getElementById("update_image");
  const updateimgpreview = document.getElementById("update_img_preview");
  const updatenameerror = document.querySelector(".update_seasoning_name_error");
  const updateinventoryerror = document.querySelector(".update_seasoning_inventory_error");
  const updateremarkserror = document.querySelector(".update_seasoning_remarks_error");

  if(imagefile !== null) {
    imagefile.value = "";
  }
  if (updateimage != null) {
    updateimgpreview.removeChild(updateimage);
    document.getElementById("image_delete_btn").style.display = "none";
    document.getElementById("image_delete_flag").value = "0";
  }

  if (updatedialog != null) {
    updatedialog.classList.remove("update_dialog_error");
    if (errormessage != null)
      errormessage.forEach(x => {
        x.remove("error_message"); 
    });
    if (updatenameerror != null) {
      document.querySelector(".update_seasoning_name_label_error").classList.replace("update_seasoning_name_label_error", "update_seasoning_name_label");
      updatenameerror.classList.replace("update_seasoning_name_error", "update_seasoning_name");
    }
    if (updateinventoryerror != null) {
      document.querySelector(".update_seasoning_inventory_label_error").classList.replace("update_seasoning_inventory_label_error", "update_seasoning_inventory_label");
      updateinventoryerror.classList.replace("update_seasoning_inventory_error", "update_seasoning_inventory");
    }
    if (updateremarkserror != null) {
      document.querySelector(".update_remarks_label_error").classList.replace("update_remarks_label_error", "update_remarks_label");
      updateremarkserror.classList.replace("update_seasoning_remarks_error", "update_seasoning_remarks");
    }
  }
  document.getElementById("update_seasoning_picture_id").value ="";
  document.querySelector(".update_dialog").style.display = "none";
});