utils = {
    template: function (selector, withEvents, deep) {
        var e = $(selector);
        
        if (e.length < 1) {
            throw Error(selector + ' does not match any DOM element');
        }

        return e.clone(withEvents, deep).removeClass('template').removeAttr('id');
    }
};