$(document).ready(function() {
    //Скрываем информационные блоки
    $('#dialog-files-message-info').hide();
    
    //Отображение вкладок для работы с файлами
    $("#tabs").tabs();
    
    //Отображение checkbox
    //$("input").checkboxradio();
    
    //Обработка кнопки Загрузить файлы
    $('#loadbutton').on('click', function(){
        $.ajax({
            url: "inc/files_ajax.php",
            type: "POST",
            data: "files_afrfm=1",
            success: function($i){
                $('p#info').text('Добавлено'+' '+$i+' '+'файлов!');
                    $('#dialog-files-message-info').dialog({
                        modal: true,
                        buttons: {
                        Ok: function() {
                            $( this ).dialog('close');
                            location.reload();
                                }
                        }
                    });
            }
        });
        
    });
    
    $('#renewbutton').on('click', function(){
       location.reload(); 
    });
    
    $('#checkbutton').on('click', function(){
        $.ajax({
            url: "inc/files_ajax.php",
            type: "POST",
            data: "files_zfrfm=1",
            success: function($i){
                $('p#info').text('Разархивировано'+' '+$i+' '+'файлов!');
                    $('#dialog-files-message-info').dialog({
                        modal: true,
                        buttons: {
                        Ok: function() {
                            $( this ).dialog('close');
                            location.reload();
                                }
                        }
                    });
            }
        });
    });
});

