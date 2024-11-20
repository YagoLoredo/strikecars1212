

function addVeiculoCarrinho(veiculo_id) {

    var baseURL = location.protocol + "//" + location.hostname;

    $.ajax({
        method: "POST",
        url: baseURL + "/addVeiculoCarrinho",
        data: {"veiculo_id":veiculo_id},
        success: function(data) {

            if (data.substring(0,6) == 'ERROR:') {
                alert(data.substring(7));
                return false;
            }

            window.location.href = baseURL;
        }
    });
}