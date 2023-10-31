document.addEventListener('DOMContentLoaded', ()=>{
  document.querySelectorAll('.market_update_btn').forEach(x => {
    x.addEventListener('click',e=>{
      const id = x.dataset.marketid;
      const convermarketid = Number(id);
      const marketname = document.getElementById("market_name_" + id).textContent;
      document.getElementById("update_market_id").value = convermarketid;
      document.getElementById("update_market_name").value = marketname;
      document.querySelector(".update_dialog").style.display = "block";
    });
  });
});
document.querySelector(".update_cancel_btn").addEventListener("click", () => {
  const errormessage = document.querySelectorAll(".error_message");
  const updatedialog = document.querySelector(".update_dialog_error");
  const updatenameerror = document.querySelector(".update_market_name_error");

  if (updatedialog != null) {
    updatedialog.classList.remove("update_dialog_error");
    if (errormessage != null)
      errormessage.forEach(x => {
        x.remove("error_message"); 
    });
    if (updatenameerror != null) {
      document.querySelector(".update_market_name_label_error").classList.replace("update_market_name_label_error", "update_market_name_label");
      updatenameerror.classList.replace("update_market_name_error", "update_market_name");
    }
  }
  document.querySelector(".update_dialog").style.display = "none";
});