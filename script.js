function CreateCalendar() {
    let date_of_birth = new Date("2006-06-16");

    if (db_birthday !== '' && db_birthday !== 'NULL') {
        date_of_birth = new Date(db_birthday);
        alertDate.setAttribute("hidden", "");
    }

    let count_of_weeks = (new Date() - date_of_birth) / 1000 / 60 / 60 / 24 / 7

    let calendar = document.createElement("div");
    calendar.id = "calendar";

    for (let i = 0; i < 73; ++i) {
        for (let j = 0; j < 365 / 7; ++j) { // 52 квадратика
            let cell = document.createElement("div");
            cell.className = "cell";
            if (j < count_of_weeks) {
                cell.classList.add("active");
            }
            if (j == 0) {
                cell.classList.add("date");
                cell.innerHTML = "<div>" + i.toString() + "</div>";
            }
            calendar.appendChild(cell);
        }
        date_of_birth.setFullYear(date_of_birth.getFullYear() + 1);
        count_of_weeks = (count_of_weeks == -1) ? -1 : (new Date() - date_of_birth) / 1000 / 60 / 60 / 24 / 7;
    }
    document.body.getElementsByTagName("main")[0].appendChild(calendar);
    let list_active = document.getElementsByClassName("active");
    let last_active = list_active[list_active.length - 1];
    last_active.classList.remove("active");
    last_active.id = "today";
}

CreateCalendar();