document.addEventListener('DOMContentLoaded', ()=>{
  document.querySelectorAll('.seasoning_delete_btn').forEach(x=>{
    x.addEventListener('click',e=>{
      const id = x.dataset.seasoningid;
      const conversionseasoningid = Number(id);
      const seasoningnameid = "seasoning_name_" + id;
      const element = document.getElementById(seasoningnameid);
      const seasoningname = "「" + element.textContent + "」";
      const seasoningpictureid = "seasoning_picture_" + id;
      const seasoningdeletepictureid = document.getElementById(seasoningpictureid);
      document.getElementById("delete_seasoning_id").value = conversionseasoningid;
      document.getElementById("delete_seasoning_name").textContent = seasoningname;
      if (seasoningdeletepictureid != null) {
        const seasoningsrc = seasoningdeletepictureid.getAttribute("src");
        const substrsrc = Number(seasoningsrc.indexOf("storage/u")) + 8;
        const seasoningpic = seasoningsrc.substring(substrsrc);
        document.getElementById("delete_seasoning_picture_id").setAttribute("value", seasoningpic);
      }
      document.querySelector(".delete_dialog").style.display = "block";
    });
  });
});
document.querySelector(".delete_cancel_btn").addEventListener("click", () => {
  document.querySelector(".delete_dialog").style.display = "none";
  document.getElementById("delete_seasoning_picture_id").value ="";
});