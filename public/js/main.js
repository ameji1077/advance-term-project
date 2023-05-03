const inputDate = document.forms.reservationForm.date;
const inputTime = document.forms.reservationForm.time;
const inputNumber = document.forms.reservationForm.number;
const inputCourse = document.forms.reservationForm.course;

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

const inputCourseResult = document.getElementById('courseResult');
inputCourse.addEventListener('input', () => {
  let selectedOption = inputCourse.options[inputCourse.selectedIndex];
  inputCourseResult.textContent = selectedOption.value !== '' ? selectedOption.textContent : 'なし';
});

const select = document.querySelector('select');
window.addEventListener('resize', () => {
  select.style.width = select.parentElement.offsetWidth + 'px';
});

const totalResult = document.getElementById('totalResult');

function updateTotalResult() {
  const numOfUsers = parseInt(inputNumber.value);
  const coursePrice = parseInt(inputCourse.options[inputCourse.selectedIndex].getAttribute('data-price'));

  if (numOfUsers && coursePrice) {
    const totalPrice = numOfUsers * coursePrice;
    totalResult.textContent = `${numberWithCommas(totalPrice)}円`;
  } else {
    totalResult.textContent = '-';
  }
};

function numberWithCommas(number) {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
};

inputNumber.addEventListener('change', updateTotalResult);
inputCourse.addEventListener('change', updateTotalResult);

  const selectElement = document.getElementById('selectShopId');
  const hiddenElement = document.getElementById('hiddenShopId');
  selectElement.addEventListener('change', () => {
    hiddenElement.value = selectElement.value;
  });

