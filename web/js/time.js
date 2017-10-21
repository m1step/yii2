function clock() {
    var d = new Date();
    var day = d.getDate();
    var hrs = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();

    var mnt=new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);

    if (day <= 9) day="0" + day;
    if (hrs <= 9) hrs="0" + hrs;
    if (min <=9 ) min="0" + min;
    if (sec <= 9) sec="0" + sec;

    $("#time").html(hrs + ":" + min + ":" + sec + "&nbsp;&nbsp;&nbsp;" +
        day + "/" + mnt[d.getMonth()] + "/" + d.getFullYear());
}
setInterval("clock()", 1000);