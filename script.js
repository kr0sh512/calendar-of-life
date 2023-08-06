document.body.getElementsByTagName("main")[0].innerHTML = "";

var date_of_birth = new Date("2006-06-16");
var count_of_weeks = (new Date() - date_of_birth) / 1000 / 60 / 60 / 24 / 7
count_of_weeks = (new Date("2023-06-16") - new Date("2006-06-16")) / 1000 / 60 / 60 / 24 / 7;

document.getElementsByTagName("header")[0].getElementsByTagName("p")[0].innerText = count_of_weeks.toString();


let today_is_checked = false;
for (let i = 0; i < 73; ++i) {
    var number = document.createElement("div");
    number.classList.add("cell", "number");
    number.innerHTML = ((i + 1) < 10) ? "" : ""; // &nbsp; ?
    number.innerHTML += (i + 1).toString() + ".";
    var row = document.createElement("div");
    row.className = "row";
    row.appendChild(number);

    let year = 365 * 24 * 60 * 60 * 1000;
    // count_of_weeks = (new Date() - date_of_birth - year * i) / 1000 / 60 / 60 / 24 / 7;

    for (let j = 0; j < 365 / 7; ++j) { // 52 квадратика
        var cell = document.createElement("div");
        cell.className = "cell";
        if (j < count_of_weeks) {
            cell.classList.add("active");
        }
        row.appendChild(cell);
    }
    document.body.getElementsByTagName("main")[0].appendChild(row);

    date_of_birth.setFullYear(date_of_birth.getFullYear() + 1);
    count_of_weeks = (count_of_weeks == -1) ? -1 : (new Date() - date_of_birth) / 1000 / 60 / 60 / 24 / 7;
}
{
    let list_active = document.getElementsByClassName("active");
    let last_active = list_active[list_active.length - 1];
    last_active.classList.remove("active");
    last_active.id = "today";
}