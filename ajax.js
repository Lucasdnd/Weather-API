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
                    // console.log(data);

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
    console.log(data.length);
    document.getElementById('show').innerHTML+="<h3> Acutellement, il fait "+ data[0]['temp_day'] +'°C'+" et "+ data[0]['desc'] +"</h3>";

    for (let i = 0; i < data.length; i++){

        console.log(data[i]);
        document.getElementById('show').innerHTML+="<h3> le "+data[i]['dt']+" il fera "+ data[i]['temp_day'] +'°C'+" et "+ data[i]['desc'] +"</h3>";
    }
}