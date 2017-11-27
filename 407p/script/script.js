$(document).ready(function() {
    //Скрываем информационные блоки
    $('#newuser').hide();
    $('#dialog-message-info').hide();
    $('#dialog-confirm-delete').hide();
    $('#dialog-message-error').hide();
    $('#dialog-form').hide();
        
    //Добавляем инициализацию x-editable
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function() {
        $('.user-editable').editable();
        $('.ko-editable').editable();
    });
    
    //Показываем блок создания нового пользователя
    $('#newuserbutton').on('click', function(){
        $('div#newuser').show("slide");
    });
    
    //Обработка кнопки удаления
    $('.deleteuser').on('click', function(){
        var tr = "tr"+$(this).attr('id');
        var id = $(this).attr('id');
        $('#dialog-confirm-delete').dialog({
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons: {
              "Удалить пользователя?": function() {
                  $(this).dialog('close');
                  $.ajax({
                    url: "inc/ajax.php",
                    type: "POST",
                    data: "id_delete="+id,
                    success: function(){
                    $('#'+tr).hide();
                    $('p#info').text('Пользователь удален!');
                    $('#dialog-message-info').dialog({
                        modal: true,
                        buttons: {
                        Ok: function() {
                            $( this ).dialog('close');
                                }
                        }
                    });
            }
        });
              },
              Cancel: function() {
                $( this ).dialog('close');
              }
            }
          });                
    });
    
    
    //Обработка кнопки Сохранить
    $('#savebutton').on('click', function(){
       
       if (($('#inputpass1').val()) === ($('#inputpass2').val())) {
        $.ajax({
           url: "inc/ajax.php",
           type: "POST",
           data: "email="+$('#inputemail').val()+"&password="+$('#inputpass1').val()+"&name="+$('#inputname').val()+"&secondname="+$('#inputsecondname').val()+"&lastname="+$('#inputlastname').val()+"&job="+$('#inputjob').val()+"&type="+$('#inputtype').val(),
           success: function(){
               $('p#info').text('Пользователь добавлен!');
               $('#dialog-message-info').dialog({
                    modal: true,
                    buttons: {
                    Ok: function() {
                        $(this).dialog('close');
                        location.reload();
                        }
                    }
                    });
           }
        });
        $('div#newuser').hide('slide');
       }
       else {
            $('p#error').text('Пароли не совпадают!');
            $('#dialog-message-error').dialog({
                        modal: true,
                        buttons: {
                        Ok: function() {
                        $( this ).dialog('close');
                        }
                    }
                }); 
       }
    });
    
    //Обработка кнопки смены пароля
    $('.changepass').on('click', function(){
        var id = $(this).attr('id');
        var dialogform, form;
        dialogform = $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                "Сменить пароль": function(){
                    if (($('input#pass1').val()) === ($('input#pass2').val())) {
                        $.ajax({
                            url: "inc/ajax.php",
                            type: "POST",
                            data: "id_change_pass="+id+"&changepass="+$('input#pass1').val(),
                            success: function(){
                                $('p#info').text('Пароль изменен!');
                                $('#dialog-message-info').dialog({
                                    modal: true,
                                    buttons: {
                                        Ok: function() {
                                            $(this).dialog('close');
                                        }
                                    }
                                });
                            }
                        });
                        dialogform.dialog( "close" );
                    }
                    else {
                        $('p#info').text('Пароли не совпадают!');
                        $('#dialog-message-info').dialog({
                            modal: true,
                            buttons: {
                                Ok: function() {
                                    $(this).dialog('close');
                                }
                            }
                        });
                    }
                },
                "Отмена": function() {
                    dialogform.dialog( "close" );
                }
            },
        close: function() {
            form[ 0 ].reset();
            
        }
        });
        form = dialogform.find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
           
        });
         dialogform.dialog( "open" );
     });
    
    //Обработка кнопки Закрыть
    $('#closebutton').on('click', function(){
        $('#newuser').hide('slide');
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
    
    //Обработка кнопки войти
    $('#loginbutton').on('click', function (){
        $.ajax({
            url: "inc/login.php",
            type: "POST",
            data: "email="+$('input#emailauth').val()+"&password="+$('input#passauth').val(),
            success: function(msg){
                //alert(msg);
                //if ((msg) === "ОК") {
                    $('#auth').hide();
                    location.reload();
                //}
                
            }
        });
    })
    
    //Обработка сохранения настроек путей
    $('#savepathbutton').on('click', function() {
        $.ajax({
            url: "inc/ajax.php",
            type: "POST",
            data: "id=1&inafrfm="+$('#inafrfm').val()+"&inzfrfm="+$('#inzfrfm').val()+"&inrfrfm="+$('#inrfrfm').val()+"&outfiles="+$('#outfiles').val(),
            success: function(){
                $('p#info').text('Изменения сохренены!');
                        $('#dialog-message-info').dialog({
                            modal: true,
                            buttons: {
                                Ok: function() {
                                    $(this).dialog('close');
                                }
                            }
                        });
            }
        })
    })
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


