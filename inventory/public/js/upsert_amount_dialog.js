document.addEventListener('DOMContentLoaded', ()=>{
  document.querySelectorAll(".amount_upsert_btn").forEach(x => {
    x.addEventListener('click',e=>{
      const seasoningid = x.dataset.seasoningid;
      const marketid = x.dataset.marketid;
      const conversionseasoningid = Number(seasoningid);
      const convermarketid = Number(marketid);
      const seasoningnameid = "seasoning_name_" + seasoningid;
      const marketnameid = "market_name_" + seasoningid + "_" + marketid;
      const seasoningamountid = "market_amount_" + seasoningid + "_" + marketid;
      const seasoningname = document.getElementById(seasoningnameid);
      const marketname = document.getElementById(marketnameid);
      const seasoningamount = document.getElementById(seasoningamountid);
      const seasoningnametext = "" + seasoningname.textContent;
      const marketnametext = "" + marketname.textContent;
      const inputamountarea = document.getElementById("upsert_seasoning_amount");
      const inputamounttext = seasoningamount.textContent;
      const amountmarkethidden = document.getElementById("amount_market_name");
      const amountseasoninghidden = document.getElementById("amount_seasoning_name");
      const converinputamount = Number(inputamounttext.substring(1));
      document.getElementById("amount_seasoning_id").value = conversionseasoningid;
      amountseasoninghidden.value = seasoningnametext;
      document.getElementById("amount_seasoning_name_display").textContent = "" + amountseasoninghidden.value;
      document.getElementById("amount_market_id").value = convermarketid;
      amountmarkethidden.value = marketnametext;
      document.getElementById("amount_market_name_display").textContent = "" + amountmarkethidden.value;
      if (isNaN(converinputamount)) {
        document.getElementById("not_available").checked = true;
        inputamountarea.setAttribute("disabled", true);
        inputamountarea.style.backgroundColor = "#A6A6A6";
        document.getElementById("upsert_seasoning_amount").value = "";
      } else {
        document.getElementById("not_available").checked = false;
        inputamountarea.removeAttribute("disabled");
        inputamountarea.style.backgroundColor = "";
        document.getElementById("upsert_seasoning_amount").value = converinputamount;
      };
      document.querySelector(".upsert_amount_dialog").style.display = "block";
    });
  });
});
document.querySelector(".upsert_cancel_btn").addEventListener("click", () => {
  const errormessage = document.querySelectorAll(".error_message");
  const upsertedialog = document.querySelector(".upsert_amount_dialog_error");
  const upserteerror = document.querySelector(".upsert_amount_error");
  if (upsertedialog != null) {
    upsertedialog.classList.remove("upsert_amount_dialog_error");
    if (errormessage != null)
      errormessage.forEach(x => {
        x.remove("error_message"); 
    });
    if (upserteerror != null) {
      document.querySelector(".amount_label_error").classList.replace("amount_label_error", "amount_label");
      upserteerror.classList.replace("upsert_amount_error", "upsert_amount");
    };
  }
  document.querySelector(".upsert_amount_dialog").style.display = "none";
});
document.getElementById("not_available").addEventListener("change", () => {
  const inputamountarea = document.getElementById("upsert_seasoning_amount");
  if (inputamountarea.disabled === true) {
    inputamountarea.removeAttribute("disabled");
    inputamountarea.style.backgroundColor = "";
  } else {
    inputamountarea.setAttribute("disabled", true);
    inputamountarea.style.backgroundColor = "#A6A6A6";
  };
});
window.addEventListener('load', () => {
  const amountseasoningname = document.getElementById("amount_seasoning_name").value;
  const amountmarketname = document.getElementById("amount_market_name").value;
  if (amountmarketname != null) {
    document.getElementById("amount_market_name_display").textContent = "" + amountmarketname;
    document.getElementById("amount_seasoning_name_display").textContent = "" + amountseasoningname;
  };
});
function amountdigitcontrol(inputdigit, maxdigit) {  
  inputdigit.value = inputdigit.value.slice(0, maxdigit);  
};