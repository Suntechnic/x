$(document).ready(function () {
        // валидация
    var validateErrorPlacement = function(error, element) {
        error.addClass("ui-input__validation");
        error.appendTo(element.parent("div"));
        
        console.log(element);
    };
    var validateHighlight = function(element) {
        $(element)
            .parent("div")
            .addClass("has-error");
    };
    var validateUnhighlight = function(element) {
        $(element)
            .parent("div")
            .removeClass("has-error");
    };
    var validateSubmitHandler = function(form) {
        $(form).addClass("loading");
        
        form.submit();
    };

    /////////////////////
    // LEAD FORM
    ////////////////////
    $("form").validate({
        errorPlacement: validateErrorPlacement,
        highlight: validateHighlight,
        unhighlight: validateUnhighlight,
        submitHandler: validateSubmitHandler,
        rules: {
            
            //"PROPERTY_VALUES[BUDGET]": {"required":true},
            //"FIELD_VALUES[PREVIEW_TEXT]": {
            //    "required": true, //[1, '.decription_task']
            //},
            //"file": {
            //    "required": true, //[1, '.decription_task']
            //},
            "FIELD_VALUES[NAME]": {"required":true},
            "PROPERTY_VALUES[TEL]": {"required":true}
            
        },
        messages: {
            //"PROPERTY_VALUES[BUDGET]": {"required": "Укажите бюджет"},
            //"FIELD_VALUES[PREVIEW_TEXT]": {"required": "Опишите что вам нужно"},
            "FIELD_VALUES[NAME]": {"required": "Пожалуйста, напишите имя"},
            "PROPERTY_VALUES[TEL]": {"required": "Введите телефон или адрес Telegram"},
        }
    });
    
    
    
    
    
    
    
    
    
    var $file = $('[type="file"]'),
        $label = $file.next('label'),
        $labelTitle = $label.find('p'),
        $labelText = $label.find('span'),
        $labelRemove = $('.remove'),
        labelDefault = $labelText.text();

    // on file change
    $file.on('change', function(event) {
        var fileName = $file.val().split('\\').pop();
        if (fileName) {
            $labelText.text(fileName);
            $labelRemove.show();
            $labelTitle.hide();
        } else {
            $labelText.text(labelDefault);
            $labelRemove.hide();
            $labelTitle.show();
        }
    });

    // Remove file   
    $labelRemove.on('click', function(event) {
        $file.val("");
        $labelText.text(labelDefault);
        $labelRemove.hide();
        $labelTitle.show();
    });
    
})