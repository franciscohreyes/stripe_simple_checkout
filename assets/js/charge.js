$(document).ready(function() {
    $("#simpleFormCheckout").on("submit", function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: "API/payment.php",
            method: "POST",
            data: formData,
            success: function(result){
                var response = JSON.parse(result);
                if(response.success){
                    $("#showError").show();
                    $("#showText").show();
                    $("#showText").removeClass('invalid-feedback');
                    $("#showText").addClass('text-success');
                    $("#showText").text(response.msg);
                    clearForm();
                } else {
                    $("#showError").show();
                    $("#showText").show();
                    $("#showText").text(response.msg);
                }
            },
            error: function(response){
                console.log(response);
                clearForm();
            }
        });
    });

    /* clear input card */
    var clearForm = function(){
        $("#cc-name").val('');
        $("#cc-number").val('');
        $("#cc-month").val('');
        $("#cc-year").val('');
        $("#cc-cvv").val('');
    }
});