function showSuccessAlert(title,text,icon,confirmButtonText,redirect='') {
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: confirmButtonText
    }).then(() => {
        location.href = redirect;
    });
}

function showErrors(error) {
    let errors = error.responseJSON.errors
    for(let key in errors)
    {
        let errorDiv = $(`.error[data-error="${key}"]`);
        if(errorDiv.length )
        {
            errorDiv.text(errors[key][0]);
        }
    }    
}