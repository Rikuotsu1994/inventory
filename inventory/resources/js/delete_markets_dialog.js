document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.market_delete_btn').forEach(x => {
    x.addEventListener('click',e=>{
      const id = x.dataset.marketid;
      const convermarketid = Number(id);
      const marketname = "「" + document.getElementById("market_name_" + id).textContent + "」";
      document.getElementById("delete_market_id").value = convermarketid;
      document.getElementById("delete_market_name").textContent = marketname;
      document.querySelector(".delete_dialog").style.display = "block";
    });
  });
});
document.querySelector(".delete_cancel_btn").addEventListener("click", () => {
  document.querySelector(".delete_dialog").style.display = "none";
});