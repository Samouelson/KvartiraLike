jQuery(document).ready(function($) {

$("#main-contact-form").submit(function() {
var str = $(this).serialize();

$.ajax({
type: "POST",
url: "reviews.php",
data: str,
success: function(msg) {
if(msg == 'OK') {
result = '<div class="status alert alert-success">Сообщение отправлено успешно</div>';
} else {
result = msg;
}
    $('#note').html(result);
}
});
return false;
});
});