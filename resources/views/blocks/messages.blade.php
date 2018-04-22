@if(session('messages'))
    <script type="text/javascript">

        $.toast({
            heading: 'Thông báo !',
            text: `@foreach(session('messages') as $msg)
                    {{  $msg }}</br>
                    @endforeach`,
            showHideTransition: 'slide',
            icon: 'success',
            loaderBg: '#f96868',
            position: 'top-right'
        });

    </script>
@endif