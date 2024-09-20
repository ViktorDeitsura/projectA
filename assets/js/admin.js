let tarifArray = [];
let idAlertCount = 0;
const showAlert = function( _text, _alertType, _callback = null ) {
    const alertID = "admAlert"+idAlertCount;
    $(".allert-cont").append(`<div class="alert ${_alertType} admin-alert" role="alert" id="${alertID}">${_text}</div>`);
    setTimeout(function () {
        $("#"+alertID).fadeTo( "slow", 0, function() {
            $(this).remove();
            if ( _callback != null ) {
                _callback();
            }
        });
    }, 2000);
    idAlertCount++;
};
const addProduct = function(event) {
    event.preventDefault();
    if ( $("#productName").val() == "" || $("#productPrice").val() == "" ) {
        showAlert("Чтобы добавить товар все поля должны быть заполнены","alert-danger");
        return;
    }
    let formData = new FormData();
    formData.append("name", $("#productName").val());
    formData.append("price", $("#productPrice").val());
    formData.append("tariff", tarifArray);

    $.ajax({
        url: 'App/Application/AdminService.php',
        type: 'POST',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function(data) {
            showAlert("Товар успешно добавлен","alert-success", function(){document.location.reload();});
        },
        error: function() {
            showAlert("При добавлении товара произошла ошибка","alert-danger");
        }
    });

    return false;
};
const showTarif = function() {
    $(".tarif-list").removeClass("d-none");
    $("#tarifList").empty();
    tarifArray.forEach((val, index) => {
        $("#tarifList").append(`<b>День:</b> ${index} <b>Цена:</b> ${val}<br/>`);
    });
};
$("#tarifAdd").on("click", function() {
    $("#tarifDayCount").val();
    $("#tarifPrice").val();
    if ( $("#tarifDayCount").val() == "" || $("#tarifPrice").val() == "" ) {
        showAlert("Чтобы добавить тариф все поля должны быть заполнены","alert-danger");
        return;
    } else if ( $("#tarifDayCount").val() < 0 || $("#tarifPrice").val() < 0 ) {
        showAlert("Значение цены и кол-во дней не могут быть отрицательные","alert-danger");
        return;
    }

    showAlert("Тариф успешно добавлен","alert-success");

    tarifArray[$("#tarifDayCount").val()] = $("#tarifPrice").val();

    $("#tarifDayCount").val("");
    $("#tarifPrice").val("");
    showTarif();
});