function displaydate() {
  var today_date = new Date();
  var myyear = today_date.getYear()-100+2000;
  var mymonth = today_date.getMonth()+1;
  var mytoday = today_date.getDate();
  alert(myyear+"/"+mymonth+"/"+mytoday);
}
