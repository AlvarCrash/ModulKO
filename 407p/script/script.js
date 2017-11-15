$(document).ready(function() {
    //Скрываем блок нового пользователя
    $('#newuser').hide();
    
    //Добавляем инициализацию x-editable
    $.fn.editable.defaults.mode = 'popup';
    $(document).ready(function() {
        $('.user-editable').editable();
    });
    //Показываем блок создания нового пользователя
    $('#newuserbutton').on('click', function(){
        $('div#newuser').show("slide");
    });
    
    //Обработка кнопки удаления
    $('.deleteuser').on('click', function(){
       alert ('jQuery подключен и отлично работает!'); 
    });
    
    //Обработка кнопки Сохранить
    $('#savebutton').on('click', function(){
       $('div#newuser').hide("slide"); 
    });
    
    //Обработка кнопки Сброс
    $('#resetbutton').on('click', function(){
       $('input#EMAIL').val('');
       $('input#NAME').val('');
    });
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


