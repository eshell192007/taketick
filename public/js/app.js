var Callbacks = (function () {
    function Callbacks($doc, $win, config, elements) {
        this.$doc = $doc;
        this.$win = $win;
        this.config = config;
        this.elements = elements;
    }
    Callbacks.prototype.insertId = function (response) {
        $('[data-id="0"]').attr('data-id', response.id);
    };
    Callbacks.prototype.messageAdd = function (response) {
        var $rf = $('#reply-form');
        $rf.before(this.elements.message(response['subject'], response['detail'], response['fromLink'], response['fromLabel'], response['dateDiff']));
        $rf.find('textarea').val('');
        $('.scrollbar-bottom').scrollTop(Math.pow(10, 10));
    };
    return Callbacks;
}());
var Elements = (function () {
    function Elements(config) {
        this.config = config;
        this.elements = {};
        this.elements['ajaxForm'] = $('.form-ajax');
        this.elements['tableSortable'] = $('.table.table-sortable');
        this.elements['altHref'] = $('[data-href]');
        this.elements['recordAdd'] = $('.btn-record-add');
        this.elements['recordRemove'] = $('.btn-record-remove');
        this.elements['recordEdit'] = $('.btn-record-edit');
        this.attach();
    }
    Elements.prototype.attach = function () {
        if (this.get('tableSortable').length > 0) {
            this.get('tableSortable').dataTable({
                searching: false
            });
        }
        this.refresh();
    };
    Elements.prototype.refresh = function () {
        this.elements['colorInput'] = $('input[type="color"], .colorpicker-component');
        if (this.get('colorInput').length > 0) {
            this.get('colorInput').colorpicker();
        }
    };
    Elements.prototype.get = function (param) {
        return this.elements[param];
    };
    Elements.prototype.recordForm = function (group, name, color, id, params) {
        if (params === void 0) { params = {}; }
        color = color || '#ffffff';
        name = name || '';
        id = id || 0;
        var input = '';
        if (group === 'priority') {
            input += "\n            <div class=\"form-group\">\n              <label for=\"" + group + "-" + id + "-priority\" class=\"label\">" + this.config['i18n']['Priority'] + "</label>\n              <input type=\"number\" name=\"priority\" value=\"" + params['priority'] + "\" class=\"form-control\" id=\"" + group + "-" + id + "-priority\">\n            </div>\n            ";
        }
        return "\n        <div class=\"record-form\" data-name=\"" + group + "\" data-id=\"" + id + "\">\n          <div class=\"form-group\">\n            <label for=\"" + group + "-" + id + "-name\" class=\"label\">" + this.config['i18n']['Name'] + "</label>\n            <input type=\"text\" name=\"name\" id=\"" + group + "-" + id + "-name\" class=\"form-control form-name\" value=\"" + name + "\">\n          </div>\n          <div class=\"form-group\">\n            <label for=\"" + group + "-" + id + "-color\" class=\"label\">" + this.config['i18n']['Color'] + "</label>\n            <div class=\"input-group colorpicker-component\">\n              <input type=\"text\" name=\"color\" id=\"" + group + "-" + id + "-color\" value=\"" + color + "\" class=\"form-control form-color\">\n              <span class=\"input-group-addon\"><i></i></span>\n            </div>\n          </div>\n          " + input + "\n          <div class=\"form-group\">\n            <button class=\"btn btn-sm btn-outline-success btn-record-save\" type=\"button\">\n              <span class=\"fa fa-save\"></span>\n              " + this.config['i18n']['Save'] + "\n            </button>\n          </div>\n        </div>\n        ";
    };
    Elements.prototype.recordRow = function (name, color, param) {
        if (param === void 0) { param = {}; }
        var info = '';
        if (name === 'priority') {
            info = "\n            <small class=\"priority\">" + param['priority'] + "</small>\n            ";
        }
        return "\n        <div class=\"btn-group float-right\">\n          <button type=\"button\" class=\"btn btn-outline-primary btn-sm btn-record-edit\">\n            <span class=\"fa fa-pencil\"></span>\n          </button>\n          <button type=\"button\" class=\"btn btn-outline-danger btn-sm btn-record-remove\">\n            <span class=\"fa fa-trash\"></span>\n          </button>\n        </div>\n        <span class=\"badge badge-default badge-pill\" style=\"background-color: " + color + "\">&nbsp;</span>\n        <span class=\"name\">" + name + "</span>\n        " + info + "\n        ";
    };
    Elements.prototype.message = function (subject, detail, fromLink, fromLabel, dateDiff) {
        return "\n        <li class=\"list-group-item d-block\">\n          <div class=\"d-flex w-100 justify-content-between\">\n            <h5 class=\"mb-1\">\n              <a href=\"" + fromLink + "\">" + fromLabel + "</a>\n            </h5>\n            <small class=\"text-muted\">" + dateDiff + "</small>\n          </div>\n          <strong class=\"mb-1\">" + subject + "</strong>\n          <div class=\"clearfix\"></div>\n          <div class=\"message-body\">" + detail + "</div>\n        </li>\n        ";
    };
    return Elements;
}());
var Events = (function () {
    function Events($doc, $win, config) {
        this.$doc = $doc;
        this.$win = $win;
        this.config = config;
        this.events = [];
        this.elements = new Elements(config);
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
        this.register('.form-ajax', function (e) {
            e.preventDefault();
            var $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                data: new FormData($form[0]),
                complete: function (response) {
                    response = response.responseJSON;
                    if (response['alert']) {
                        $form.find('.alert').text(response['alert']).slideDown(200);
                        setTimeout(function () {
                            $form.find('.alert').slideUp(200);
                        }, 7000);
                    }
                    else if (response['redirect']) {
                        window.location = response['redirect'];
                    }
                    else if (typeof $form.data('callback') != 'undefined') {
                        _this.callbacks[$form.data('callback')](response, $form);
                    }
                }
            });
        }, 'submit');
        var $win = this.$win;
        this.register('[data-href]', function () {
            $win[0].location.href = $(this).data('href');
        });
        var _this = this;
        this.register('.btn-record-add', function () {
            var name = $(this).data('name');
            $("#records-" + name + " li:last-child").before("<li class=\"list-group-item d-block record\" data-id=\"0\" data-type=\"" + name + "\">" + _this.elements.recordForm(name) + "</li>");
            _this.elements.refresh();
        });
        this.register('.btn-record-edit', function () {
            var $li = $(this).closest('li');
            var group = $li.data('type');
            var color = $li.data('color');
            var id = $li.data('id');
            var name = $li.find('.name').text();
            var priority = 0;
            if ($li.find('.priority').length > 0) {
                priority = $li.find('.priority').text();
            }
            $li.html(_this.elements.recordForm(group, name, color, id, {
                priority: priority
            }));
            _this.elements.refresh();
        });
        this.register('.btn-record-remove', function () {
            var $li = $(this).closest('li');
            $.ajax({
                url: '/settings/' + $li.data('type') + '/' + $li.data('id'),
                type: 'delete',
                dataType: 'json',
                cache: false,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                }
            });
            $(this).closest('li').empty().remove();
        });
        this.register('.btn-record-save', function () {
            var $record = $(this).closest('.record-form');
            $record.wrap($('<form />', {
                action: '/settings/' + $record.data('name') + '/' + $record.data('id') + '/save',
                method: 'post',
                'class': 'form-ajax',
                'data-callback': 'insertId'
            }));
            var $form = $record.parent();
            $form.append("<input type=\"hidden\" name=\"_token\" value=\"" + $('meta[name="csrf-token"]').attr('content') + "\">");
            $form.submit();
            var $li = $form.closest('li');
            var body = _this.elements.recordRow($form.find('input.form-name').val(), $form.find('input.form-color').val());
            $li.html(body);
        });
    };
    return Events;
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
    function $(param, param1) { }
}
new app($(document), $(window), window.config).run();
//# sourceMappingURL=app.js.map