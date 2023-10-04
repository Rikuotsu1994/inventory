document.addEventListener('DOMContentLoaded', ()=>{
  document.querySelectorAll('.seasoning_delete_btn').forEach(x=>{
    x.addEventListener('click',e=>{
      const id = x.dataset.seasoningid;
      const conversionseasoningid = Number(id);
      const seasoningnameid = "seasoning_name_" + id;
      const element = document.getElementById(seasoningnameid);
      const seasoningname = "「" + element.textContent + "」";
      document.getElementById("delete_seasoning_id").value = conversionseasoningid;
      document.getElementById("delete_seasoning_name").textContent = seasoningname;
      document.querySelector(".delete_dialog").style.display = "block";
    });
  });
});
document.querySelector(".delete_cancel_btn").addEventListener("click", () => {
  document.querySelector(".delete_dialog").style.display = "none";
});