$(document).ready(function (){
    setInterval(function (){
        get_data()
    },1000);

    function get_data(){
        let table = $('#tableResult');
        let result = $('#result')
        $.ajax({
            type: 'GET',
            url: '/live-result',
            success: function(response){
                table.html("");
                table.append(result)



            }

        })

    }
})
