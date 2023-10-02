@if (Session::has('msg'))
    <link href="{{ asset('backend/css/animate.min.css') }}" rel="stylesheet" />
    <style>
        .alert-success {display: flex !important; align-items: center !important; border: none !important; background-color: #5cb860 !important; position: relative; color: #fff !important; border-radius: 3px; box-shadow: 0 12px 20px -10px rgba(76, 175, 80, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(76, 175, 80, 0.2); padding: 20px 15px; line-height: 20px; }
        .alert-with-icon { padding-left:65px; }
        .alert svg[data-notify='icon'] { font-size: 30px; display: block; left: 15px; position: absolute; top: 50%; margin-top: -15px; }
        .alert span { display: inline-block; max-width: 89%; }
    </style>
    <script>
        $.notify({
            icon: 'fa fa-bell',
            message: "{{ Session::get('msg') }}"
        },{
            element: 'body',
            position: null,
            type: "success",
            allow_dismiss: true,
            newest_on_top: true,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 20000,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template:   '<div data-notify="container" class="col-xs-11 col-sm-6 alert alert-with-icon alert-{0}" role="alert">' +
                            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                            '<span class="custom-change-icon" data-notify="icon"></span> ' +
                            '<span data-notify="message">{2}</span>' +
                        '</div>'
        });
    </script>
@elseif(Session::has('error'))
<link href="{{ asset('backend/css/animate.min.css') }}" rel="stylesheet" />
<style>
    .alert-success {display: flex !important; align-items: center !important; border: none !important; background-color: #dc3545 !important; position: relative; color: #fff !important; border-radius: 3px; box-shadow: 0 12px 20px -10px rgba(76, 175, 80, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(76, 175, 80, 0.2); padding: 20px 15px; line-height: 20px; }
    .alert-with-icon { padding-left:65px; }
    .alert svg[data-notify='icon'] { font-size: 30px; display: block; left: 15px; position: absolute; top: 50%; margin-top: -15px; }
    .alert span { display: inline-block; max-width: 89%; }
</style>
<script>
    $.notify({
        icon: 'fa fa-bell',
        message: "{{ Session::get('error') }}"
    },{
        element: 'body',
        position: null,
        type: "success",
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "center"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 20000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template:   '<div data-notify="container" class="col-xs-11 col-sm-6 alert alert-with-icon alert-{0}" role="alert">' +
                        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                        '<span class="custom-change-icon" data-notify="icon"></span> ' +
                        '<span data-notify="message">{2}</span>' +
                    '</div>'
    });
</script>
@endif