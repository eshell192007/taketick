class Events {
    private events: Array<{querySelector:string, callback: Function, eventTrigger: string, topElement: any}>;
    private callbacks: Callbacks;
    private elements: Elements;
    constructor(private $doc: any, private $win: any, private config: {}) {
        this.events = [];
        this.elements = new Elements(config);
        this.callbacks = new Callbacks($doc, $win, config, this.elements);
    }

    public register(querySelector: string, callback: Function|string, eventTrigger?: string, topElement?: any) {
        if(eventTrigger == undefined) {
            eventTrigger = 'click';
        }
        if(topElement == undefined) {
            topElement = this.$doc;
        }
        let clb: Function;
        if(typeof callback === 'string') {
            clb = this.callbacks[callback];
        } else {
            clb = callback;
        }
        topElement.on(eventTrigger, querySelector, clb);
        this.events.push({
            querySelector: querySelector,
            callback: clb,
            eventTrigger: eventTrigger,
            topElement: topElement
        });
    }

    public registerEvents() {
        this.register('.form-ajax', function(e) {
            e.preventDefault();
            let $form = $(this);
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                data: new FormData($form[0]),
                complete: response => {
                    response = response.responseJSON;
                    if(response['alert']) {
                        $form.find('.alert').text(response['alert']).slideDown(200);
                        setTimeout(function() {
                            $form.find('.alert').slideUp(200);
                        }, 7000);
                    } else if(response['redirect']) {
                        window.location = response['redirect'];
                    } else if(typeof $form.data('callback') != 'undefined') {
                        _this.callbacks[$form.data('callback')](response, $form);
                    }
                }
            });
        }, 'submit');

        let $win = this.$win;
        this.register('[data-href]', function() {
            $win[0].location.href = $(this).data('href');
        });

        let _this = this;
        // Records
        this.register('.btn-record-add', function() {
            let name = $(this).data('name');
            $(`#records-${name} li:last-child`).before(`<li class="list-group-item d-block record" data-id="0" data-type="${name}">${_this.elements.recordForm(name)}</li>`);
            _this.elements.refresh();
        });
        this.register('.btn-record-edit', function() {
            let $li = $(this).closest('li');
            let group = $li.data('type');
            let color = $li.data('color');
            let id = $li.data('id');
            let name = $li.find('.name').text();
            let priority = 0;
            if($li.find('.priority').length > 0) {
                priority = $li.find('.priority').text();
            }
            $li.html(_this.elements.recordForm(group, name, color, id, {
                priority: priority
            }));
            _this.elements.refresh();
        });
        this.register('.btn-record-remove', function() {
            let $li = $(this).closest('li');
            $.ajax({
                url: '/settings/' + $li.data('type') + '/' + $li.data('id'),
                type: 'delete',
                dataType:'json',
                cache:false,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: response => {

                }
            });
            $(this).closest('li').empty().remove();
        });
        this.register('.btn-record-save', function() {
            let $record = $(this).closest('.record-form');
            $record.wrap($('<form />', {
                action: '/settings/' + $record.data('name') + '/' + $record.data('id') + '/save',
                method: 'post',
                'class': 'form-ajax',
                'data-callback': 'insertId'
            }));
            let $form = $record.parent();
            $form.append(`<input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">`);
            $form.submit();
            let $li = $form.closest('li');
            let body = _this.elements.recordRow($form.find('input.form-name').val(), $form.find('input.form-color').val());
            $li.html(body);
        });
    }
}