<script>
    $('#btn-submit').on('click', function(e){
        e.preventDefault();
        const label = $('.label').val();
        const value = $('.value').val();
        if(label != '' && value != ''){
            $.ajax({
                method: 'GET',
                url: '{{route('sub-attributes-options-alreadyexits')}}',
                data: {label: label, value: value},
                success: function(data){
                    if(data.status){
                        vex.dialog.alert({
                            className: 'vex-theme-default', // Overwrites defaultOptions
                            message: data.mesg,
                        })
                    }
                    else{
                        //$('#main-form')[0].submit();
                        $.ajax({
                            method: 'POST',
                            url: $('#main-form').attr('action'),
                            data: $('#main-form').serialize(),
                            success: function(data){
                                toastr.success('Added', data.message);
                                $('#main-form')[0].reset();
                                $('#color-form').modal('hide');
                            },
                            error: function(data){
                                alert('Error Occurred!');
                            }
                        });
                    }
                },
                error: function (data) {
                    vex.dialog.alert({
                        className: 'vex-theme-default', // Overwrites defaultOptions
                        message: 'Error Occured!',
                    })
                }
            })
        }
        else{
            vex.dialog.alert({
                className: 'vex-theme-default', // Overwrites defaultOptions
                message: 'Please enter color name and color hex value!',
            })
        }
    });
</script>
