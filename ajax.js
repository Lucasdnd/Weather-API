$(document).ready(function(){

    $('#submitLocation').click(function(){

        //get value from input field
        var city = $("#city").val();

        //check not empty
        if (city != ''){

            $.ajax({

                url: "PHP/router.php?city="+city,
                type: "GET",
                dataType: "json",
                success: function(data){
                    console.log(data);

                    var information = show(data);
                    $("#show").html(information); 
                },
                error: function(){
                    $('#error').html("Nom d'une ville incorrect");
                }
                  
            });

        }else{
            $('#error').html("Veuillez entrer le nom d'une ville");
        }

    });
})

function show(data){
    return "<h3> il fait "+ data[0]['temp'] +'°C'+" à "+data[0]['name'] +"</h3><h3>"+data[0]['desc'] +"</h3>";
}