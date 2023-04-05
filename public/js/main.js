const inputDate = document.forms.reservationForm.date;
const inputTime = document.forms.reservationForm.time;
const inputNumber = document.forms.reservationForm.number;

inputDate.addEventListener('input', () => {
  let inputDateResult = document.getElementById('dateResult');
  inputDateResult.textContent = inputDate.value;
});

window.onload = function () {
  var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var yyyy = tomorrow.getFullYear();
  var mm = ("0" + (tomorrow.getMonth() + 1)).slice(-2);
  var dd = ("0" + tomorrow.getDate()).slice(-2);
  document.getElementById("date").value = yyyy + '-' + mm + '-' + dd;
  document.getElementById("dateResult").innerHTML = yyyy + '-' + mm + '-' + dd;
};

inputTime.addEventListener('input', () => {
  let inputTimeResult = document.getElementById('timeResult');
  inputTimeResult.textContent = inputTime.value; 
});

inputNumber.addEventListener('input', () => {
  let inputNumberResult = document.getElementById('numberResult');
  inputNumberResult.textContent = inputNumber.value + '人';
});

const select = document.querySelector('select');
window.addEventListener('resize', () => {
  select.style.width = select.parentElement.offsetWidth + 'px';
});

$(function() {
  $('.range-group').each(function() {
    for (var i = 0; i < 5; i ++) {
      $(this).append('<a>');
    }
  }); 
  $('.range-group>a').on('click', function() {
      var index = $(this).index();
    $(this).siblings().removeClass('on');
      for (var i = 0; i < index; i++) {
        $(this).parent().find('a').eq(i).addClass('on'); 
      }
    $(this).parent().find('.input-range').attr('value', index);
  });
});