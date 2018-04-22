@if($errors->any())
    <script type="text/javascript">

        $.toast({
            heading: 'Thông báo !',
            text: `@foreach($errors->all() as $error) {{  $error }}</br>@endforeach`,
            showHideTransition: 'slide',
            icon: 'error',
            loaderBg: '#f96868',
            position: 'top-right'
        });

    </script>
@endif