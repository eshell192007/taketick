class Events {
    private events: Array<{querySelector:string, callback: Function, eventTrigger: string, topElement: any}>;
    private callbacks: Callbacks;
    private elements: Elements;
    constructor(private $doc: any, private $win: any, private config: {}) {
        this.events = [];
        this.elements = new Elements;
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
        this.register('.form-ajax', e => {
            e.preventDefault();
            let $form = this.elements.get('ajaxForm');
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                data: new FormData($form[0]),
                complete: response => {
                    console.log(response);
                    if(response['alert']) {
                        $form.find('.alert').text(response['alert']).slideDown(200);
                        setTimeout(function() {
                            $form.find('.alert').slideUp(200);
                        }, 7000);
                    } else if(response['redirect']) {
                        this.$win[0].location = response['redirect'];
                    }
                }
            });
        }, 'submit');

        let $win = this.$win;
        this.register('[data-href]', function() {
            $win[0].location.href = $(this).data('href');
        });
    }
}