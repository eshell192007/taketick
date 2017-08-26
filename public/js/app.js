var Callbacks = (function () {
    function Callbacks($doc, $win, config, elements) {
        this.$doc = $doc;
        this.$win = $win;
        this.config = config;
        this.elements = elements;
    }
    return Callbacks;
}());
var Events = (function () {
    function Events($doc, $win, config) {
        this.$doc = $doc;
        this.$win = $win;
        this.config = config;
        this.events = [];
        this.elements = new Elements;
        this.callbacks = new Callbacks($doc, $win, config, this.elements);
    }
    Events.prototype.register = function (querySelector, callback, eventTrigger, topElement) {
        if (eventTrigger == undefined) {
            eventTrigger = 'click';
        }
        if (topElement == undefined) {
            topElement = this.$doc;
        }
        var clb;
        if (typeof callback === 'string') {
            clb = this.callbacks[callback];
        }
        else {
            clb = callback;
        }
        topElement.on(eventTrigger, querySelector, clb);
        this.events.push({
            querySelector: querySelector,
            callback: clb,
            eventTrigger: eventTrigger,
            topElement: topElement
        });
    };
    Events.prototype.registerEvents = function () {
        var _this = this;
        this.register('.form-ajax', function (e) {
            e.preventDefault();
            var $form = _this.elements.get('ajaxForm');
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                data: new FormData($form[0]),
                complete: function (response) {
                    console.log(response);
                    if (response['alert']) {
                        $form.find('.alert').text(response['alert']).slideDown(200);
                        setTimeout(function () {
                            $form.find('.alert').slideUp(200);
                        }, 7000);
                    }
                    else if (response['redirect']) {
                        _this.$win[0].location = response['redirect'];
                    }
                }
            });
        }, 'submit');
        var $win = this.$win;
        this.register('[data-href]', function () {
            $win[0].location.href = $(this).data('href');
        });
    };
    return Events;
}());
var Elements = (function () {
    function Elements() {
        this.elements = {};
        this.elements['ajaxForm'] = $('.form-ajax');
        this.elements['tableSortable'] = $('.table.table-sortable');
        this.elements['altHref'] = $('[data-href]');
        this.elements['colorInput'] = $('input[type="color"], .colorpicker-component');
        this.attach();
    }
    Elements.prototype.attach = function () {
        this.get('tableSortable').dataTable({
            searching: false
        });
        this.get('colorInput').colorpicker();
    };
    Elements.prototype.get = function (param) {
        return this.elements[param];
    };
    return Elements;
}());
var app = (function () {
    function app($doc, $win, config) {
        this.$doc = $doc;
        this.$win = $win;
        this.config = config;
        this.events = new Events($doc, $win, config);
    }
    app.prototype.run = function () {
        this.events.registerEvents();
    };
    return app;
}());
if (typeof $ == 'undefined') {
    function $(param) { }
}
new app($(document), $(window), {}).run();
//# sourceMappingURL=app.js.map