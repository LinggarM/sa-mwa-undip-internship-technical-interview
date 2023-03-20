
(function ($) {
    "use strict";


    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

    var username = document.getElementById('username').value;
    var pass = document.getElementById('pass').value;
    var status = document.getElementById('pass').value;
    
    var reset = document.getElementById('reset');
    var addUser = document.getElementById('add-user');
    var tableUser = document.getElementById('table-user');

    reset.addEventListener("click", function() {
        document.getElementById('username').value = "";
        document.getElementById('pass').value = "";
    });

    addUser.addEventListener("click", function addUser(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                tableUser.innerHTML = xhttp.responseText;
                console.log(username);
            }
        };
        xhttp.open("GET", "table_user.php?username="+username+"&password="+pass+"&status="+status, true);
        xhttp.send();
    });

})(jQuery);