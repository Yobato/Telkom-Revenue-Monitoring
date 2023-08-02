// public/js/form_validation.js

// Fungsi untuk mereset field dan pesan error
function resetForm1() {
    var inputField = document.getElementsByClassName("required-input");
    var errorMessage = document.getElementsByClassName("error-message");

    for (var i = 0; i < inputField.length; i++) {
        inputField[i].value = ""; // Menghapus nilai di field input
        inputField[i].classList.remove("is-invalid"); // Menghapus kelas CSS 'is-invalid'
    }

    for (var j = 0; j < errorMessage.length; j++) {
        errorMessage[j].style.display = "none"; // Menyembunyikan pesan error
    }
}

// Event listener untuk menutup modal
$(".modal").each(function () {
    $(this).on("hidden.bs.modal", function (e) {
        resetForm1(); // Memanggil fungsi resetForm saat modal ditutup
    });
});

// Event listener saat form dikirim
document
    .getElementsByClassName("form-validation")[0]
    .addEventListener("submit", function (event) {
        var inputFields = document.getElementsByClassName("required-input");
        var errorMessages = document.getElementsByClassName("error-message");

        var hasError = false;

        for (var i = 0; i < inputFields.length; i++) {
            if (inputFields[i] && errorMessages[i]) {
                if (inputFields[i].value.trim() === "") {
                    event.preventDefault();
                    inputFields[i].classList.add("is-invalid");
                    errorMessages[i].style.display = "block";
                    hasError = true;
                } else {
                    inputFields[i].classList.remove("is-invalid");
                    errorMessages[i].style.display = "none";
                }
            }
        }

        if (!hasError) {
            // Form valid, submit form
            // document.getElementsByClassName("form-validation")[0].submit();
        }
    });
