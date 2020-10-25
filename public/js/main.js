$.ajaxSetup({
    headers:{
        'X-CSRF-Token':$('meta[name = "csrf-token"]').attr('content')
    }
});

//create customer
$('#createForm').submit(function(e){
    e.preventDefault();
    let msg = $('#createMsg');
    let name = $('#cerate_name');
    let email = $('#cerate_email');
    let phone = $('#cerate_phone');
    let address = $('#cerate_address');
    let formData = {
        name: name.val(),
        email: email.val(),
        phone: phone.val(),
        address: address.val()
    }
    $.ajax({
        type: 'POST',
        url: '/customer/store',
        data:formData,
        success:function(res){
            $(msg).html('');
            $(msg).append('<div class="alert alert-success"> Customer Created Successfully </div>');
            $(name).val('');
            $(email).val('');
            $(phone).val('');
            $(address).val('');

            //append result in table
            $('#TableBody').prepend(`
            <tr>
                <td>`+res.id+`</td>
                <td>`+res.name+`</td>
                <td>`+res.email+`</td>
                <td>`+res.phone+`</td>
                <td>`+res.address+`</td>
                <td>
                <a href="#" class="btn btn-sm btn-info">Edit</a>
                <a href="#" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr> 
            `)
            
        },
        error:function(error){
            $(msg).html('');
            $(msg).append('<ul id="errorMessage" class="alert alert-danger"></ul>');
            $.each(error.responseJSON.errors,function(index, value){
                $(msg).find('#errorMessage').append(`
                    <li>` +value[0]+ `</li>
                `);
            })

        }
    });

});

//edit customer 
$(document).on('click','#edit',function(){
    let customer = $(this).closest('tr').data('id');
    let modal = $('#editForm');
    $.ajax({
        type:'GET',
        url: '/customer/edit/'+customer,
        success:function(res){
            $(modal).find('#edit_name').val(res.name);
            $(modal).find('#edit_email').val(res.email);
            $(modal).find('#edit_phone').val(res.phone);
            $(modal).find('#edit_address').val(res.address);
            $(modal).attr('data-id',res.id);
        },
        error:function(error){
            console.log(error);
        }

    })
});

//update customer
$('#editForm').submit(function(e){
    e.preventDefault();
    let msg = $('#editMsg');
    let id = $('#editForm').data('id');
    let name = $('#edit_name');
    let email = $('#edit_email');
    let phone = $('#edit_phone');
    let address = $('#edit_address');
    let formData = {
        name: name.val(),
        email: email.val(),
        phone: phone.val(),
        address: address.val()
    }
    $.ajax({
        type: 'POST',
        url: '/customer/update/'+id,
        data:formData,
        success:function(res){
            $(msg).html('');
            $(msg).append('<div class="alert alert-success"> Customer Updated Successfully </div>');
            $(name).val('');
            $(email).val('');
            $(phone).val('');
            $(address).val('');
            let customer = $('#TableBody').find('tr[data-id="'+id+'"]');
            $(customer).find('td.customer-name').text(res.name);
            $(customer).find('td.customer-email').text(res.email);
            $(customer).find('td.customer-phone').text(res.phone);
            $(customer).find('td.customer-address').text(res.address);
        },
        error:function(error){
            $(msg).html('');
            $(msg).append('<ul id="errorMessage" class="alert alert-danger"></ul>');
            $.each(error.responseJSON.errors,function(index, value){
                $(msg).find('#errorMessage').append(`
                    <li>` +value[0]+ `</li>
                `);
            })
        }
    })

});


// create modal set to default
$('#createCustomer').on('hidden.bs.modal', function (e) {
    $('#createForm').find('#createMsg').html('');
})
// create modal set to default
$('#editCustomer').on('hidden.bs.modal', function (e) {
    $('#editForm').find('#editMsg').html('');
})