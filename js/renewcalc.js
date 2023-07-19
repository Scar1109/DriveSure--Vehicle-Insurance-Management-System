function calculateTotalAmount() {
  var coverage = document.getElementsByName("coverage")[0].value;
  var timePeriod = document.getElementsByName("months")[0].value;
  var total = 0;

  if (coverage == 'Third Party') {
    if (timePeriod == '6_MONTHS') {
      total = 5000000 * 1.0 / 100;
    } else if (timePeriod == '12_MONTHS') {
      total = 5000000 * 1.5 / 100;
    }
  } else if (coverage == 'Make_Your_Own') {
    if (timePeriod == '6_MONTHS') {
      total = 5000000 * 1.5 / 100;
    } else if (timePeriod == '12_MONTHS') {
      total = 5000000 * 2.0 / 100;
    }
  } else if (coverage == 'Full Option') {
    if (timePeriod == '6_MONTHS') {
      total = 5000000 * 2.0 / 100;
    } else if (timePeriod == '12_MONTHS') {
      total = 5000000 * 3.0 / 100;
    }
  }
  document.getElementById('myInput').value = total;
  document.getElementById("totalAmountDisplay").innerHTML = "Rs. "+total+".00";
}
