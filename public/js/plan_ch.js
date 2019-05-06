const rooms = [
    {id: 1, list_row: "r_1", plan_rect: "ch_1"},
    {id: 2, list_row: "r_2", plan_rect: "ch_2"},
    {id: 3, list_row: "r_3", plan_rect: "balcon_3"},
    {id: 4, list_row: "r_4", plan_rect: "ch_4"},
    {id: 5, list_row: "r_5", plan_rect: "ch_5"},
    {id: 6, list_row: "r_6", plan_rect: "ch_6"},
    {id: 7, list_row: "r_7", plan_rect: "ch_7"},
    {id: 8, list_row: "r_8", plan_rect: "ch_8"},
    {id: 9, list_row: "r_9", plan_rect: "sejour"},
    {id: 10, list_row: "r_10", plan_rect: "ch_10"},
    {id: 11, list_row: "r_11", plan_rect: "ch_11"},
    {id: 12, list_row: "r_12", plan_rect: "ch_12"},
    {id: 13, list_row: "r_13", plan_rect: "ch_13"},
    {id: 14, list_row: "r_14", plan_rect: "terasse"},
    {id: 15, list_row: "r_15", plan_rect: "soins_1"},
    {id: 16, list_row: "r_16", plan_rect: "ch_16"},
    {id: 17, list_row: "r_17", plan_rect: "ch_17"},
    {id: 18, list_row: "r_18", plan_rect: "ch_18"},
    {id: 19, list_row: "r_19", plan_rect: "ch_19"},
    {id: 20, list_row: "r_20", plan_rect: "ch_20"},
    {id: 21, list_row: "r_21", plan_rect: "ch_21"},
    {id: 22, list_row: "r_22", plan_rect: "ch_22"},
    {id: 23, list_row: "r_23", plan_rect: "ch_23"},
    {id: 24, list_row: "r_24", plan_rect: "ch_24"},
    {id: 25, list_row: "r_25", plan_rect: "ch_25"},
    {id: 26, list_row: "r_26", plan_rect: "balcon_2"},
    {id: 27, list_row: "r_27", plan_rect: "balcon"},
    {id: 28, list_row: "r_28", plan_rect: "ch_28"},
    {id: 29, list_row: "r_29", plan_rect: "ch_29"},
    {id: 30, list_row: "r_30", plan_rect: "couloir_1"},
    {id: 31, list_row: "r_31", plan_rect: "couloir_2"},
    {id: 32, list_row: "r_32", plan_rect: "couloir_3"},
];


function resetStyle() {
    let x = document.querySelectorAll(".chambre_selected");
    let k;
    for (k = 0; k < x.length; k++) {
        let ch = $("#" + x[k].id);
        ch.removeClass("chambre_selected");
        ch.addClass("chambre");
    }

    let y = document.querySelectorAll(".chambre_selected");
    let k;
    for (k = 0; k < x.length; k++) {
        let ch = $("#" + x[k].id);
        ch.removeClass("chambre_selected");
        ch.addClass("chambre");
    }

}

function chClicked(event) {
    let ch = event.target;
    resetStyle();
    ch = $("#" + ch.id);
    ch.removeClass("chambre");
    ch.addClass("chambre_selected");

    console.log(event.target)

}

function chListHover(id) {
    let room = rooms[id - 1];
    $("#"+room.list_row).addClass("tr_selected")
}
