var rooms = [

];

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    // noinspection EqualityComparisonWithCoercionJS
    if (this.readyState == 4 && this.status == 200) {
        rooms = JSON.parse(this.responseText);
    }
};

xmlhttp.open("GET", "./rooms.json", true);
xmlhttp.send();

function resetStyle() {
    let x = document.querySelectorAll(".chambre_selected");
    let k;
    for (k = 0; k < x.length; k++) {
        let ch = $("#" + x[k].id);
        ch.removeClass("chambre_selected");
        ch.addClass("chambre");
    }

    let y = document.querySelectorAll(".tr_selected");
    let j;
    for (j = 0; j < y.length; j++) {
        let chr = $("#" + y[j].id);
        chr.removeClass("tr_selected");
    }
}

function chClicked(id) {
    resetStyle();

    let ch = rooms[id - 1];
    ch = $("#" + ch.plan_rect);
    ch.removeClass("chambre");
    ch.addClass("chambre_selected");

    let room = rooms[id - 1];
    $("#"+room.list_row).addClass("tr_selected");
    console.log(event.target)
}

function chListHover(id) {
    resetStyle();


    let room = rooms[id - 1];


    $("#"+room.list_row).addClass("tr_selected");
    // console.log(id-1 + " : "+"#"+room.list_row);

    let ch = rooms[id - 1];
    ch = $("#" + ch.plan_rect);
    ch.removeClass("chambre");
    ch.addClass("chambre_selected");

    // $('.rooms-list').scrollTop($('#tr_'+id).position().top);
    // console.log('tr: '+$('#tr_'+id).position().top);
    // console.log('sc: '+$('.rooms-list').scrollTop());
}
function infoCh(id) {
    let room = rooms[id - 1];
    $("#room-edit").fireModal()
console.log(id)
}
