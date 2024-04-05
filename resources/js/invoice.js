$(document).ready(function(){

    $(document).on('click','#addInvoiceItems',function(){

        $.ajax({
            type: "GET",
            url: "/add-invoice-items",
            success: function (response) {
                $('#invoiceItems').append(response);
            }
        })
    })
    $(document).on('click','.removeItem',function(){
        console.log('this')
        $(this).parent().parent().remove();

    })

    $(document).on('click','#submitAddInvoiceForm',function(e){

        e.preventDefault();

        if($('#invoiceItems').children().length == 0){

            alert('please add at least one item');
            return;
        }

        $('#addInvoiceForm').submit();


    })


    $(document).on('click','#submitUpdateInvoiceForm',function(e){

        e.preventDefault();

        if($('#invoiceItems').children().length == 0){

            alert('please add at least one item');
            return;
        }

        $('#updateInvoiceForm').submit();
    })
})
