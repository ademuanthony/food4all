/**
 * Created by ELACHI on 1/10/2017.
 */
$(document).ready(function(){
    function fetchMemberByKey(key, value, callback){
        $.get('/api/member/get?key=' + key + '&value='+value, function (response) {
            callback(response);
        })
    }



    $('#sponsorId').blur(function () {
        if($(this).val() == '') return;
        fetchMemberByKey('membership_id', $(this).val(), function(result){
            if(result.success == true){
                $('#sponsorName').text(result.data.firstname + ' ' + result.data.lastname).css('color', 'green');
            }else{
                $('#sponsorName').text('Invalid membership Id').css('color', 'red');
            }
        });
    });

    $('#parentId').blur(function () {
        if($(this).val() == '') return;
        fetchMemberByKey('membership_id', $(this).val(), function(result){
            if(result.success == true){
                $('#parentName').text(result.data.firstname + ' ' + result.data.lastname).css('color', 'green');
            }else{
                $('#parentName').text('Invalid membership Id').css('color', 'red');
            }
        });
    });

})
