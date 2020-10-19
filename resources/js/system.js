if ($('.mask_phone').length) {

    var phoneMaskBehavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 0 0000-0000' : '(00) 0000-00009';
        },
        optionsMaskPhone = {
            onKeyPress: function(val, e, field, options) {
                field.mask(phoneMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.mask_phone').mask(phoneMaskBehavior, optionsMaskPhone).attr('type', 'tel');

}