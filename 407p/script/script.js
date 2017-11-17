$(document).ready(function() {
    //Скрываем блок нового пользователя
    $('#newuser').hide();
    $('#dialog-message-new').hide();
    $('#dialog-message-delete').hide();
    
    //Добавляем инициализацию x-editable
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function() {
        $('.user-editable').editable();
        $('user-delete').editable();
    });
    //Показываем блок создания нового пользователя
    $('#newuserbutton').on('click', function(){
        $('div#newuser').show("slide");
    });
    
    //Обработка кнопки удаления
    $('.deleteuser').on('click', function(){
       //alert ('jQuery подключен и отлично работает!');
        $.ajax({
            url: "inc/delete_user.php",
            dataType:"json",
            data: "id_delete="+$(this).attr('id'),
            success: function(data){
                $( "#dialog-message-delete" ).dialog({
                modal: true,
                buttons: {
                Ok: function() {
                  $( this ).dialog( "close" );
                }
                }
                });
                //$(this).hide();
                $.pjax.reload($('#users'), { type: "POST", timeout: 6000});
            }
        });
    });
    
    
    //Обработка кнопки Сохранить
    $('#savebutton').on('click', function(){
       $('div#newuser').hide("slide");
       $( "#dialog-message" ).dialog({
        modal: true,
        buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    });
    
    //Обработка кнопки Сброс
    $('#resetbutton').on('click', function(){
       $('input#inputemail').val('');
       $('input#inputpass1').val('');
       $('input#inputpass2').val('');
       $('input#inputname').val('');
       $('input#inputsecondname').val('');
       $('input#inputlastname').val('');
       $('input#inputjob').val('');
       $('input#inputtype').val('');
    });
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


