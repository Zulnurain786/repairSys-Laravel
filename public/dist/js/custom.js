
const saveProfile = () => {
    $('#formData').submit()
}

$(document).ready(function(){
    setTimeout(function(){
        $('.alert').fadeOut()
    }, 5000)
})

const alerts = (success,message) => {
    $('.my-notify').fadeIn()
    if(success){
        $('.alert-success').fadeIn()
        $('.alert-success').text(message)
    }
    else{
        $('.alert-danger').fadeIn()
        $('.alert-danger').text(message)
    }
    setTimeout(function(){
        $('.my-notify').fadeOut()
        $('.alert').fadeOut()
    }, 3000)
}

const resendEmail = (ele) => {
    ele.find('span.loading').show()
    ele.find('span.mail-icon').hide()
    ele.prop('disabled',true)
    axios.get(ele.data('url')).then(res => {
        if(res.data){
            ele.find('span.loading').hide()
            ele.find('span.mail-icon').show()
            ele.prop('disabled',false)
            alerts(res.data.success,res.data.message)
        }
    })
}