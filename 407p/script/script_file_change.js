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
            data: "files_lfrfm=1",
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
    
    $('#renewbuttona').on('click', function(){
        $(':checkbox:checked').each(function(){
            $(this).prop("checked", false);
        });
        location.reload();
        
    });
    
    $('#renewbuttonz').on('click', function(){
        $(':checkbox:checked').each(function(){
            $(this).prop("checked", false);
        });
        location.reload();
        
    });
    
    //Обработка кнопки Обработать файлы
    $('#checkbuttona').on('click', function(){
        //Выбираем все нажатые checkbox
        var checkbox = [];
        var ii = 0;
        $(':checkbox:checked').each(function(){
            //alert(this.value);
            checkbox[ii] = $(this).attr('id');
            ii++;
            $(this).prop("checked", false);
        })
        $.ajax({
            url: "inc/files_ajax.php",
            type: "POST",
            data: "files_afrfm=1&checkbox="+checkbox,
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
    
    //Обработка кнопки расшифровать файлы
    $('#checkbuttonz').on('click', function(){
        //Выбираем все нажатые checkbox
        var checkbox = [];
        var ii = 0;
        $(':checkbox:checked').each(function(){
            //alert(this.value);
            checkbox[ii] = $(this).attr('id');
            ii++;
            $(this).prop("checked", false);
        });
        $.ajax({
            url: "inc/files_ajax.php",
            type: "POST",
            data: "files_zfrfm=1&checkbox="+checkbox,
            success: function($i){
                $('p#info').text('Расшифровано'+' '+$i+' '+'файлов!');
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
    
    //Разархивирование расшифрованных ZIP файлов
    $('#checkbuttonr').on('click', function(){
        //Выбираем все нажатые checkbox
        var checkbox = [];
        var ii = 0;
        $(':checkbox:checked').each(function(){
            //alert(this.value);
            checkbox[ii] = $(this).attr('id');
            ii++;
            $(this).prop("checked", false);
        });
        $.ajax({
            url: "inc/files_ajax.php",
            type: "POST",
            data: "files_rfm=1&checkbox="+checkbox,
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
    
    //Кнопка обновить на вкладке разархивированные ЭС РФМ
    $('#renewbuttonr').on('click', function(){
        location.reload();
    })
    
    
    //Проводим логический контроль файлов
    $('#checkbuttonrfm').on('click', function(){
        //Выбираем все нажатые checkbox
        var checkbox = [];
        var ii = 0;
        $(':checkbox:checked').each(function(){
            //alert(this.value);
            checkbox[ii] = $(this).attr('id');
            ii++;
            $(this).prop("checked", false);
        });
        $.ajax({
            url: "inc/files_ajax.php",
            type: "POST",
            data: "files_log=1&checkbox="+checkbox,
            success: function($i){
                //alert (ii+' '+$i);
                if ($i != ii){
                    $('p#info').text('Внимание! При обработке были ошибки!');
                }
                else {
                    $('p#info').text('Прошли контроль'+' '+$i+' '+'файлов!');
                }
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
    
    //Кнопка обновить на вкладке Файлы ЭС РФМ
    $('#renewbutton1').on('click', function(){
        location.reload();
    })
});



