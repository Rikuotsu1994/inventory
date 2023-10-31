document.getElementById("create_btn").addEventListener("click", () => {
  document.querySelector(".create_dialog").style.display = "block";
});
document.querySelector(".create_cancel_btn").addEventListener("click", () => {
  const errormessage = document.querySelectorAll(".error_message");
  const createdialog = document.querySelector(".create_dialog_error");
  const createnameerror = document.querySelector(".create_market_name_error");

  if (createdialog != null) {
    createdialog.classList.remove("create_dialog_error");
    if (errormessage != null)
      errormessage.forEach(x => {
        x.remove("error_message"); 
    });
    if (createnameerror != null) {
      document.querySelector(".create_market_name_label_error").classList.replace("create_market_name_label_error", "create_market_name_label");
      createnameerror.classList.replace("create_market_name_error", "create_market_name");
    }
  };
  document.getElementById("create_market_name").value = "";
  document.querySelector(".create_dialog").style.display = "none";
});