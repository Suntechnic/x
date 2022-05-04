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
            "FIELD_VALUES[NAME]": {"required":true},
            "PROPERTY_VALUES[EMAIL]": {"required":true, "email":true},
            "PROPERTY_VALUES[PHONE]": {"required":true, "minlength":10}
            
        },
        messages: {
            "FIELD_VALUES[NAME]": {"required": "Пожалуйста, напишите ваше имя"},
            "PROPERTY_VALUES[EMAIL]": {"required": "Пожалуйста, напишите ваш email","email":"Некорректный адрес email"},
            "PROPERTY_VALUES[PHONE]": {"required": "Пожалуйста, напишите номер телефона","minlength":"Некорректный телефон"}
        }
    });
    
    
    
    
    
    // файл
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